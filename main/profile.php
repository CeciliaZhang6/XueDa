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
                <h1>'. $_SESSION["curr_user_name"] .'</h1>
                <p id="cur_user" style="display:none;">'. $_SESSION["curr_user"] .'</p>
            </div>
        </section>
        <section class="profile-content">
            <div class="profile-info">
                <h2>Account Info</h2>
                <div class="account-info-display" id="account-info-display">
                    <p><strong>Email:</strong> ' . $_SESSION["curr_user"] . '</p>
                    <p><strong>Member since:</strong> '. $_SESSION["member_since"] . '</p>
                    <p><strong>Username:</strong> <span id="display-username"> ' . $_SESSION["curr_user_name"] . '</span></p>
                    <p><strong>Bio:</strong> <span id="display-bio">' . $_SESSION["curr_user_bio"] . '</span></p>
                    <button class="edit-profile-btn">Edit Profile</button>
                </div>
            
                <div class="account-info-edit" id="account-info-edit" style="display: none;">
                    <form class="update-form" action="http://www.uccainc.com/csp1/profile_edit.php" method="post">
                        <p><strong>Email:</strong> ' . $_SESSION["curr_user"] . '</p>
                        <p><strong>Member since:</strong> '.$_SESSION["member_since"].' </p>
                        <p><strong>Username:</strong> <input type="text" id="username" name="username" value="'.$_SESSION["curr_user_name"].'"> </p>
                        <p><strong>Bio:</strong> <textarea id="bio" name="bio">'.$_SESSION["curr_user_bio"].'</textarea> </p>
                        
                        <div class="button-group">
                            <button type="submit" class="update-btn">Update</button>
                            <button type="button" class="cancel-btn">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="profile-rooms">
                <div class="rooms-header">
                    <h2>My Rooms</h2>
                    <button class="edit-rooms-btn" id="edit-rooms-btn">Edit</button>
                </div>
                <div class="rooms-list" id="rooms-list">
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

$conn->close();
?>
