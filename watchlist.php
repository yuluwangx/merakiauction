<?php include_once("header.php")?>
<?php require("utilities.php")?>
<?php include_once("dbconnect.php")?>


<div class="container">

<h2 class="my-3">My watchlist</h2>

<?php

 // ✅Check this. TODO: Check user's credentials (cookie/session).
  
session_start();
$buyer_username = mysqli_real_escape_string($connection, $_SESSION['username']);

$watchlist_query = "SELECT items.item_id, seller_username, category, create_datetime, item_name, description, reserve_price, end_datetime, IFNULL(max(bid), opening_price) AS showed_price, COUNT(bid)
        FROM items LEFT JOIN auction_log ON items.item_id=auction_log.item_id LEFT JOIN watchlist ON watchlist.item_id = items.item_id
        WHERE watchlist.username = '$buyer_username'
        GROUP BY items.item_id";

$watchlist_sql = mysqli_query($connection, $watchlist_query);


while ($sql_display = mysqli_fetch_array($watchlist_sql)){

    $num_bids = $sql_display[9];
    $current_price = $sql_display[8];
    $item_id = $sql_display[0];
    $title = $sql_display[4];
    $description = $sql_display[5];
    $end_date = new DateTime($sql_display[7]);
    $now = new DateTime(); 

    print_listing_li($item_id, $title, $description, $current_price, $num_bids, $end_date);
}
  
?>

<?php include_once("footer.php")?>