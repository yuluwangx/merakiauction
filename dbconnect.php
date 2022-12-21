<?php
  

  $connection = new mysqli("localhost:8889", "auctionadmin", "adminpassword", "auction");

  if (mysqli_connect_errno())
    echo 'Failed to connect to the MySQL server: '. mysqli_connect_error();

?>