<?php include_once("header.php")?>
<?php require("utilities.php")?>

<div class="container">

<h2 class="my-3">My listings</h2>

<?php
  // This page is for showing a user the auction listings they've made.
  // It will be pretty similar to browse.php, except there is no search bar.
  // This can be started after browse.php is working with a database.
  // Feel free to extract out useful functions from browse.php and put them in
  // the shared "utilities.php" where they can be shared by multiple files.
  
  
  // TODO: Check user's credentials (cookie/session).
  
  // TODO: Perform a query to pull up their auctions.
  
  // TODO: Loop through results and print them out as list items.
  
?>

<?php include_once("dbconnect.php")?>

<?php
  
 // ✅Check this. TODO: Check user's credentials (cookie/session).
  
session_start();
$seller_username = mysqli_real_escape_string($connection, $_SESSION['username']);

$query_seller_item = "SELECT items.item_id, seller_username, category, create_datetime, item_name, description, reserve_price, end_datetime, IFNULL(max(bid), opening_price) AS showed_price, COUNT(bid)
        FROM items LEFT JOIN auction_log ON items.item_id=auction_log.item_id
        WHERE seller_username = '$seller_username'
        GROUP BY items.item_id ORDER BY item_name";
$message_display = mysqli_query($connection, $query_seller_item);

while ($sql_display = mysqli_fetch_array($message_display)){

    $num_bids = $sql_display[9];
    $current_price = $sql_display[8];
    $item_id = $sql_display[0];
    $title = $sql_display[4];
    $description = $sql_display[5];
    $end_date = new DateTime($sql_display[7]);
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
      
        // Print HTML
        echo('
          <li class="list-group-item d-flex justify-content-between">
          <div class="p-2 mr-5"><h5><a href="listing.php?item_id=' . $item_id . '">' . $title . '</a></h5>' . $description_shortened . '</div>
          <div class="text-center text-nowrap"><span style="font-size: 1.5em">£' . number_format($current_price, 2) . '</span><br/>' . $num_bids . $bid . '<br/>' . $time_remaining . '</div>
        </li>'
        );

        
}
  
?>

<?php include_once("footer.php")?>