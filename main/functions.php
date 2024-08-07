<?php
// functions.php

include_once("dbh.php");
session_start();

function db_setup($conn){
    $tablename = "users";
    $sql = "CREATE TABLE $tablename 
    (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, email VARCHAR(255) NOT NULL, pass_word VARCHAR(255) NOT NULL, 
    user_name VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, sender_ip VARCHAR(255) NOT NULL, 
    org VARCHAR(255) NOT NULL, user_long VARCHAR(255) NOT NULL, user_lat VARCHAR(255) NOT NULL, 
    creation_date VARCHAR(255) NOT NULL, allow_loc VARCHAR(2) NOT NULL, phone VARCHAR(30) NOT NULL, 
    pfp TEXT NOT NULL, bio TEXT NOT NULL, is_public VARCHAR(2) NOT NULL)";

    if ($conn->query($sql)){
        echo "Table created";
    } else {
        echo "Table exists, or bad";
    }

    $tablename = "rooms";
    $sql = "CREATE TABLE $tablename 
    (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, title VARCHAR(255) NOT NULL, subject VARCHAR(255) NOT NULL, 
    description VARCHAR(255) NOT NULL, date VARCHAR(20) NOT NULL, link VARCHAR(255) NOT NULL, 
    host_id VARCHAR(255) NOT NULL, sender_ip VARCHAR(255) NOT NULL, scheduled_date VARCHAR(255) NOT NULL)";

    if ($conn->query($sql)){
        echo "Table created";
    } else {
        echo "Table exists, or bad";
    }

    $tablename = "tokens";
    $sql = "CREATE TABLE $tablename 
    (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, is_valid VARCHAR(2) NOT NULL, sender_ip VARCHAR(255) NOT NULL, visit_date VARCHAR(255) NOT NULL)";

    if ($conn->query($sql)){
        echo "Table created";
    } else {
        echo "Table exists, or bad";
    }

    $conn->close();

}

function login($conn, $given_email, $given_password){
    $sql = "SELECT * FROM users";

    $res = $conn->query($sql);

    if($res->num_rows > 0){
        while($row = $res->fetch_assoc()){
            $email = $row['email'];
            $password = $row['pass_word'];

            if($email === $given_email){
                if($password === $given_password){
                    $_SESSION["curr_user_name"] = $row['user_name'];
                    $_SESSION["curr_user_bio"] = $row['bio'];
                    $_SESSION['curr_user'] = $email;
                    $_SESSION["login_status"] = TRUE;
                    $_SESSION["member_since"] = $row['creation_date'];
                    return 1; // login success

                } else {
                    echo("bad password");
                    return 0; // incorrect password
                }
            }
            
        }

        echo " ERROR: user not found \n";
        return -1; // email not found
        
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

    $conn->close();
}

function create_base_dir($conn, $uid){
    $base_dir = "users";
    $sub_dir_1 = "rooms";
    $sub_dir_2 = "pfp";
    $sub_dir_3 = "blocked";

    // content
    $user_post_api = "user_post_api.json";

    // construct path
    // /home/uccaciyo/public_html/csp1/users/test3@xd.com/rooms/user_post_api.json
    $path = "/home/uccaciyo/public_html/csp1/" . $base_dir . "/" . $uid . "/" . $sub_dir_1;

    // check valid path
    if (!file_exists($path)){
        $res = mkdir($path, 0755, true); // 0755 = normal user

        if ($res === FALSE){
            die(" ERROR: mkdir failed - rooms");
        } else {
            echo(" Rooms Dir created. ");
        }
    }

    // create file path
    $file_path = $path . "/" . $user_post_api;

    // empty json array
    $arr = [];
    $json_arr = json_encode($arr);

    if (file_put_contents($file_path, $json_arr) !== FALSE){
        echo " user_post_api created!!";
    } else {
        die(" user_post_api failed to create...");
    }

    // $path = "/home/uccaciyo/public_html/csp1/" . $base_dir . "/" . $uid . "/" . $sub_dir_2;

    // // check valid path
    // if (!file_exists($path)){
    //     $res = mkdir($path, 0755, true); // 0755 = normal user
    // }

    // if ($res === FALSE){
    //     die(" ERROR: mkdir failed - pfp");
    // } else {
    //     echo(" Pfp Dir created. ");
    // }

    // $path = "/home/uccaciyo/public_html/csp1/" . $base_dir . "/" . $uid . "/" . $sub_dir_3;

    // // check valid path
    // if (!file_exists($path)){
    //     $res = mkdir($path, 0755, true); // 0755 = normal user
    // }

    // if ($res === FALSE){
    //     die(" ERROR: mkdir failed - blocked");
    // } else {
    //     echo(" Blocked Dir created. ");
    // }

    $conn->close();

}

// sql is the query to get all data, used to create api
// email is the email of target user
function cur_user_post($conn, $email){
    if($email === ""){
        die("invalid email -- empty!!");
    }

    $sql = "SELECT * FROM rooms WHERE host_id = '$email'";

    $api = [];
    $res = $conn->query($sql);

    if ($res->num_rows > 0){
        while($row = $res->fetch_assoc()){
            $api[] = $row;
        }
    }

    $api_json = json_encode($api);
    echo $api_json;

    $dir = "/home/uccaciyo/public_html/csp1/users/" . $email . "/rooms";

    // create dir if not exist
    if (!is_dir($dir)){
        mkdir($dir, 0777, true); // 0777 = super user
    }

    $file_path = $dir . "/user_post_api.json";
    echo $file_path;

    // check write permission
    if (!is_writable($dir)){
        die("Cannot write to dir:" . $dir);
    }

    $res = file_put_contents($file_path, $api_json);
    if ($res === false){
        $error = error_get_last();
        die("Cannot write. Error:" . $error['message']);
    } else {
        echo "File written done";
    }

    $conn->close();
}

function delete_post($conn, $id, $email){
    $sql = "DELETE FROM rooms WHERE id = '$id' AND host_id = '$email'";
    $res = $conn->query($sql);
    
    if ($res === TRUE){
        echo "delete done";
    } else {
        echo "delete failed!!";
    }

    $conn->close();
}

?>