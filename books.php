<?php
$nameErr = $idErr = $emailErr = $edateErr = "";
$name = $id = $email = $edate = "";

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["Studentid"])) {
        $nameErr = "Student ID is required";
    } else {
        $name = test_input($_POST["Studentid"]);
    }

    if (empty($_POST["Bookno"])) {
        $idErr = "Book number is required";
    } else {
        $id = test_input($_POST["Bookno"]);
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
    }

    if (empty($_POST["edate"])) {
        $edateErr = "End date is required";
    } else {
        $edate = test_input($_POST["edate"]);
    }

    $query_params = http_build_query([
        'nameErr' => $nameErr,
        'idErr' => $idErr,
        'emailErr' => $emailErr,
        'edateErr' => $edateErr,
        'name' => $name,
        'id' => $id,
        'email' => $email,
        'edate' => $edate
    ]);

    if (empty($nameErr) && empty($idErr) && empty($emailErr) && empty($edateErr)) {
        header("Location: validation.php?$query_params");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .error {
            color: #FF0000;
        }
    </style>
    <title>Book Store</title>
</head>
<body>
    <div style="border: 5px solid red; padding: 5px 0 500px; border-radius: 15px; background-image:url('banner3.jpg');">
        <h3 style="text-align: center;">Book Store</h3>
    </div>
    <br>
    <div style="display: flex; flex-wrap: wrap; justify-content: center; margin: 3% 3% 2%; border: 5px solid blue; border-radius: 15px;">
        <span style="flex: 1 0 20%; margin: 5%;">
            <img src="1stbook.jpg" alt="" style="width: 100%; height: auto;">
            <p style="text-align: center;">Book no: 1</p>
        </span>
        <span style="flex: 1 0 20%; margin: 5%;">
            <img src="2ndbook.jpg" alt="" style="width: 100%; height: auto;">
            <p style="text-align: center;">Book no: 2</p>
        </span>
        <span style="flex: 1 0 20%; margin: 5%;">
            <img src="3rdbook.jpg" alt="" style="width: 100%; height: auto;">
            <p style="text-align: center;">Book no: 3</p>
        </span>
        <span style="flex: 1 0 25%; margin: 5%;">
            <img src="4thbook.jpg" alt="" style="width: 100%; height: auto;">
            <p style="text-align: center;">Book no: 4</p>
        </span>
        <span style="flex: 1 0 20%; margin: 5%;">
            <img src="5thbook.jpg" alt="" style="width: 100%; height: auto;">
            <p style="text-align: center;">Book no: 5</p>
        </span>
        <span style="flex: 1 0 20%; margin: 5%;">
            <img src="6thbook.jpg" alt="" style="width: 100%; height: auto;">
            <p style="text-align: center;">Book no: 6</p>
        </span>
    </div>
    <div style="border: 2px solid rgb(51, 153, 119); border-radius: 15px; padding: 20px; display: flex; justify-content: center; background-image: url('desktop-wallpaper-backgrounds-for-login-page-login-page.jpg'); background-size: 100%;">
        <div>
            <p style="text-align: center; font-size: 30px;">Enter your information</p>
            <div style="border: 2px solid rgb(51, 153, 119); border-radius: 15px; padding: 20px; display: flex; justify-content: center;">
                <form method="post">
                    <label  for="Studentid">Student ID</label><br>
                    <input type="text" id="Studentid" name="Studentid" value="<?php echo htmlspecialchars($name); ?>">
                    <span class="error">* <?php echo $nameErr;?></span>
                    <br>
                    <label for="Bookno">Book number</label><br>
                    <input type="number" id="Bookno" name="Bookno" value="<?php echo htmlspecialchars($id); ?>"><br>
                    <span class="error">* <?php echo $idErr;?></span>
                    <br>
                    <label for="email">Email</label><br>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>"><br>
                    <span class="error">* <?php echo $emailErr;?></span>
                    <br>
                    <label for="edate">End date</label><br>
                    <input type="date" name="edate" value="<?php echo htmlspecialchars($edate); ?>">
                    <span class="error">* <?php echo $edateErr;?></span>
                    <br>
                    <p style="text-align:center"> <input type="submit" name="submit"></p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
