<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            text-align: center;
        }
        h2 {
            color: #333;
        }
        .container {
            width: 80%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .error {
            color: #FF0000;
        }
        .cookie-message {
            color: #FF0000;
        }
        .success {
            color: #008000;
        }
        .redirect-message {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Validation Results</h2>
        <?php
        
        
        $name = htmlspecialchars($_COOKIE['Studentid'] ?? '');
        $book_name = htmlspecialchars($_COOKIE['BookSelector'] ?? '');
        $email = htmlspecialchars($_COOKIE['email'] ?? '');
        $edate = htmlspecialchars($_COOKIE['edate'] ?? '');

        
        if (empty($name) || empty($book_name) || empty($email) || empty($edate)) {
            echo "<p class='error'>All fields are required.</p>";
            exit();
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<p class='error'>Invalid email format.</p>";
            exit();
        }

        
        $con = mysqli_connect('localhost', 'root', '', 'bl');
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        
        $stmt = $con->prepare("INSERT INTO student_book (student_id, book_name, email, edate) VALUES (?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param('ssss', $name, $book_name, $email, $edate);
            $stmt->execute();
            $stmt->close();
        } else {
            echo "<p class='error'>Failed to prepare SQL statement.</p>";
            mysqli_close($con);
            exit();
        }

        mysqli_close($con);

        
        if (!empty($name)) {
            if (isset($_COOKIE[$name])) {
                echo "<p class='cookie-message'>You have already taken the book, please return it.</p>";
            } else {
                
                setcookie($name, $book_name, time() + (86400 * 7), "/"); 
                echo "<p class='success'>Book successfully reserved.</p>";
                echo "<p class='redirect-message'>Redirecting to the main page...</p>";
                
                
                echo "<script>setTimeout(function() { window.location.href = 'books2.php'; }, 2000);</script>";
                exit();
            }
        }

        
        ?>
    </div>
</body>
</html>
