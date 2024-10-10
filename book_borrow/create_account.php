<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form with Animated Background</title>
    <link rel="stylesheet" href="create_account_style.css"> 
</head>
<body>

    <div class="context">
     
    </div>

    <div class="area">
        <div class="signup-container">
            <h2>Signup Form</h2>

           
            <form action="create_account.php" method="POST">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number:</label>
                    <input type="text" id="phone" name="phone" required>
                </div>

                <div class="form-group">
                    <label for="student_id">Student ID:</label>
                    <input type="text" id="student_id" name="student_id" required>
                </div>

                <div class="form-group">
                    <button type="submit" name="submit">Sign Up</button>
                </div>
            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $phone = $_POST['phone'];
                $student_id = $_POST['student_id'];

                $errors = [];

                
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors[] = "Invalid email format.";
                }

                
                if (!preg_match("/^[0-9]{10}$/", $phone)) {
                    $errors[] = "Invalid phone number format. Must be 10 digits.";
                }

                
                if (strlen($password) < 6) {
                    $errors[] = "Password must be at least 6 characters long.";
                }

                
                $con = mysqli_connect('localhost', 'root', '', 'book_borrow');

                
                if (!$con) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                
                $sql = "SELECT * FROM login_info WHERE Email = ? OR ID = ?";
                $stmt = mysqli_prepare($con, $sql);
                mysqli_stmt_bind_param($stmt, 'ss', $email, $student_id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) > 0) {
                    $user = mysqli_fetch_assoc($result);
                    
                    if ($user['Email'] === $email) {
                        $errors[] = "This email or student ID is already registered.";
                    }

                    if ($user['ID'] === $student_id) {
                        $errors[] = "This email or student ID is already registered.";
                    }
                }

                mysqli_stmt_close($stmt);

                
                if (!empty($errors)) {
                    echo '<div class="error"><ul>';
                    foreach ($errors as $error) {
                        echo "<li>$error</li>";
                    }
                    echo '</ul></div>';
                } else {
                    
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    
                    $sql = "INSERT INTO login_info (Username, Email, Password, Number, ID) VALUES (?, ?, ?, ?, ?)";
                    $stmt = mysqli_prepare($con, $sql);
                    mysqli_stmt_bind_param($stmt, 'sssss', $username, $email, $hashed_password, $phone, $student_id);

                    if (mysqli_stmt_execute($stmt)) {
                        
                        header("Location: main.php");
                        exit();
                    } else {
                        echo "<p class='error'>Failed to insert data: " . mysqli_error($con) . "</p>";
                    }

                    mysqli_stmt_close($stmt);
                    mysqli_close($con);
                }
            }
            ?>

        </div>

        
        <ul class="circles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>

</body>
</html>
