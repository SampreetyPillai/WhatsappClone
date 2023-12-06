<?php
  $hostname = "localhost";
  $username = "root";
  $password = "mysql_pass_23";
  $dbname = "chatapp";
  

  $conn = mysqli_connect($hostname, $username, $password, $dbname);
  if(!$conn){
    echo "Database connection error".mysqli_connect_error();
  }
?>
