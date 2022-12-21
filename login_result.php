<?php

// TODO: Extract $_POST variables, check they're OK, and attempt to login.
// Notify user of success/failure and redirect/give navigation options.

// For now, I will just set session variables and redirect.

include 'dbconnect.php';
if (isset($_POST['signin_submit'])) {
	$username = mysqli_real_escape_string($connection, $_POST['username']);
  $password = mysqli_real_escape_string($connection, md5($_POST['password']));

if (!isset($username) || $username == '' || !isset($password) || $password == '') {
      $error = "Please fill in all necessary fields";
      header("Location: browse.php?error=" . urlencode($error));
      exit();
    }
    else {
      $query = "SELECT username,'$password'=password AS 'check', profile FROM users WHERE username='$username'";
      $result = mysqli_query($connection, $query);
      $row = mysqli_fetch_assoc($result);
    }
  }

if ($row['check'] == 0){
$errorlogin = "Incorrent Login Details. Try Again.";
header("Location: browse.php?error=" . urlencode($errorlogin));
exit();
}

session_start();
$_SESSION['logged_in'] = true;
$_SESSION['username'] = $row['username'];
$_SESSION['account_type'] = $row['profile'];

echo "You are now logged in! You will be redirected shortly.";

// Redirect to index after 2 seconds
header("refresh:2;url=index.php");

?>