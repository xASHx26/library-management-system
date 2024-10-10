<!-- index.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Currency</title>
</head>
<body>
    <h2>Select Currency</h2>
    <form method="post" action="validation2.php">
        <label for="currency">Choose Currency:</label>
        <select id="currency" name="currency">
            <option value="USD">USD</option>
            <option value="EUR">EUR</option>
            <option value="GBP">GBP</option>
            <option value="JPY">JPY</option>
        </select>
        <br><br>
        <input type="submit" name="submit" value="Set Currency">
    </form>
</body>
</html>

<?php
// index.php - PHP code
$cookie_name = "curr";

if (isset($_POST['submit'])) {
    $cookie_value = $_POST['currency'];
    setcookie($cookie_name, $cookie_value, time() + 3600); // Cookie set to expire in 1 hour
    header("Location: process.php"); // Redirect to process.php after setting cookie
    exit();
}
?>
