<?php

session_start();
include_once("functions.php");

$email = $_SESSION['curr_user'];
$room_id = $_POST['room_id'];
$title = $_POST['title'];
$desc = $_POST['desc'];
$link = $_POST['link'];

update_post($conn, $room_id, $title, $desc, $link);

cur_user_post($conn, $email);

$refresh_link = "http://www.uccainc.com/csp1/users/". $email ."/rooms/user_post_api.json";
// refresh api endpoint
file_get_contents($refresh_link);
$conn->close();
header("Location: profile.php");

?>