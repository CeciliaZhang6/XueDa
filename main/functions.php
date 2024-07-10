<?php
// functions.php

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

function user_res_auth($conn, $given_email){
    $sql = "SELECT * FROM users";

    $res = $conn->query($sql);

    if($res->num_rows > 0){
        while($row = $res->fetch_assoc()){
            $email = $row['email'];
            if($email === $given_email){
                die("email already in use");    
            }
            
        }
        
    }

}

function create_base_dir($conn, $uid){
    $base_dir = "users";
    $sub_dir_1 = "rooms";
    $sub_dir_2 = "pfp";

    // content
    $user_post_api = "user_post_api.json";

    // construct path
    // /users/uid/sub_dir_name/file_name
    $path = "/" . $base_dir . "/" . $uid . "/" . $sub_dir_1 . "/" . $user_post_api;

    $res = mkdir($path);

    if ($res === FALSE){
        die("mkdir failed");
    }


}

?>