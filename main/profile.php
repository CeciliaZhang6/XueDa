<?php
    include_once('dbh.php');
    session_start();

echo '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile | 学搭 XueDa</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="http://www.uccainc.com/csp1/index.php">Home</a></li>
                <li><a href="http://www.uccainc.com/csp1/create_room.html">Create Room</a></li>
                <li><a href="http://www.uccainc.com/csp1/logout.php">Log Out</a></li>
            </ul>
        </nav>
    </header>
    <main class="profile-page">
        <section class="profile-banner">
            <div class="profile-header">
                <div class="profile-avatar">XD</div>
                <h1>Username</h1>
                <p id="cur_user" style="display:none;">'. $_SESSION["curr_user"] .'</p>
            </div>
        </section>
        <section class="profile-content">
            <div class="profile-info">
                <h2>Account Info</h2>
                <p><strong>Email:</strong> ' . $_SESSION["curr_user"]. '</p>
                <p><strong>Member since:</strong> January 1, 2024</p>
                <button class="edit-profile-btn">Edit Profile</button>
            </div>
            <div class="profile-rooms">
                <h2>My Rooms</h2>
                <div class="rooms-list">
                    <!-- fetch room items here -->
                </div>
            </div>
            
        </section>
    </main>
    <footer>
        <p>&copy; 2024 学搭 | XueDa</p>
    </footer>
    <script src="profile.js"></script>
</body>
</html>
';
?>