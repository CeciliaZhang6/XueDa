<?php
// login.php

session_start();
include_once("functions.php");

$message = '';

// Check if there's a message in the URL
if (isset($_GET['message'])) {
    $message = htmlspecialchars($_GET['message']);
}

// Process login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = login($conn, $email, $password);

    if ($result) {
        // Redirect to home page or dashboard after successful login
        header("Location: index.php");
        exit();
    } else {
        $message = "Login failed. Please try again.";
    }
}
?>

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
        <div class="login-banner">
            <div class="auth-form login-form">
                <h1>学搭 | XueDa</h1>
                <?php
                if (!empty($message)) {
                    echo "<div style='color: red;'>$message</div>";
                }
                ?>
                <form id="loginForm" action="login.php" method="post">
                    <input type="email" id="email" placeholder="Email" name="email" required>
                    <input type="password" id="password" placeholder="Password" name="password" required>
                    <button type="submit">Login</button>
                </form>
                <p>Don't have an account? <a href="signup.php" style="color: blue;">Sign up</a></p>
                <p><a href="index.php">Back to Home</a></p>
            </div>
        </div>
    </main>
    <script src="login.js"></script>
</body>
</html>