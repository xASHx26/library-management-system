<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation Results</title>
    <style>
        .error {
            color: #FF0000;
        }
        .cookie-message {
            color: #FF0000;
        }
    </style>
</head>
<body>
    <h2>Validation Results</h2>
    <?php
    
    $name = htmlspecialchars($_GET['name'] ?? '');
    $id = htmlspecialchars($_GET['id'] ?? '');
    $email = htmlspecialchars($_GET['email'] ?? '');
    $edate = htmlspecialchars($_GET['edate'] ?? '');
    $nameErr = htmlspecialchars($_GET['nameErr'] ?? '');
    $idErr = htmlspecialchars($_GET['idErr'] ?? '');
    $emailErr = htmlspecialchars($_GET['emailErr'] ?? '');
    $edateErr = htmlspecialchars($_GET['edateErr'] ?? '');

    
    ?>
    <p><strong>Student ID:</strong> <?php echo $name; ?> <span class="error"><?php echo $nameErr; ?></span></p>
    <p><strong>Book Number:</strong> <?php echo $id; ?> <span class="error"><?php echo $idErr; ?></span></p>
    <p><strong>Email:</strong> <?php echo $email; ?> <span class="error"><?php echo $emailErr; ?></span></p>
    <p><strong>End Date:</strong> <?php echo $edate; ?> <span class="error"><?php echo $edateErr; ?></span></p>

    <?php
    
    if (!empty($name)) {
        if (isset($_COOKIE[$name])) {
            
            echo "<p class='cookie-message'>You have already taken the book, please return it.</p>";
        } else {
            
            setcookie($name, $id, time() + (86400*7), "/"); 
            echo "<p class='cookie-message'>Cookie is set to this: $name</p>";
        }
    }
    ?>
</body>
</html>
