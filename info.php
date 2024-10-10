<?php
session_start();

// Redirect to login if not authenticated
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: admin_login.php");
    exit();
}

$con = mysqli_connect('localhost', 'root', '', 'bl');
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle deletion
if (isset($_GET['delete_id'])) {
    $delete_id = mysqli_real_escape_string($con, $_GET['delete_id']);
    $delete_query = "DELETE FROM student_book WHERE student_id='$delete_id'";
    
    if (mysqli_query($con, $delete_query)) {
        header("Location: admin_dashboard.php"); // Redirect to refresh the page
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($con);
    }
}

// Fetch data to display in the table
$result = mysqli_query($con, "SELECT student_id, book_id, email, edate FROM student_book");

if (!$result) {
    die("Query failed: " . mysqli_error($con));
}

mysqli_close($con);
?>
