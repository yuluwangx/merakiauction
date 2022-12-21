<?php include_once("header.php")?>
<?php require("utilities.php")?>

<!-- Incorporate dbconnect only once -->
<?php include_once("dbconnect.php")?>

<?php
  // Get info from the URL:
  $item_id = $_GET['item_id'];

  //Use item_id to make a query to the database.

  $query = "SELECT * FROM items WHERE item_id='$item_id'";
  $messages = mysqli_query($connection, $query);
  $row = mysqli_fetch_assoc($messages);

  $title = $row['item_name'];
  $description = $row['description'];
  $opening_price = $row['opening_price'];
  $reserve_price = $row['reserve_price'];
  $create_datetime = new DateTime($row['create_datetime']);
  $end_time = new DateTime($row['end_datetime']);
  //$end_time = new DateTime('2020-11-02T00:00:00');


  // DELETEME: For now, using placeholder data.
  $query = "SELECT MAX(bid), MAX(bid_datetime) FROM auction_log WHERE item_id='$item_id'";
  $messages1 = mysqli_query($connection, $query);
  $row1 = mysqli_fetch_assoc($messages1);
  $current_price = $row1['MAX(bid)'];
  $latest_bid_datetime = new DateTime($row1['MAX(bid_datetime)']);
  
  // To show opening price instead if no bidding
  if ($current_price == "") {
    $current_price = $opening_price;
  }

  $query2 = "SELECT count(item_id) AS 'count' FROM auction_log WHERE item_id='$item_id'";
  $messages2 = mysqli_query($connection, $query2);
  $row = mysqli_fetch_array($messages2);
  $num_bids = $row['count'];
  

  // TODO: Note: Auctions that have ended may pull a different set of data,
  //       like whether the auction ended in a sale or was cancelled due
  //       to lack of high-enough bids. Or maybe not.
  
  // Calculate time to auction end:
  $now = new DateTime();
  
  if ($now < $end_time) {
    $time_to_end = date_diff($now, $end_time);
    $time_remaining = ' (in ' . display_time_remaining($time_to_end) . ')';
  }
  
  // TODO: If the user has a session, use it to make a query to the database
  //       to determine if the user is already watching this item.
  //       For now, this is hardcoded.
  
  //session_start();
  //Log says session already started. Do we need this in some rare cases?  
  $has_session = $_SESSION['logged_in'];

  if ($has_session) {
    $username = mysqli_real_escape_string($connection, $_SESSION['username']);
    $query3 = "SELECT * FROM watchlist WHERE item_id='$item_id' AND username='$username'";
    $messages3 = mysqli_query($connection, $query3);
    $row3 = mysqli_fetch_assoc($messages3);
    
    if ($item_id == $row3['item_id']) {
      $watching = true;
    }
    else {
      $watching = false;
    }
  }
?>


<div class="container">

<div class="row"> <!-- Row #1 with auction title + watch button -->
  <div class="col-sm-8"> <!-- Left col -->
    <h2 class="my-3"><?php echo($title); ?></h2>
  </div>
  <div class="col-sm-4 align-self-center"> <!-- Right col -->
<?php
  /* The following watchlist functionality uses JavaScript, but could
     just as easily use PHP as in other places in the code */
  if ($now < $end_time):
?>
    <div id="watch_nowatch" <?php if ($has_session && $watching) echo('style="display: none"');?> >
      <button type="button" class="btn btn-outline-secondary btn-sm" onclick="addToWatchlist()">+ Add to watchlist</button>
    </div>
    <div id="watch_watching" <?php if (!$has_session || !$watching) echo('style="display: none"');?> >
      <button type="button" class="btn btn-success btn-sm" disabled>Watching</button>
      <button type="button" class="btn btn-danger btn-sm" onclick="removeFromWatchlist()">Remove watch</button>
    </div>

<?php endif /* Print nothing otherwise */ ?>
  </div>
</div>

<div class="row"> <!-- Row #2 with auction description + bidding info -->
  <div class="col-sm-8"> <!-- Left col with item info -->

    <div class="itemDescription">
    <?php echo($description); ?>
    </div>

  </div>

  <div class="col-sm-4"> <!-- Right col with bidding info -->

    <p>
<?php if ($now > $end_time): ?>
     This auction ended <?php echo(date_format($end_time, 'j M H:i')) ?>
     <!-- TODO: Print the result of the auction here? -->
<?php else: ?>
     Auction ends <?php echo(date_format($end_time, 'Y M d H:i') . $time_remaining) ?></p>
    <p class="lead">Current bid: £<?php echo(number_format($current_price, 2)) ?></p>
    <p class="lead">Number of bids: <?php echo(number_format($num_bids)) ?></p>
    <p>

<?php if ($latest_bid_datetime): ?>
    Lastest bid time: <?php echo(date_format($latest_bid_datetime, 'j M H:i')) ?>
<?php else: ?>
    Lastest bid time: <?php echo(date_format($create_datetime, 'j M H:i')) ?></p>
<?php endif ?>

    <!-- Bidding form -->
    <form method="POST" action="place_bid.php">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">£</span>
        </div>
      <!-- transfer item_id from listing.php to place_bid.php -->
      <input type="hidden" name="item_id" value="<?php echo ($item_id) ?>">
	    <input type="number" class="form-control" name ="inputNumber" id="bid" step=".01">
      </div>
      <button type="submit" class="btn btn-primary form-control" name ="submitBid">Place bid</button>
    </form>
<?php endif ?>

  </div> <!-- End of right col with bidding info -->

  </div> <!-- End of row #2 -->

  





<?php include_once("footer.php")?>


<script> 
// JavaScript functions: addToWatchlist and removeFromWatchlist.

function addToWatchlist(button) {
  console.log("These print statements are helpful for debugging btw");
  //console.log("<?php echo($username);?>")
  //console.log("<?php echo('testuser');?>")

  // This performs an asynchronous call to a PHP function using POST method.
  // Sends item ID as an argument to that function.
  $.ajax('watchlist_funcs.php', {
    type: "POST",
    data: {functionname: 'add_to_watchlist', arguments: [<?php echo($item_id);?>,"<?php echo($username);?>"]},

    success: 
      function (obj, textstatus) {
        // Callback function for when call is successful and returns obj
        console.log("Success");
        var objT = obj.trim();
 
        if (objT == "success") {
          $("#watch_nowatch").hide();
          $("#watch_watching").show();
        }
        else {
          var mydiv = document.getElementById("watch_nowatch");
          mydiv.appendChild(document.createElement("br"));
          mydiv.appendChild(document.createTextNode("Add to watch failed. Try again later."));
        }
      },

    error:
      function (obj, textstatus) {
        console.log("Error");
      }
  }); // End of AJAX call

} // End of addToWatchlist func

function removeFromWatchlist(button) {
  // This performs an asynchronous call to a PHP function using POST method.
  // Sends item ID as an argument to that function.
  $.ajax('watchlist_funcs.php', {
    type: "POST",
    data: {functionname: 'remove_from_watchlist', arguments: [<?php echo($item_id);?>,"<?php echo($username);?>"]},

    success: 
      function (obj, textstatus) {
        // Callback function for when call is successful and returns obj
        console.log("Success");
        var objT = obj.trim();
 
        if (objT == "success") {
          $("#watch_watching").hide();
          $("#watch_nowatch").show();
        }
        else {
          var mydiv = document.getElementById("watch_watching");
          mydiv.appendChild(document.createElement("br"));
          mydiv.appendChild(document.createTextNode("Watch removal failed. Try again later."));
        }
      },

    error:
      function (obj, textstatus) {
        console.log("Error");
      }
  }); // End of AJAX call

} // End of addToWatchlist func
</script>

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
<?php
    $item_id = $_GET['item_id'];
    $winner_query = "SELECT buyer_username FROM auction_log WHERE bid = '$current_price' and bid >= '$reserve_price' and item_id='$item_id'";
    $message_display = mysqli_query($connection, $winner_query);
    $sql_display = mysqli_fetch_array($message_display);
    $winner = $sql_display[0];

 if ($now >= $end_time and $_SESSION['account_type'] == "buyer") {

      if ($_SESSION['username'] == $winner){
        echo("Congratulations " . $winner . "!! You have won the auction!!");
      }
      else {
        echo("Someone else won this auction.");
      }
  }
  elseif ($now >= $end_time and $_SESSION['account_type'] == "seller") {
      if ($sql_display) {
        echo("Congratulations! Your item was sold to " . $winner . ".");
      } 
      else{
        echo("Unfortunately, no bids greater than the reserve price were received.");
      }
  }

$auction_history_query = "SELECT buyer_username,bid, bid_datetime FROM auction_log WHERE item_id = '$item_id' ORDER BY bid DESC ";

$results = mysqli_query($connection, $auction_history_query);

while ($row = mysqli_fetch_array($results))
{
$buyer_username = $row['buyer_username'];
$item_id = $row['item_id'];
$item_name = $row['item_name'];
$bid = $row['bid'];
$bid_datetime = $row['bid_datetime'];

echo('
    <li class="list-group-item d-flex justify-content-between">
    <div class="p-0 mr-5">' . $buyer_username .'</div>
    <div class="text-center text-nowrap">'. $bid_datetime . '</div>
    <div class="text-center text-nowrap"><span style="font-size: 1.0em">£' . $bid . '<br/></div></li>'
  );
}

?>