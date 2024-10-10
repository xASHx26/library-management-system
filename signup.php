<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="signup_style.css"> <!-- Add this line -->
</head>
<body>
<div class="box">

<div class="profile">
<div class="login">

    <form method="post">
        <label for="Email">Email</label>
        <input type="email" id="Email" name="Email" placeholder="Enter your Email:" required>

        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Enter your username" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>

        <button type="submit" name="submit">Login</button>
    </form>

</div>

<?php
if (isset($_POST['submit'])) {
    $email = $_POST['Email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    $con = mysqli_connect('localhost', 'root', '', 'bl');

    
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    
    $stmt = $con->prepare("INSERT INTO login_info (email, uName, pass) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $email, $username, $password);

    
    if ($stmt->execute()) {
        
        header("Location: books2.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    
    $stmt->close();
    mysqli_close($con);
}
?>

</div>

</div>
</body>
</html>
