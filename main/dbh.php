<?php
// dbh.php
  $servername = "localhost";
  $username = "uccaciyo_cc";
  $password = "qwe123qwe";
  $dbname = "uccaciyo_csp1";
  session_start();
  $conn = new mysqli($servername, $username, $password, $dbname);

  // allow API
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
  header("Access-Control-Allow-Headers: Content-Type");

  if (!$conn){
    die("Connection failed: " . $conn->connect_error);
  }

?>
