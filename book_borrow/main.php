<?php
session_start();

if (!isset($_SESSION['user_id']) && !(isset($_COOKIE['user_id']) && isset($_COOKIE['username']))) {
    header("Location: signin.php");
    exit();
}

$username = isset($_SESSION['username']) ? $_SESSION['username'] : $_COOKIE['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library System</title>
   
    <link rel="stylesheet" href="styles.css">
</head>
<body>


<ul class="Navigation">
    <div class="nav-left">
        <li class="li"><a href="Bookloan.php">Book loan</a></li>
        <li class="li"><a href="https://www.emerald.com/insight/">Book Search</a></li>
        <li class="li"><a href="booklist.php">Book List</a></li>

        <li class="li"><a href="online_book.php">Online book</a></li>
    </div>

 
    <div class="nav-right">
        <li class="nav-item-dropdown">
            <button><?php echo htmlspecialchars($username); ?></button>
            <div class="dropdown-content">
                <a href="profile.php">Profile</a>
                <a href="signout.php">Sign Out</a>
            </div>
        </li>
    </div>
</ul>


<div class="header-image"></div>


<div class="caption">Top Rated Books</div>


<div class="book-section">
    <span class="book-container">
        <img src="1stbook.jpg" alt="The war on warriors">
        <p>The war on warriors</p>
    </span>
    <span class="book-container">
        <img src="2ndbook.jpg" alt="Eruption">
        <p>Eruption</p>
    </span>
    <span class="book-container">
        <img src="3rdbook.jpg" alt="Dad I want to hear your story">
        <p>Dad I want hear your story</p>
    </span>
    <span class="book-container">
        <img src="4thbook.jpg" alt="The lost book of Herbal Remedies">
        <p>The lost book of Herbal Remedies</p>
    </span>
    <span class="book-container">
        <img src="5thbook.jpg" alt="Re connected">
        <p>Re connected</p>
    </span>
    <span class="book-container">
        <img src="6thbook.jpg" alt="You like it darker">
        <p>You like it darker</p>
    </span>
</div>


<div class="footer">
    <p>© 2024 Library System</p>
</div>

</body>
</html>
