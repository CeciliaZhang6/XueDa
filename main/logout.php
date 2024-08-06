<?php
// logout.php

session_start();
include_once("dbh.php");

$_SESSION["login_status"] = FALSE;
$_SESSION["curr_user"] = "guest";
$_SESSION["curr_user_name"] = "smart guest";
$_SESSION["curr_user_bio"] = "I am guest";

$conn->close();

header("Location: index.php");
?>