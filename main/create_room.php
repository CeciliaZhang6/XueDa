<?php

// include_once("dbh.php");
include_once("functions.php");

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
    $sql = "SELECT * FROM rooms WHERE email = '$host'";
    cur_user_post($conn, $sql, $host); // host = email
}else {
    die("room creation failed");
}

?>