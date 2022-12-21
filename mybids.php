<?php include_once("header.php")?>
<?php require("utilities.php")?>
<?php include_once("dbconnect.php")?>


<div class="container">

<h2 class="my-3">My bids</h2>

<?php
  
 // ✅Check this. TODO: Check user's credentials (cookie/session).
  
session_start();
$buyer_username = mysqli_real_escape_string($connection, $_SESSION['username']);

// $query_item = "SELECT items.item_id, seller_username, category, create_datetime, item_name, description, reserve_price, end_datetime, IFNULL(max(bid), opening_price) AS showed_price, COUNT(bid)
//         FROM items LEFT JOIN auction_log ON items.item_id=auction_log.item_id
//         WHERE buyer_username = '$buyer_username'
//         GROUP BY items.item_id";

  $query_item = "SELECT items.item_id, seller_username, category, create_datetime, item_name, description, reserve_price, end_datetime, IFNULL(max(bid), opening_price) AS showed_price, COUNT(bid), end_datetime<CURRENT_TIMESTAMP isend
        FROM items LEFT JOIN auction_log ON items.item_id=auction_log.item_id
        WHERE buyer_username = '$buyer_username'
        GROUP BY items.item_id
        ORDER BY isend";

$message_display = mysqli_query($connection, $query_item);

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

        //Futher bid price log
        $query_bid = "SELECT auction_log.`bid`, auction_log.`bid_datetime`, items.`item_name` FROM `auction_log`,`items` WHERE auction_log.`item_id` = items.`item_id` and buyer_username = '$buyer_username' and items.`item_id` = $item_id ORDER BY bid_datetime DESC";
        $results = mysqli_query($connection, $query_bid);
        while ($row = mysqli_fetch_array($results))
        {
            $item_name = $row['item_name'];
            $bid = $row['bid'];
            $bid_datetime = $row['bid_datetime'];

            echo('
                <li class="list-group-item d-flex justify-content-between">
                <div class="p-0 mr-5">'. $item_name .'</div>
                <div class="text-center text-nowrap">'. $bid_datetime . '</div>
                <div class="text-center text-nowrap"><span style="font-size: 1.0em">£' . $bid . '<br/></div></li>'
            );
        }
}
  
?>

<?php include_once("footer.php")?>