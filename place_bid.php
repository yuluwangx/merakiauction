<?php include_once("dbconnect.php")?>
<?php require("utilities.php")?>

<?php
// √TODO: Extract $_POST variables, check they're OK, and attempt to make a bid.
// Notify user of success/failure and redirect/give navigation options.

  session_start();
  
  if (isset($_POST['submitBid'])) {
    // continue to improve using POST method to get the itemid
    $item_id = $_POST['item_id'];
    $buyer_username = mysqli_real_escape_string($connection, $_SESSION['username']);
    $bid = mysqli_real_escape_string($connection, $_POST['inputNumber']);

    date_default_timezone_set('Europe/London');
    $bid_datetime= date('Y-m-d H:i:s', time());

    // if ($_POST['endDate']<$start_date){
      // $error = "Please make sure the end date is later than the current time.";
      // header("Location: create_auction.php?error=" . urlencode($error));
    $query = "SELECT MAX(bid) FROM auction_log WHERE item_id='$item_id'";
    $messages1 = mysqli_query($connection, $query);
    $row1 = mysqli_fetch_assoc($messages1);
    $current_price = $row1['MAX(bid)'];
    //Create variable to hold the return url with itemid
    $return_url_err = "Location: listing.php?item_id=".$item_id."&error=";

    // to get opening_price and item_name
    $opening_price_query = "SELECT * FROM items WHERE item_id='$item_id'"; 
    $messages = mysqli_query($connection, $opening_price_query); 
    $row = mysqli_fetch_assoc($messages);
    $opening_price = $row['opening_price'];
    $item_name = $row['item_name'];


    if (!isset($bid) || $bid == '' ){
      $error = "Please fill in a bid price.";
      // die($error); 
      header($return_url_err. urlencode($error));
      exit();
      // header("Location: browse.php?success=" . urlencode($error));
  		}
    elseif($_SESSION['account_type'] != "buyer"){
      $profile_error = "Please log in as a buyer.";
      header($return_url_err. urlencode($profile_error));
      exit();
    }
    elseif($bid <= $current_price || $bid <= $opening_price){
      $error1 = "Please bid a higher price than the current bid.";
      header($return_url_err. urlencode($error1));
      exit();
    }
    else {
      // Store the new bid into our database table `auction_log`.
      $query = "INSERT INTO auction_log (item_id, buyer_username, bid, bid_datetime) 
                VALUES ('$item_id','$buyer_username', '$bid','$bid_datetime')";

      // $bid_email_query = "SELECT email FROM `users` u, `auction_log` a
      //   WHERE a.buyer_username = u.username AND a.item_id = '$item_id' AND a.buyer_username != '$buyer_username'";

      // Get every DISTINCT buyer's email who previously made a bid on this item AND added this item to their watchlist. 
      $bid_email_query = "SELECT DISTINCT email FROM `users` u, `auction_log` a, `watchlist` w
        WHERE (a.buyer_username = u.username AND a.item_id = '$item_id' AND a.buyer_username != '$buyer_username') OR (w.item_id = '$item_id' AND w.username != '$buyer_username')";

      $bid_email_sql = mysqli_query($connection, $bid_email_query);
      $email_result = mysqli_fetch_all($bid_email_sql);

      // Calling sendmail() function from utilities.php
      // Buyers can receive emailed updates on bids on those items they bid on.
      foreach ($email_result as $index => $infos) {
        // Set up the information required for sendmail() function. 
        $email_recipient = $infos[0];
        $email_subject = "Meraki Auction Reminder: New bid made on $item_name";
        // Slightly changed the phrase as users who watched items or bidded items are both in the email list.
        $email_content = "Hello $email_recipient: <br/><br/>  The item that you watched or bidded on: $item_name, has a new bid, and the new price is $bid. ";
        sendmail($email_recipient, $email_subject, $email_content);
      }
    
      if (!mysqli_query($connection, $query)) {
        die('Error: ' . mysqli_error($connection));
      }
      else {
        //Print out a success message. Jump to browse.php instead of index. Bake in success messages here.
        $success = "Your bid is successful!";
        header("Location: listing.php?item_id=".$item_id."&success=" . urlencode($success));
        //header('Location: index.php');
        exit();
    	}
    }
  }

?>