<?php
session_start();


if (isset($_SESSION['user_id'])) {
    
    header("Location: main.php");
    exit();
} elseif (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
    
    $_SESSION['user_id'] = $_COOKIE['user_id'];
    $_SESSION['username'] = $_COOKIE['username'];
    
    
    header("Location: main.php");
    exit();
}
?>

<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="homestyles.css">
    <title>Homepage - AIUB Library System</title>
</head>
<body>
    <div class="main-container">
        <h1>Welcome to the AIUB Library System</h1>
        <div class="button-container">
            <a href="signin.php" class="auth-button">Sign In</a>
            <a href="create_account.php" class="auth-button">Create an Account</a>
        </div>
    </div>
</body>
</html>
