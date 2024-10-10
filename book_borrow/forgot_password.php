<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    
    $con = mysqli_connect('localhost', 'root', '', 'book_borrow');

    
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    
    $sql = "SELECT * FROM login_info WHERE Email = ? AND Number = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'ss', $email, $phone);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    
    if (mysqli_num_rows($result) == 1) {
        
        header("Location: reset_password.php?email=" . urlencode($email));
        exit();
    } else {
        
        $error = "Invalid email or phone number.";
    }

    
    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="forgot_styles.css"> 
    <title>Forgot Password</title>
</head>
<body>
    <div class="wave"></div>
    <div class="wave"></div>
    <div class="wave"></div>
    <div class="forgot-password-container">
        <form class="forgot-password-form" action="forgot_password.php" method="post">
            <h2>Forgot Password</h2>

            <!-- Display error message if validation fails -->
            <?php if (isset($error)): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
            
            <label for="phone">Phone Number</label>
            <input type="text" id="phone" name="phone" placeholder="Enter your phone number" required>
            
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
