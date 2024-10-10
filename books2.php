
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .error {
            color: #FF0000;
        }
        .Navigation {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
            position: sticky;
            top: 0;
            width: 100%;

        }
        .li {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            float: left;
            border-right: 1px solid #bbb;
        }
        .li:last-child {
            border-right: none;
        }
        .li a {
            color: white;
            text-decoration: none;
        }
        .li:hover {
            background-color: #111;
        }
        .li:hover:not(.active) {
            background-color: aliceblue;
            color: black;
        }
        .si {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            float: left;
            border-right: 1px solid #bbb;
        }
        .si:last-child {
            border-right: none;
        }
        .si a {
            color: white;
            text-decoration: none;
        }
        .si:hover {
            background-color: #111;
        }
        .si:hover:not(.active) {
            background-color: aliceblue;
            color: black;
        }
    </style>
</head>
<body>
<ul class="Navigation">
        <li class="li"><a class="active" href="tokkenValidation.php">tokkenValidation</a></li>
        <li  class="li">Book search</li>
        <li  class="li"><a class="active" href="Bookloan.php">Book loan</a></li>
        <li  class="li">Send reminder</li>
        
        <li class="li" style="float: right;"><a class="active" href="signup.php">Sign up</a></li>
        <li class="si" style="float: right;"><a class="active" href="signin.php">Sign in</a></li>
    </ul>
    <br>
    <div style="border: 5px solid red; padding: 5px 0 500px; border-radius: 15px; background-image:url('banner3.jpg');">
        
    </div>
    <br>
    <div style="display: flex; flex-wrap: wrap; justify-content: center; margin: 3% 3% 2%; border: 5px solid blue; border-radius: 15px;">
        <span style="flex: 1 0 20%; margin: 5%;">
            <img src="1stbook.jpg" alt="" style="width: 100%; height: auto;">
            <p style="text-align: center;">The war on warriors</p>
        </span>
        <span style="flex: 1 0 20%; margin: 5%;">
            <img src="2ndbook.jpg" alt="" style="width: 100%; height: auto;">
            <p style="text-align: center;">Eruption</p>
        </span>
        <span style="flex: 1 0 20%; margin: 5%;">
            <img src="3rdbook.jpg" alt="" style="width: 100%; height: auto;">
            <p style="text-align: center;">Dad I want hear your story</p>
        </span>
        <span style="flex: 1 0 25%; margin: 5%;">
            <img src="4thbook.jpg" alt="" style="width: 100%; height: auto;">
            <p style="text-align: center;">The lost book of Herbal Remedies</p>
        </span>
        <span style="flex: 1 0 20%; margin: 5%;">
            <img src="5thbook.jpg" alt="" style="width: 100%; height: auto;">
            <p style="text-align: center;">Re connected</p>
        </span>
        <span style="flex: 1 0 20%; margin: 5%;">
            <img src="6thbook.jpg" alt="" style="width: 100%; height: auto;">
            <p style="text-align: center;">You like it darker</p>
        </span>
    </div>
    
    </div>
</body>
</html>
