<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    
    $errors = [];

    
    if ($new_password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }
    
    else {
        
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        
        $con = mysqli_connect('localhost', 'root', '', 'book_borrow');

        
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        
        $sql = "UPDATE login_info SET Password = ? WHERE Email = ?";
        $stmt = mysqli_prepare($con, $sql);

        if ($stmt === false) {
            die("Failed to prepare statement: " . mysqli_error($con));
        }

        mysqli_stmt_bind_param($stmt, 'ss', $hashed_password, $email);

        
        if (mysqli_stmt_execute($stmt)) {
            
            header("Location: signin.php");
            exit();
        } else {
            $errors[] = "Failed to update password: " . mysqli_stmt_error($stmt);
        }

        
        mysqli_stmt_close($stmt);
        mysqli_close($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="reset_styles.css"> 
    <title>Reset Password</title>
</head>
<body>
    <div class="wave"></div>
    <div class="wave"></div>
    <div class="wave"></div>
    <div class="reset-password-container">
        <form class="reset-password-form" action="reset_password.php" method="post">
            <h2>Reset Password</h2>

            
            <?php if (!empty($errors)): ?>
                <?php foreach ($errors as $error): ?>
                    <p class="error"><?php echo $error; ?></p>
                <?php endforeach; ?>
            <?php endif; ?>

            <input type="hidden" name="email" value="<?php echo htmlspecialchars($_GET['email']); ?>">
            
            <label for="new_password">New Password</label>
            <input type="password" id="new_password" name="new_password" placeholder="Enter new password" required>
            
            <label for="confirm_password">Confirm New Password</label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm new password" required>
            
            <button type="submit">Reset Password</button>
        </form>
    </div>
</body>
</html>
