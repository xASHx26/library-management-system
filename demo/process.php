<!DOCTYPE html>
<html lang="en">
<head>
    <title>currency</title>
</head>
<body>
    <?php
        // COOKIE
        $cookie_name = "curr";

             if (isset($_POST['submit'])){   
            $cookie_value = $_POST['currency'];
            setcookie($cookie_name, $cookie_value, time() + 10);
                header("Location:http://localhost/demo/process.php");
        
        }
          
          
             if (isset($_COOKIE[$cookie_name])) {
            if (count($_COOKIE) > 0) {  
                echo "Currency set to <br> <p style=\"color:red\">".$_COOKIE[$cookie_name]."</p>";
            }
        }
    ?>

    <?php
        // SESSION
        session_start();
        if (isset($_POST['submit'])){
        $_SESSION['uname'] = $_POST['username'];
        } 
        if (count($_SESSION)>0) {
          
            echo "<br>Hello <br> <p style=\"color:red\"> ".$_SESSION['uname']."</p>";
        
    }

    ?>
        <br>
        <a href="http://localhost/demo/process.php">REFRESH </a>
        <br>
        <a href="http://localhost/demo/logout.php">LOGOUT</a>
</body>
</html>