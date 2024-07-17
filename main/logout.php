<?php
// logout.php

session_start();
include_once("dbh.php");

$_SESSION["login_status"] = FALSE;
$_SESSION["curr_user"] = "guest";

header("Location: index.php");
?>