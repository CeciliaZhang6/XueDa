<?php
// login.php

include_once("functions.php");

$email = $_POST['email'];
$password = $_POST['password'];

login($conn, $email, $password);

?>