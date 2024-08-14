<?php
// signup.php

session_start();
include_once("functions.php");

// assuming $conn is properly initialized in functions.php
$email = $_POST['email'];
$password = $_POST['password'];
$date = date('Y-m-d');

if (isset($email) && isset($password)) {
    // validate params
    user_res_auth($conn, $email);
    
    // prevent SQL injection by using prepared statements
    $stmt = $conn->prepare("INSERT INTO users (email, pass_word, pass__word, user_name, creation_date) VALUES (?, ?, ?, ?, ?)");

    // generate a default username
    $first_letter = chr(rand(65, 90)); // generates a random uppercase letter (A-Z)
    $default_username = generateRandomString();

    // embed password
    $e_password = $first_letter . $password . $default_username; 

    // hash the password before storing it
    $h_password = password_hash($password, PASSWORD_BCRYPT); 

    $stmt->bind_param("sss", $email, $e_password, $h_password, $default_username, $date);

    if ($stmt->execute()) {
        echo "User data inserted successfully\n";
        echo "Email: $email \n";

        create_base_dir($conn, $email);

        $_SESSION["login_status"] = TRUE;
        $_SESSION["curr_user"] = $email;
        
        $stmt->close();
        $conn->close();
        header("Location: index.php");
        exit(); // Stop script execution after redirection
    } else {
        die("Error inserting into user table: " . $stmt->error);
    }
  
} else {
    die("ERROR: empty email or password");
}

$conn->close();
?>
