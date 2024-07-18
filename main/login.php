<?php
// login.php

session_start();
include_once("functions.php");

$_SESSION["login_status"] = FALSE;
$message = '';

// Check if there's a message in the URL
if (isset($_GET['message'])) {
    $message = htmlspecialchars($_GET['message']);
}

// process login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $login_status = login($conn, $email, $password);

    if ($login_status === 1) {
        $_SESSION["login_status"] = TRUE;
        $_SESSION["curr_user"] = $email;
        // Redirect to home page or dashboard after successful login
        header("Location: index.php");
        exit();
    } elseif ($login_status === 0) {
        $message = "Incorrect password. Please try again.";
    } elseif ($login_status === -1){
        $message = "Email not found. Please sign up first.";
    } else {

    }
}
?>

<!-- TODO:  use echo to convert html to php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | 学搭 XueDa</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="auth-page">
    <main>
        <div class="fullscreen-form-container login-banner">
            <div class="auth-form login-form">
                <h1>学搭 | XueDa</h1>
                <?php
                if (!empty($message)) {
                    echo "<div style='color: red;'>$message</div>";
                }
                ?>
                <form id="loginForm" action="http://www.uccainc.com/csp1/login.php" method="post">
                    <input type="email" id="email" placeholder="Email" name="email" required>
                    <input type="password" id="password" placeholder="Password" name="password" required>
                    <button type="submit">Login</button>
                </form>
                <p>Don't have an account? <a href="http://www.uccainc.com/csp1/signup.html" style="color: blue;">Sign up</a></p>
                <p><a href="http://www.uccainc.com/csp1/index.php">Back to Home</a></p>
            </div>
        </div>
    </main>
</body>
</html>