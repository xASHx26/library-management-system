<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Process Currency Selection</title>
</head>
<body>
    <h2>Processed Currency Selection</h2>
    <?php
    $cookie_name = "curr";
    
    // Check if form was submitted and set the cookie
    if (isset($_POST['submit'])) {
        // Validate and sanitize input
        $currency = isset($_POST['currency']) ? $_POST['currency'] : '';
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $nn = isset($_POST['nn']) ? $_POST['nn'] : '';
        
        // Set cookies with expiration time of 1 hour (3600 seconds)
        setcookie("currency", $currency, time() + 3600);
        setcookie("username", $username, time() + 3600);
        setcookie("nn", $nn, time() + 3600);
        
        // Redirect to this page to display cookies
        header("Location: process.php");
        exit(); // Ensure no further output
    }
    
    // Display cookie values if set
    if (isset($_COOKIE['currency'])) {
        echo "Currency is set to: <strong>" . htmlspecialchars($_COOKIE['currency']) . "</strong><br>";
    }
    if (isset($_COOKIE['username'])) {
        echo "Username is set to: <strong>" . htmlspecialchars($_COOKIE['username']) . "</strong><br>";
    }
    if (isset($_COOKIE['nn'])) {
        echo "nn is set to: <strong>" . htmlspecialchars($_COOKIE['nn']) . "</strong><br>";
    }
    ?>
</body>
</html>
