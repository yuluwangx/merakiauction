 <?php include_once("dbconnect.php")?>
 <?php

if (!isset($_POST['functionname']) || !isset($_POST['arguments'])) {
  return;
}

// Extract arguments from the POST variables:
$item_id = $_POST['arguments'][0];
$username = mysqli_real_escape_string($connection, $_POST['arguments'][1]);

if ($_POST['functionname'] == "add_to_watchlist") {
  // TODO: Update database and return success/failure.
  //$item_id_1 = mysqli_real_escape_string($connection, $item_id);
  $query = "INSERT INTO watchlist (username, item_id) VALUES ('$username','$item_id')";
  if (!mysqli_query($connection, $query)) {
        die('Error: ' . mysqli_error($connection));
  }
  else {
    $res = "success";
  }
}
else if ($_POST['functionname'] == "remove_from_watchlist") {
  // TODO: Update database and return success/failure.
  //$item_id_1 = mysqli_real_escape_string($connection, $item_id);
  $query = "DELETE FROM watchlist WHERE username='$username' AND item_id='$item_id'";
  if (!mysqli_query($connection, $query)) {
        die('Error: ' . mysqli_error($connection));
  }
  else {
    $res = "success";
  }
}

// Note: Echoing from this PHP function will return the value as a string.
// If multiple echo's in this file exist, they will concatenate together,
// so be careful. You can also return JSON objects (in string form) using
// echo json_encode($res).
echo $res;

?>