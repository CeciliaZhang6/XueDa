<?php
//user_info.php

include_once("dbh.php");

function login($conn, $given_email, $given_password){
    $sql = "SELECT * FROM users";

    $res = $conn->query($sql);

    if($res->num_rows > 0){
        while($row = $res->fetch_assoc()){
            $email = $row['email'];
            $password = $row['pass_word'];

            if($email === $given_email){
                if($password === $given_password){
                    $_SESSION['curr_user'] = $email;
                    header("Location: index.php");
                } else {
                    die("bad password");
                }
            }
            
        }

        echo " user not found \n";
        
    }

}


?>