<?php

session_start();
include_once("functions.php");

// check user login
if (!isset($_SESSION['curr_user']) || $_SESSION['curr_user'] === 'guest') {
    header("Location: login.php?message=Please log in to create a room");
    exit();
}

$title = $_POST['title'];
$description = $_POST['description'];
$link = $_POST['link'];
$host = $_SESSION['curr_user'];
$date = date('Y-m-d H:i:s');

$sql = "INSERT INTO rooms (title, description, date, link, host_id) 
VALUES ('$title', '$description', '$date', '$link', '$host')";

$res = $conn->query($sql);

if($res === TRUE){
    echo "room inserted";
    cur_user_post($conn, $sql, $host); // host = email
}else {
    die("room creation failed");
}

?>