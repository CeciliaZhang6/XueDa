<?php

session_start();
include_once("functions.php");

$room_id = $_POST['room_id'];
$email = $_SESSION['curr_user'];

delete_post($conn, $room_id, $email);

cur_user_post($conn, $email);

$refresh_link = "http://www.uccainc.com/csp1/users/". $email ."/rooms/user_post_api.json";
// refresh api endpoint
file_get_contents($refresh_link);
$conn->close();
header("Location: profile.php");


?>