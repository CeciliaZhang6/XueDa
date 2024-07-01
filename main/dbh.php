<?php
// dbh.php
  $servername = "localhost";
  $username = "uccaciyo_cc";
  $password = "qwe123qwe";
  $dbname = "uccaciyo_csp1";
  session_start();
  $conn = new mysqli($servername, $username, $password, $dbname);
  
  if (!$conn){
    die("Connection failed: " . $conn->connect_error);
  }

?>
