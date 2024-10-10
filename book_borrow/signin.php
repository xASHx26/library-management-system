<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    if ($email == 'admin@gmail.com' && $password == 'admin') {
        
        $_SESSION['user_id'] = 'admin';
        $_SESSION['username'] = 'Admin';
        
        
        $remember = isset($_POST['remember']);
        if ($remember) {
            setcookie('user_id', 'admin', time() + (86400 * 30), "/");
            setcookie('username', 'Admin', time() + (86400 * 30), "/");
        }
        
        echo "<script>setTimeout(function() { window.location.href = 'admin_dashboard.php'; }, 1000);</script>";
        exit();
    }

    
    $remember = isset($_POST['remember']);

    
    $con = mysqli_connect('localhost', 'root', '', 'book_borrow');

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    
    $sql = "SELECT * FROM login_info WHERE Email = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    
    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $hashed_password = $user['Password']; 

        
        if (password_verify($password, $hashed_password)) {
            
            $_SESSION['user_id'] = $user['ID'];
            $_SESSION['username'] = $user['Username'];

            
            if ($remember) {
                setcookie('user_id', $user['ID'], time() + (86400 * 30), "/"); 
                setcookie('username', $user['Username'], time() + (86400 * 30), "/");
            }

            
            echo "<script>setTimeout(function() { window.location.href = 'main.php'; }, 1000);</script>";
            exit();
        } else {
            
            $error = "Invalid email or password.";
        }
    } else {
        
        $error = "Invalid email or password.";
    }

    
    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sign_styles.css"> 
    <title>Sign In</title>
</head>
<body>
<div class="wave"></div>
    <div class="wave"></div>
    <div class="wave"></div>
    <div class="wave"></div>
    <div class="signin-container">
        <form class="signin-form" action="signin.php" method="post">
            <h2>Sign In</h2>

            <!-- Display error message if login fails -->
            <?php if (isset($error)): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
            
            <!-- Remember Me Checkbox -->
            <!-- Remember Me Checkbox -->
        <div class="remember-container">
            <input type="checkbox" id="remember" name="remember">
            <label for="remember">Remember Me</label>
        </div>

            
            <button type="submit">Sign In</button>
            
            <p><a href="forgot_password.php">Forgot Password?</a></p>
        </form>
    </div>
</body>
</html>
