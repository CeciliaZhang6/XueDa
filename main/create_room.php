<?php

include_once("dbh.php");

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
}else {
    die("room creation failed");
}

?>