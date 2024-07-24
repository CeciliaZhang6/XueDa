<?php
// functions.php

include_once("dbh.php");
session_start();

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
                    $_SESSION["login_status"] = TRUE;
                    return 1; // login success
                    // header("Location: index.php");

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

}

// sql is the query to get all data, used to create api
// email is the email of target user
function cur_user_post($conn, $email){
    if($email === ""){
        die("invalid email -- empty!!");
    }
    
    $sql = "SELECT * FROM rooms WHERE host_id = $email";

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

    $file_path = $dir . "/cur_user_post.json";
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

// function cur_user_post_update($conn, $email){
//     $sql = "SELECT * FROM rooms WHERE host_id = $email";

//     $api = [];

//     $res = $conn->query($sql);

//     if ($res->num_rows > 0){
//         while($row = $res->fetch_assoc()){
//             $api[] = $row;
//         }
//     }

//     $user_post_api = json_encode($api);

//     $file_path = "/home/uccaciyo/public_html/csp1/users/" . $email . "/rooms";
    
//     if (file_put_contents($file_path, $user_post_api) !== FALSE){
//         echo " user_post_api created!!";
//     } else {
//         die(" user_post_api failed to create...");
//     }
    
//     $conn->close();
// }

?>