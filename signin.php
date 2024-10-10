<?php
session_start();

// Database connection
$con = mysqli_connect('localhost', 'root', '', 'bl');
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialize error message
$loginError = "";

// Handle login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the required POST variables are set
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Sanitize input
        $email = mysqli_real_escape_string($con, $email);
        $password = mysqli_real_escape_string($con, $password);

        // Check if the login is for admin
        if ($email === 'admin@gmail.com' && $password === 'admin') {
            $_SESSION['admin'] = true;
            $_SESSION['email'] = $email; // Set email for admin
            header("Location: admin_dashboard.php");
            exit();
        } else {
            // Verify email and password for regular users
            $query = "SELECT * FROM login_info WHERE email='$email'";
            $result = mysqli_query($con, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);

                // Verify the password with hashed password in DB
                if (password_verify($password, $user['pass'])) {
                    $_SESSION['email'] = $email;
                    header("Location: student_dashboard.php");
                    exit();
                } else {
                    $loginError = "Invalid email or password";
                }
            } else {
                $loginError = "Invalid email or password";
            }
        }
    }
}

// Check if the user is an admin
if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
    // Fetch data from the database for admin
    $result = mysqli_query($con, "SELECT * FROM student_book");
} elseif (isset($_SESSION['email'])) {
    // Fetch data from the database for student
    $email = $_SESSION['email'];
    $result = mysqli_query($con, "SELECT * FROM student_book WHERE email='$email'");
} else {
    $result = null;
}

mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin / Student Dashboard</title>
    <link rel="stylesheet" href="sign_style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
        .container {
            padding: 20px;
        }
        .logout {
            margin: 20px 0;
        }
        .logout a {
            text-decoration: none;
            color: #007BFF;
        }
        .error {
            color: #FF0000;
        }
        .profile {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: #f2f2f2;
            border: 1px solid #ccc;
            margin: 20px auto;
            background-image: url('vecteezy_profile-icon-design-vector_5544718.jpg');
            background-size: cover;
        }
        .form-container, .dashboard {
            border: 2px solid rgb(51, 153, 119);
            border-radius: 15px;
            padding: 20px;
            background-color: #ffffff;
        }
    </style>
</head>
<body>
    <div class="center_io">
        <?php if (!isset($_SESSION['admin']) && !isset($_SESSION['email'])): ?>
            <!-- Login Form -->
            <div class="form-container">
                <p class="form-title">Login</p>
                <form method="post">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                    
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    
                    <button type="submit">Login</button>
                </form>
                <?php if (!empty($loginError)) : ?>
                    <p class="error"><?php echo $loginError; ?></p>
                <?php endif; ?>
            </div>
        <?php elseif (isset($_SESSION['admin']) && $_SESSION['admin'] === true): ?>
            <!-- Admin Dashboard -->
            <div class="dashboard">
                <div class="profile"></div>
                <h2>Database Information</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Book ID</th>
                            <th>Email</th>
                            <th>End Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['student_id']); ?></td>
                                <td><?php echo htmlspecialchars($row['book_id']); ?></td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td><?php echo htmlspecialchars($row['edate']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <div class="logout">
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        <?php elseif (isset($_SESSION['email'])): ?>
            <!-- Student Dashboard -->
            <div class="dashboard">
                <div class="profile"></div>
                <h2>Books Borrowed</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Book ID</th>
                            <th>Book Name</th>
                            <th>End Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['book_id']); ?></td>
                                <td><?php echo htmlspecialchars($row['book_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['edate']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <div class="logout">
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
