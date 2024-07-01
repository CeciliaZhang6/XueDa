<?php
include_once('dbh.php');

?>

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
            <ul>
                <li><a href="http://www.uccainc.com/csp1/login.html">Login</a></li>
                <li><a href="http://www.uccainc.com/csp1/signup.html">Sign Up</a></li>
                <li><a href="http://www.uccainc.com/csp1/create-room.html">Create Room</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="banner">
            <div class="banner-content">
                <h1>学搭 | XueDa</h1>
                <p class="subtitle">Your virtual home for <span id="animated-text">event holding</span></p>
            </div>
             <div class="user-welcome">
            <?php
                session_start();
                if (isset($_SESSION['curr_user'])) {
                    echo "Welcome, " . $_SESSION['curr_user'] . "!";
                } else {
                    echo "Welcome, Guest!";
                }
            ?>
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
            <div class="rooms-list">
                <div class="room-item">
                    <img src="pic/room1.jpg" alt="Room 1">
                    <div class="room-info">
                        <h3>Room Title 1</h3>
                        <p>Room Description 1</p>
                        <button>Join</button>
                    </div>
                </div>
                <div class="room-item">
                    <img src="pic/room2.jpg" alt="Room 2">
                    <div class="room-info">
                        <h3>Room Title 2</h3>
                        <p>Room Description 2</p>
                        <button>Join</button>
                    </div>
                </div>
                <div class="room-item">
                    <img src="pic/room3.jpg" alt="Room 3">
                    <div class="room-info">
                        <h3>Room Title 3</h3>
                        <p>Room Description 3</p>
                        <button>Join</button>
                    </div>
                </div>
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
