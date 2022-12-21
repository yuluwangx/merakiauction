<?php include_once("header.php")?>
<?php require("utilities.php")?>
<?php include_once("dbconnect.php")?>

<div class="container">

<h2 class="my-3">Recommendations for you</h2>

  <!-- // This page is for showing a buyer recommended items based on their bid 
  // history. It will be pretty similar to browse.php, except there is no 
  // search bar. This can be started after browse.php is working with a database.
  // Feel free to extract out useful functions from browse.php and put them in
  // the shared "utilities.php" where they can be shared by multiple files.
  
  
  //  ✅TODO: Check user's credentials (cookie/session).
  
  //  ✅TODO: Perform a query to pull up auctions they might be interested in.
  
  //  ✅TODO: Loop through results and print them out as list items. -->

<?php
session_start();
$buyer_username = mysqli_real_escape_string($connection, $_SESSION['username']);
$query_interest = "SELECT DISTINCT item_id FROM auction_log 
                    WHERE buyer_username = '$buyer_username'";
$interest_display = mysqli_query($connection,$query_interest);

if (mysqli_num_rows($interest_display)==0){echo("Please check back after you make your very first bid.");}

$has_recommendation = false;
$recom_array=array();

while ($sql_display = mysqli_fetch_array($interest_display)){
  $interest_itemid = $sql_display[0];

  $query_recommendation = "SELECT auction_log.item_id, COUNT(buyer_username) 
                           FROM `auction_log` JOIN `items` ON auction_log.item_id=items.item_id
                           WHERE buyer_username IN
                          (
                           SELECT buyer_username
                           FROM `auction_log`
                           WHERE item_id= '$interest_itemid' AND buyer_username!='$buyer_username'
                          )
                          AND auction_log.item_id NOT IN (SELECT DISTINCT item_id FROM auction_log Where buyer_username = '$buyer_username')
                          AND end_datetime > current_timestamp
                          GROUP BY 1 ORDER BY 2 DESC LIMIT 1";
  $recommendation_display = mysqli_query($connection,$query_recommendation);
  $item_display = mysqli_fetch_array($recommendation_display);
  $recommendation_item_id = $item_display[0];
  $recom_array[]=$recommendation_item_id;
}

$unique_recom=array_unique($recom_array);

foreach($unique_recom as $recommendation_item_id){
  $query_item_info = "SELECT item_name, description, reserve_price, end_datetime, IFNULL(max(bid), opening_price) AS showed_price, COUNT(bid) FROM items LEFT JOIN auction_log ON items.item_id=auction_log.item_id
    WHERE items.item_id = '$recommendation_item_id'";
  $message_display = mysqli_query($connection, $query_item_info);
  $display = mysqli_fetch_array($message_display);

    $num_bids = $display[5];
    $current_price = $display[4];
    $item_id = $recommendation_item_id;
    $title = $display[0];
    $description = $display[1];
    $end_date = new DateTime($display[3]);
    $now = new DateTime(); 
     

      // Truncate long descriptions
        if (strlen($description) > 250) {
          $description_shortened = substr($description, 0, 250) . '...';
        }
        else {
          $description_shortened = $description;
        }
        
        // Fix language of bid vs. bids
        if ($num_bids == 1) {
          $bid = ' bid';
        }
        else {
          $bid = ' bids';
        }
      
        // Calculate time to auction end
        $now = new DateTime();
        if ($now > $end_date) {
          $time_remaining = 'This auction has ended';
        }
        else {
          // Get interval:
          $time_to_end = date_diff($now, $end_date);
          $time_remaining = display_time_remaining($time_to_end) . ' remaining';
        }

        if ($item_display == 0) {
          echo("");
        }
        else {

        $has_recommendation = true;
          
  // Print HTML
        echo "<br>";
        echo('
          <div class="p-2 mr-5"><h5>You may be interested in:</div>
          <li class="list-group-item d-flex justify-content-between">
          <div class="p-2 mr-5"><h5><a href="listing.php?item_id=' . $item_id . '">' . $title . '</a></h5>' . $description_shortened . '</div>
          <div class="text-center text-nowrap"><span style="font-size: 1.5em">£' . number_format($current_price, 2) . '</span><br/>' . $num_bids . $bid . '<br/>' . $time_remaining . '</div>
        </li>'
        );
  }
}

  if (!$has_recommendation) {
          echo("There is no recommendation at the moment. Please check back later.");
        }
  echo($end_date);
?>