<?php

include_once("dbh.php");
session_start();

$email = $_SESSION['curr_user'];
$u = $_POST['username'];
$b = $_POST['bio'];
$o = $_POST['org'];
$p = $_POST['phone'];


if ($u !== ""){
    $sql = "UPDATE users 
    SET user_name='$u', bio='$b', org='$o', phone='$p'
    WHERE email = '$email'";

    $res = $conn->query($sql);

    if ($res === TRUE){
        echo "info updated!!";
    }else{
        echo "update failed...";
    }
}else{
    die("empty username!!!");
}

?>