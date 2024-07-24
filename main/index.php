<?php
    include_once('dbh.php');

    session_start();
    if ($_SESSION['login_status'] === FALSE || $_SESSION['curr_user'] === "") {
        $_SESSION['curr_user'] = "guest";
    }
    



echo '
<!-- index.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>学搭 | XueDa</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <nav>
        <div id="welcome-message">Welcome, <span id="username">' . $_SESSION["curr_user"] . '</span>!</div>
        <ul>
            <li id="login-signup"><a href="http://www.uccainc.com/csp1/login.php">Login</a></li>
            <li id="view-profile" style="display: none;"><a href="http://www.uccainc.com/csp1/profile.php">View Profile</a></li>
            <li id="logout" style="display: none;"><a href="http://www.uccainc.com/csp1/logout.php">Logout</a></li>
            <li><a href="http://www.uccainc.com/csp1/create_room.html">Create Room</a></li>
        </ul>
        </nav>
    </header>
    <main>
        <section class="banner">
            <div class="banner-content">
                <h1>学搭 | XueDa</h1>
                <p class="subtitle">Your virtual home for <span id="animated-text">event holding</span></p>
            </div>

            <div class="dots-container">
                <span class="dot" data-index="0"></span>
                <span class="dot" data-index="1"></span>
                <span class="dot" data-index="2"></span>
            </div>
        </section>

        <section class="search-bar">
            <input type="text" placeholder="Search rooms...">
        </section>

        <section class="popular-rooms">
            <h2>Popular Public Rooms</h2>

            <div class="rooms-list" id="rooms-list">

            </div>

            <div class="all-rooms">
                <button>All Rooms</button>
            </div>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 学搭 | XueDa</p>
    </footer>
    <script src="scripts.js"></script>
</body>
</html>
';
?>
