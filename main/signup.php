<?php
// signup.php

session_start();
include_once("functions.php");

// Assuming $conn is properly initialized in functions.php
$email = $_POST['email'];
$password = $_POST['password'];
$date = date('Y-m-d H:i:s');

if (isset($email) && isset($password)) {
    // Prevent SQL injection by using prepared statements
    $stmt = $conn->prepare("INSERT INTO users (email, pass_word, creation_date) VALUES (?, ?, ?)");
    
    // Hash the password before storing it
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $stmt->bind_param("sss", $email, $hashed_password, $date);

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
