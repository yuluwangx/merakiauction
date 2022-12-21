<?php include_once("header.php");?>

<div class="container my-5">

<?php

// This function takes the form data and adds the new auction to the database.

/* TODO #1: Connect to MySQL database (perhaps by requiring a file that
            already does this). */
include 'dbconnect.php';

/* TODO #2: Extract form data into variables. Because the form was a 'post'
            form, its data can be accessed via $POST['auctionTitle'], 
            $POST['auctionDetails'], etc. Perform checking on the data to
            make sure it can be inserted into the database. If there is an
            issue, give some semi-helpful feedback to user. */
session_start();
$seller_username=$_SESSION['username'];
date_default_timezone_set('Europe/London');
$start_date= date('Y-m-d H:i:s', time());

if (isset($_POST['createAuctionSubmit'])) {
    $itemName = mysqli_real_escape_string($connection, $_POST['itemName']);
    $description = mysqli_real_escape_string($connection, $_POST['description']);
    $category = mysqli_real_escape_string($connection, $_POST['category']);
    $openingPrice = mysqli_real_escape_string($connection, $_POST['openingPrice']);
    $reservePrice = mysqli_real_escape_string($connection, $_POST['reservePrice']);
    $endDate = mysqli_real_escape_string($connection, $_POST['endDate']);
    $sellerUsername = mysqli_real_escape_string($connection, $seller_username);
    $startDate = mysqli_real_escape_string($connection, $start_date);
    if ($_POST['endDate']<$start_date){
      $error = "Please make sure the end date is later than the current time.";
      header("Location: create_auction.php?error=" . urlencode($error));
    }


    if (!isset($itemName) || $itemName == '' || !isset($category) || $category == '' || !isset($openingPrice) || $openingPrice == '' || !isset($reservePrice) || $reservePrice == '' || !isset($endDate) || $endDate == '' || !isset($sellerUsername) || $sellerUsername == ''|| !isset($startDate) || $startDate == ''){
      $error = "Please fill in all necessary fields";
      //die($error); //Depreciated 
      header("Location: create_auction.php?error=" . urlencode($error));
    }
    else {
      $query = "INSERT INTO items (item_name, description, category, opening_price, reserve_price, end_datetime, create_datetime, seller_username ) 
                VALUES ('$itemName', '$description', '$category', '$openingPrice', '$reservePrice', '$endDate', '$startDate','$sellerUsername')";
      if (!mysqli_query($connection, $query)) {
        die('Error: ' . mysqli_error($connection));
      }
    }
}

   

/* TODO #3: If everything looks good, make the appropriate call to insert
            data into the database. */
            

// If all is successful, let user know.
echo('<div class="text-center">Auction successfully created! <a href="mylistings.php">View your new listing.</a></div>');


?>

</div>


<?php include_once("footer.php")?>