<?php include_once("dbconnect.php")?>
<?php require("utilities.php")?>

<!-- This PHP script is set to check every minute using cron job. -->

<!-- Logic of sending auction result emails -->
<!-- 1.     if($current_datetime > $end_datetime), the sendmail() will be called. -->
<!-- 1.1    if($highest_bid >= $reserve_price), send emails to the winner & seller -->
<!-- 1.2    if($highest_bid < $reserve_price), send email to the seller -->

<!-- SQL QUERY REQUIRED INFO: -->
<!-- when the latest bid made: item_name, buyer_address, reserve_price, end_datetime, buyer.email, seller.email, bid_datetime, highest_bid -->
<!-- So far seller.email is missing -->

<?php 
  $auction_result_query = "SELECT i.item_id, i.item_name, a.buyer_username, a.bid_datetime, i.end_datetime, u.email, i.reserve_price, a.bid, u.address, u2.username, u2.email
    FROM `auction_log` a, `users` u, `items` i, `users` u2, (SELECT item_id, max(a.bid) mb FROM `auction_log` a GROUP BY item_id) as t
    WHERE a.buyer_username = u.username AND i.item_id = a.item_id AND i.seller_username = u2.username AND
    a.bid=t.mb AND i.item_id=t.item_id AND i.email_status = '0'";
  $auction_result_sql = mysqli_query($connection, $auction_result_query);
  $list = mysqli_fetch_all($auction_result_sql);

  foreach($list as $key => $row){
  // Create required variables for the email sending function.
    $latest_bid_datetime = date($row[3]);
    $end_auction_datetime = date($row[4]);
    $buyer_email = $row[5];
    $seller_email = $row[10];
    $reserve_price = $row[6];
    $highest_bid = $row[7];
    $buyer_address = $row[8];
    $item_id = $row[0];
    $item_name = $row[1];

    date_default_timezone_set('Europe/London');
    $current_datetime= date('Y-m-d H:i:s', time());

    //echo $latest_bid_datetime;
    //echo ($latest_bid_datetime."\n" .$end_auction_datetime."\n" .$buyer_email."\n" .$seller_email."\n" .$reserve_price."\n" .$highest_bid."\n" .$buyer_address."\n" .$item_id."\n" .$item_name);

  if ($current_datetime > $end_auction_datetime && $highest_bid >= $reserve_price) {
      // In this case, auction is completed, hence 
      //    1.send email to the winner(buyer)

      $buyer_subject = "Meraki Auction: Congratulations on your bid";
      $buyer_content = "Hello $buyer_email: <br/><br/>  You have successfully bid on $item_name, please confirm your address detail: $buyer_address. Your item will be delivered in 3 business days. <br/><br/> Thanks for bidding on Meraki. ";
      sendmail($buyer_email, $buyer_subject, $buyer_content);

      //    2.Send email to the seller
      $seller_subject = "Meraki Auction: Your auction for $item_name is completed";
      $seller_content = "Hello $seller_email: <br/><br/>  Your item $item_name is successfully bidded, please deliver your product in 3 business days. <br/><br/> Thanks for choosing Meraki.";
      sendmail($seller_email, $seller_subject, $seller_content);

      // After sending email to the seller, update the email_status(ENUM) to '1'.
      // FYI: '0' -> ongoing, '1' -> finished.
      $status_update_query = "UPDATE `items` SET email_status = '1' WHERE item_id = $item_id";
      $status_sql = mysqli_query($connection, $status_update_query);

    } elseif ($current_datetime > $end_auction_datetime && $highest_bid < $reserve_price) {
      $seller_subject = "Meraki Auction: Your auction for $item_name is failed";
      $seller_content = "Hello $seller_email: <br/><br/>  We are sorry to inform you that your auction for $item_name is failed, good luck next time! <br/><br/> Thanks for choosing Meraki.";
      sendmail($seller_email, $seller_subject, $seller_content);

      // After sending email to the seller, update the email_status(ENUM) to '1'.
      // FYI: '0' -> ongoing, '1' -> finished.
      $status_update_query = "UPDATE `items` SET email_status = '1' WHERE item_id = $item_id";
      $status_sql = mysqli_query($connection, $status_update_query);

    }
  }

?>