<?php
$nameErr = $bookErr = $emailErr = $edateErr = "";
$name = $book = $email = $edate = "";

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

    if (empty($_POST["BookSelector"])) {
        $bookErr = "Book selection is required";
    } else {
        $book = test_input($_POST["BookSelector"]);
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

    if (empty($nameErr) && empty($bookErr) && empty($emailErr) && empty($edateErr)) {
        
        setcookie("Studentid", $name, time() + 3600, "/");
        setcookie("BookSelector", $book, time() + 3600, "/");
        setcookie("email", $email, time() + 3600, "/");
        setcookie("edate", $edate, time() + 3600, "/");

        header("Location: validation2.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Info Form</title>
    <link rel="stylesheet" href="login_style.css">
</head>
<body>
    <div class="form-wrapper">
        <div class="form-container">
            <p class="form-title">Enter Your Information</p>
            <div class="profile"></div>
            <form method="post">
                <label for="Studentid">Student ID</label>
                <input type="text" id="Studentid" name="Studentid" value="<?php echo htmlspecialchars($name); ?>">
                <span class="error"><?php echo $nameErr;?></span>

                <label for="BookSelector">Select Book</label>
                <select id="BookSelector" name="BookSelector">
                    <option value="">Select a book</option>
                    <option value="The War on Warriors" <?php if ($book == "The War on Warriors") echo 'selected'; ?>>The War on Warriors</option>
                    <option value="Eruption" <?php if ($book == "Eruption") echo 'selected'; ?>>Eruption</option>
                    <option value="Dad I Want to Hear Your Story" <?php if ($book == "Dad I Want to Hear Your Story") echo 'selected'; ?>>Dad I Want to Hear Your Story</option>
                    <option value="The Lost Book of Herbal Remedies" <?php if ($book == "The Lost Book of Herbal Remedies") echo 'selected'; ?>>The Lost Book of Herbal Remedies</option>
                    <option value="Reconnected" <?php if ($book == "Reconnected") echo 'selected'; ?>>Reconnected</option>
                    <option value="You Like It Darker" <?php if ($book == "You Like It Darker") echo 'selected'; ?>>You Like It Darker</option>
                </select>
                <span class="error"><?php echo $bookErr;?></span>

                <label for="email">Email</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
                <span class="error"><?php echo $emailErr;?></span>

                <label for="edate">End Date</label>
                <input type="date" name="edate" value="<?php echo htmlspecialchars($edate); ?>">
                <span class="error"><?php echo $edateErr;?></span>

                <button type="submit" name="submit">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>
