<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .Navigation
        {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
        }
        .li
        {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            float: left;
        }
        .li a:hover
        {
         background-color: #111;   
        }
    </style>
</head>
<body>
    <ul class="Navigation">
        <li class="li"><a href="tokkenValidation.php">tokkenValidation</a></li>
        <li  class="li">Book search</li>
        <li  class="li">Book loan</li>
        <li  class="li">Send reminder</li>
    </ul>
</body>
</html>