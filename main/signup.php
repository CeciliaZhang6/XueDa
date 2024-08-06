<?php
// signup.php

include_once("functions.php");

$email = $_POST['email'];
$password = $_POST['password'];
$date = date('Y-m-d H:i:s');

if (isset($_POST['email']) && isset($_POST['password'])){
    user_res_auth($conn, $email);

    $create_user = "INSERT INTO users (email, pass_word, creation_date) VALUES ('$email', '$password', '$date')";

    if ($conn->query($create_user) === TRUE) {
        echo " user data inserted successfully\n";
        echo " email: $email \n";
        echo " password: $password \n";

        create_base_dir($conn, $email);

        $_SESSION["login_status"] = TRUE;
        $_SESSION["curr_user"] = $email;
        
        $conn->close();
        header("Location: index.php");
    }else{
      die("not good (insert user table)");
    }
  
} else {
    die("ERROR: empty email or password");
}

$conn->close();
?>