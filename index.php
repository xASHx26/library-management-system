<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Select Currency</title>
</head>
<body>
    <h1>Set Currency</h1>
    <form action="process.php" method="post">
        <label for="currency-bdt">BDT</label>
        <input type="radio" id="currency-bdt" name="currency" value="BDT">
        <label for="currency-usd">USD</label>
        <input type="radio" id="currency-usd" name="currency" value="USD">
        <br><br>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="Enter your username">
        <br><br>
        <label for="nn">nn:</label>
        <input type="text" id="nn" name="nn" placeholder="Enter nn">
        <br><br>
        <input type="submit" name="submit" value="Set">
    </form>
</body>
</html>
