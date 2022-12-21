<?php

// TODO: Extract $_POST variables, check they're OK, and attempt to create
// an account. Notify user of success/failure and redirect/give navigation 
// options.
  include 'dbconnect.php';

  if (isset($_POST['name_submit'])) {
    $accountType = mysqli_real_escape_string($connection, $_POST['accountType']);
  	$country = mysqli_real_escape_string($connection, $_POST['country']);
  	$username = mysqli_real_escape_string($connection, $_POST['username']);
  	$email = mysqli_real_escape_string($connection, $_POST['email']);
  	$firstname = mysqli_real_escape_string($connection, $_POST['firstname']);
  	$familyname = mysqli_real_escape_string($connection, $_POST['familyname']);
  	$tel = mysqli_real_escape_string($connection, $_POST['tel']);
  	$address = mysqli_real_escape_string($connection, $_POST['address']);
  	$password = mysqli_real_escape_string($connection, md5($_POST['password']));
  	$passwordConfirmation = mysqli_real_escape_string($connection, $_POST['passwordConfirmation']);

    //To ensure all fields are filled
	  if (!isset($accountType) || $accountType == '' || !isset($country) || $country == '' || !isset($username) || $username == '' || !isset($email) || $email == '' || !isset($firstname) || $firstname == '' || !isset($familyname) || $familyname == '' || !isset($tel) || $tel == '' || !isset($address) || $address == '' || !isset($password) || $password == '' || !isset($passwordConfirmation) || $passwordConfirmation == '' ) {
      $error = "Please fill in all necessary fields";
      //die($error); //Depreciated 
      header("Location: register.php?error=" . urlencode($error));
      exit();
    }
    
    //Check pw==pwconfirm and change code below
    if ($_POST['password'] != $_POST['passwordConfirmation']){
    $errpw = "Passwords do not match. Please try again.";
    header("Location: register.php?error=" . urlencode($errpw));
      exit();
    }
    //End of Check pw==pwconfirm and change code

    $username_query = "SELECT username FROM users WHERE username='$username'";
    $username_sql = mysqli_query($connection, $username_query);
    $row_username = mysqli_fetch_assoc($username_sql);

    if ($row_username['username']==$username){
      $errpw = "Username already exists. Please try again.";
      header("Location: register.php?error=" . urlencode($errpw));
      exit();
    }
    else {
      $query = "INSERT INTO users (username, profile, password, firstname, familyname, email, tel, address, country) 
                VALUES ('$username', '$accountType', '$password', '$firstname', '$familyname', '$email', '$tel', '$address', '$country')";
      if (!mysqli_query($connection, $query)) {
        die('Error: ' . mysqli_error($connection));
      }
      else {
      	//Print out a success message. Jump to browse.php instead of index. Bake in success messages here.
        $success = "Registration Successful! You may Login now.";
        header("Location: browse.php?success=" . urlencode($success));
        //header('Location: index.php');
        exit();
      }
    }
  }

?>