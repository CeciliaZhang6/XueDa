<?php

session_start();
include_once("functions.php");

$room_id = $_POST['room_id'];
$email = $_SESSION['curr_user'];

delete_post($conn, $room_id, $email);

cur_user_post($conn, $email);

header("Location: profile.php");


?>