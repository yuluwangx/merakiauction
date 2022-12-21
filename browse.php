<?php include_once("header.php")?>
<?php require("utilities.php")?>
<?php include_once("dbconnect.php")?>

<div class="container">

<h2 class="my-3">Browse listings</h2>

<div id="searchSpecs">
<!-- When this form is submitted, this PHP page is what processes it.
     Search/sort specs are passed to this page through parameters in the URL
     (GET method of passing data to a page). -->
<form method="get" action="browse.php">
  <div class="row">
    <div class="col-md-5 pr-0">
      <div class="form-group">
        <label for="keyword" class="sr-only">Search keyword:</label>
	    <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text bg-transparent pr-0 text-muted">
              <i class="fa fa-search"></i>
            </span>
          </div>
          <input type="text" class="form-control border-left-0" id="keyword" name="keyword" placeholder="Search for anything">
        </div>
      </div>
    </div>
    <div class="col-md-3 pr-0">
      <div class="form-group">
        <label for="cat" class="sr-only">Search within:</label>
        <select class="form-control" id="cat" name="cat">
          <option selected value="everything">All categories</option>
          <option>Fashion</option>
          <option>Electronic</option>
          <option>Travel</option>
          <option>Education</option>
          <option>Food</option>
          <option>Transport</option>
          <option>Sport</option>
          <option>Music</option>
          <option>Other</option>
        </select>
      </div>
    </div>
    <div class="col-md-3 pr-0">
      <div class="form-inline">
        <label class="mx-2" for="order_by">Sort by:</label>
        <select class="form-control" id="order_by" name = "order_by">
          <option selected value="pricelow">Price (low to high)</option>
          <option value="pricehigh">Price (high to low)</option>
          <option value="date">Soonest expiry</option>
        </select>
      </div>
    </div>
    <div class="col-md-1 px-0">
      <button type="submit" class="btn btn-primary" name="submit-search">Search</button>
    </div>
  </div>
</form>
</div> <!-- end search specs bar -->


</div>

<?php
  // Retrieve these from the URL
  if (!isset($_GET['keyword'])) {
  // ✅TODO: Define behavior if a keyword has not been specified.
    $keyword = '';
  }
  else {
    $keyword = $_GET['keyword'];
  }

  if (!isset($_GET['cat'])) {
    // ✅TODO: Define behavior if a category has not been specified.
    $category = 'everything';
  }
  else {
    $category = $_GET['cat'];
  }
  
  if (!isset($_GET['order_by'])) {
    // ✅TODO: Define behavior if an order_by value has not been specified.
    $ordering = 'pricelow';

  }
  else {
    $ordering = $_GET['order_by'];
  }
  
  if (!isset($_GET['page'])) {
    $curr_page = 1;
  }
  else {
    $curr_page = $_GET['page'];
  }

  /* ✅TODO: Use above values to construct a query. Use this query to 
     retrieve data from the database. (If there is no form data entered,
     decide on appropriate default value/default query to make. */

  /* Select everything if 3 filters(keyword, category, ordering) are null,
     if category or ordering is set, concatenate the sql queries written in if.*/
  $query = "SELECT items.item_id, seller_username, category, create_datetime, item_name, description, reserve_price, end_datetime, IFNULL(max(bid), opening_price) AS showed_price, end_datetime<CURRENT_TIMESTAMP isend
        FROM items LEFT JOIN auction_log ON items.item_id=auction_log.item_id
        WHERE (items.item_name LIKE '%$keyword%'
        OR items.description LIKE '%$keyword%') 
        GROUP BY items.item_id";
  if($category != 'everything') {
    $query = "SELECT items.item_id, seller_username, category, create_datetime, item_name, description, reserve_price, end_datetime, IFNULL(max(bid), opening_price) AS showed_price, end_datetime<CURRENT_TIMESTAMP isend
        FROM items LEFT JOIN auction_log ON items.item_id=auction_log.item_id
        WHERE (items.item_name LIKE '%$keyword%'
        OR items.description LIKE '%$keyword%') AND items.category = '$category'
        GROUP BY items.item_id";
  }
  //√ Fixed BUG: items.opening_price needs to be changed. 
  //✅ Fixed BUG: expired auction item should be displayed at the last of the list.
    // echo $results_per_page;
  /* For the purposes of pagination, it would also be helpful to know the
     total number of results that satisfy the above query */
  // $num_results = 96; // ✅TODO: Calculate me for real
  $results = mysqli_query($connection, $query);
  $results_fetched = mysqli_fetch_all($results);
  $num_results = mysqli_num_rows($results);
  $results_per_page = 3;
  $max_page = ceil($num_results / $results_per_page);
  
  $page_n=($curr_page-1)*$results_per_page;

  // Add items.auction_status ASC to display auctions that haven't ended yet first
  if($ordering == "pricelow") {
    $query .= " ORDER BY isend ASC, showed_price ASC limit $results_per_page offset $page_n";
  }
  if($ordering == "pricehigh") {
    $query .= " ORDER BY isend ASC, showed_price DESC limit $results_per_page offset $page_n";
  }
  if($ordering == "date") {
    $query .= " ORDER BY isend ASC, items.end_datetime ASC limit $results_per_page offset $page_n";
  }
?>

<div class="container mt-5">

<!-- ✅TODO: If result set is empty, print an informative message. Otherwise... -->
<!-- ✅Solved BUG: Get rid of the arrows when there's no result. -->
<?php
if (!isset($results) || $num_results == 0) {
  echo "There are no results matching your search. ";
  $max_page = 1;
}
?>

<ul class="list-group">

<!-- ✅TODO: Use a while loop to print a list item for each auction listing
     retrieved from the query -->

<?php

$message_display = mysqli_query($connection, $query);
$sql_display = mysqli_fetch_all($message_display);

foreach($sql_display as $index => $infos) {
  // To get the num of bids 
  $bids_num_query = "SELECT COUNT(*) FROM auction_log WHERE item_id = $infos[0]";
  if ($results) {
    $bid_num_result = mysqli_query($connection, $bids_num_query);
    $bid_num_row = mysqli_fetch_row($bid_num_result);
    $num_bids = $bid_num_row[0];
  } else {
    $num_bids = 0;
  }

  // To get the current price of each items
  $current_price_query = "SELECT MAX(bid) FROM auction_log WHERE item_id = $infos[0]";
  $opening_price_query = "SELECT opening_price FROM items WHERE item_id = $infos[0]"; 
  $current_price_result = mysqli_query($connection, $current_price_query);
  if ($current_price_result) {
    $price_results_row = mysqli_fetch_row($current_price_result);
    $current_price = $price_results_row[0];
  }
  if ($current_price == 0) {
    $opening_price_result = mysqli_query($connection, $opening_price_query);
    $opening_price_row = mysqli_fetch_row($opening_price_result);
    $current_price = $opening_price_row[0];
  }

  $item_id = $infos[0];
  $title = $infos[4];
  $description = $infos[5];
  $end_date = new DateTime($infos[7]);
  $now = new DateTime(); 
  print_listing_li($item_id, $title, $description, $current_price, $num_bids, $end_date);
}


?>

</ul>

<!-- Pagination for results listings -->
<nav aria-label="Search results pages" class="mt-5">
  <ul class="pagination justify-content-center">
  
<?php

  // Copy any currently-set GET variables to the URL.
  $querystring = "";
  foreach ($_GET as $key => $value) {
    if ($key != "page") {
      $querystring .= "$key=$value&amp;";
    }
  }
  
  $high_page_boost = max(3 - $curr_page, 0);
  $low_page_boost = max(2 - ($max_page - $curr_page), 0);
  $low_page = max(1, $curr_page - 2 - $low_page_boost);
  $high_page = min($max_page, $curr_page + 2 + $high_page_boost);
  
  if ($curr_page != 1) {
    echo('
    <li class="page-item">
      <a class="page-link" href="browse.php?' . $querystring . 'page=' . ($curr_page - 1) . '" aria-label="Previous">
        <span aria-hidden="true"><i class="fa fa-arrow-left"></i></span>
        <span class="sr-only">Previous</span>
      </a>
    </li>');
  }
    
  for ($i = $low_page; $i <= $high_page; $i++) {
    if ($i == $curr_page) {
      // Highlight the link
      echo('
    <li class="page-item active">');
    }
    else {
      // Non-highlighted link
      echo('
    <li class="page-item">');
    }
    
    // Do this in any case
    echo('
      <a class="page-link" href="browse.php?' . $querystring . 'page=' . $i . '">' . $i . '</a>
    </li>');
  }
  
  if ($curr_page != $max_page) {
    echo('
    <li class="page-item">
      <a class="page-link" href="browse.php?' . $querystring . 'page=' . ($curr_page + 1) . '" aria-label="Next">
        <span aria-hidden="true"><i class="fa fa-arrow-right"></i></span>
        <span class="sr-only">Next</span>
      </a>
    </li>');
  }
?>

  </ul>
</nav>


</div>

<!-- Added for the CSS-styled success message -->
<?php if (isset($_GET['success'])) : ?>
          <div class="success"><?php echo $_GET['success']; ?></div>
        <?php endif; ?>
<!-- End for the CSS-styled success message -->
<!-- Added for the CSS-styled error message -->
<?php if (isset($_GET['error'])) : ?>
          <div class="error"><?php echo $_GET['error']; ?></div>
        <?php endif; ?>
<!-- End for the CSS-styled error message -->


<?php include_once("footer.php")?>

