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
        die("mkdir failed - rooms");
    }

    $path = "/" . $base_dir . "/" . $uid . "/" . $sub_dir_2;

    $res = mkdir($path);

    if ($res === FALSE){
        die("mkdir failed - pfp");
    }


}

// sql is the query to get all data, used to create api
// email is the email of target user
function cur_user_post($conn, $sql, $email){
    $api = [];
    $res = $conn->query($sql);

    if ($res->num_rows > 0){
        while($row = $res->fetch_assoc()){
            $api[] = $row;
        }
    }

    $api_json = json_encode($api);
    echo $api_json;

    $dir = "/home/uccaciyo/public_html/csp1/users/" . $email;

    // create dir if not exist
    if (!is_dir($dir)){
        mkdir_($dir, 0777, true);
    }

    $file_path = $dir . "/cur_user_post.json";
    echo $file_path;

    // check write permission
    if (!is_writable($directory)){
        die("Cannot write to dir:" . $dir);
    }

    $res = file_put_contents($file_path, $api_json);
    if ($res === false){
        $error = error_get_last();
        die("Cannot write. Error:" . $error['message']);
    } else {
        echo "File written done";
    }
}

?>