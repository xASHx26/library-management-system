<?php
session_start();

$con = mysqli_connect('localhost', 'root', '', 'book_borrow');

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $book_name = $_POST['book'];

    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        // Verify user identity
        $sql = "SELECT * FROM login_info WHERE ID = ?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, 's', $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($user = mysqli_fetch_assoc($result)) {
            if ($user['ID'] === $student_id && $user['Email'] === $email) {
                
                // Check if the user already borrowed the book
                $sql = "SELECT book_name, end_date FROM book_loans WHERE student_id = ?";
                $stmt = mysqli_prepare($con, $sql);
                mysqli_stmt_bind_param($stmt, 's', $student_id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) > 0) {
                    $existing_loans = [];
                    while ($existing_loan = mysqli_fetch_assoc($result)) {
                        $existing_loans[] = $existing_loan;
                    }
                    $error_message = "You have already borrowed the following book(s):<br>";
                    foreach ($existing_loans as $loan) {
                        $error_message .= "Book: " . $loan['book_name'] . " - Return date: " . $loan['end_date'] . "<br>";
                    }
                } else {
                    // Check the availability of the selected book
                    $sql = "SELECT availability FROM books WHERE name = ?";
                    $stmt = mysqli_prepare($con, $sql);
                    mysqli_stmt_bind_param($stmt, 's', $book_name);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    if ($book = mysqli_fetch_assoc($result)) {
                        if ($book['availability'] > 0) {
                            // Book is available, proceed with loan
                            $date = date('Y-m-d');
                            $end_date = date('Y-m-d', strtotime('+1 week'));

                            // Insert into book_loans table
                            $sql = "INSERT INTO book_loans (student_id, email, phone, book_name, loan_date, end_date) VALUES (?, ?, ?, ?, ?, ?)";
                            $stmt = mysqli_prepare($con, $sql);
                            mysqli_stmt_bind_param($stmt, 'ssssss', $student_id, $email, $phone, $book_name, $date, $end_date);

                            if (mysqli_stmt_execute($stmt)) {
                                $success_message = "Book loan recorded successfully! Due date: $end_date";

                                // Update availability in the books table
                                $sql = "UPDATE books SET availability = availability - 1 WHERE name = ?";
                                $stmt = mysqli_prepare($con, $sql);
                                mysqli_stmt_bind_param($stmt, 's', $book_name);
                                mysqli_stmt_execute($stmt);

                                // Check if there's an entry in the loan history for this book
                                $sql = "SELECT * FROM book_loan_history WHERE student_id = ? AND book_name = ?";
                                $stmt = mysqli_prepare($con, $sql);
                                mysqli_stmt_bind_param($stmt, 'ss', $student_id, $book_name);
                                mysqli_stmt_execute($stmt);
                                $history_result = mysqli_stmt_get_result($stmt);

                                if (mysqli_num_rows($history_result) > 0) {
                                    // Update the existing loan history
                                    $sql = "UPDATE book_loan_history SET number_of_time = number_of_time + 1, date = ? WHERE student_id = ? AND book_name = ?";
                                    $stmt = mysqli_prepare($con, $sql);
                                    mysqli_stmt_bind_param($stmt, 'sss', $date, $student_id, $book_name);
                                    mysqli_stmt_execute($stmt);
                                } else {
                                    // Insert into loan history
                                    $sql = "INSERT INTO book_loan_history (student_id, book_name, date, number_of_time) VALUES (?, ?, ?, 1)";
                                    $stmt = mysqli_prepare($con, $sql);
                                    mysqli_stmt_bind_param($stmt, 'sss', $student_id, $book_name, $date);
                                    mysqli_stmt_execute($stmt);
                                }
                            } else {
                                $error_message = "Failed to record book loan: " . mysqli_error($con);
                            }
                        } else {
                            // Book is not available
                            $error_message = "The book '$book_name' is currently not available for loan.";
                        }
                    } else {
                        $error_message = "Book not found.";
                    }
                }
            } else {
                $error_message = "Wrong Student ID or Email.";
            }
        } else {
            $error_message = "User not found.";
        }

        mysqli_stmt_close($stmt);
    } else {
        $error_message = "You must be logged in to borrow books.";
    }

    mysqli_close($con);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bookloan_styles.css">
    <title>Book Loan Form</title>
</head>
<body>
<div class="form-container">
    <h2>Book Loan Form</h2>

    <!-- Display success or error message -->
    <?php if (isset($success_message)): ?>
        <p class="success"><?php echo $success_message; ?></p>
    <?php elseif (isset($error_message)): ?>
        <p class="error"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <form action="BookLoan.php" method="post">
        <label for="student_id">Student ID</label>
        <input type="text" id="student_id" name="student_id" placeholder="Enter your Student ID" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter your Email" required>

        <label for="phone">Phone Number</label>
        <input type="text" id="phone" name="phone" placeholder="Enter your Phone Number" required>

        <label for="book">Select a Book</label>
        <select id="book" name="book" required>
                <option value="" disabled selected>Select a book</option>
                <option value="To Kill a Mockingbird">To Kill a Mockingbird</option>
                <option value="1984">1984</option>
                <option value="The Great Gatsby">The Great Gatsby</option>
                <option value="The Catcher in the Rye">The Catcher in the Rye</option>
                <option value="The Lord of the Rings">The Lord of the Rings</option>
                <option value="Pride and Prejudice">Pride and Prejudice</option>
                <option value="The Hobbit">The Hobbit</option>
                <option value="Moby Dick">Moby Dick</option>
                <option value="War and Peace">War and Peace</option>
                <option value="The Odyssey">The Odyssey</option>
                <option value="Jane Eyre">Jane Eyre</option>
                <option value="Brave New World">Brave New World</option>
                <option value="Crime and Punishment">Crime and Punishment</option>
                <option value="The Divine Comedy">The Divine Comedy</option>
                <option value="Les Misérables">Les Misérables</option>
                <option value="Anna Karenina">Anna Karenina</option>
                <option value="The Brothers Karamazov">The Brothers Karamazov</option>
                <option value="One Hundred Years of Solitude">One Hundred Years of Solitude</option>
                <option value="Don Quixote">Don Quixote</option>
                <option value="The Iliad">The Iliad</option>
            </select>
        <button type="submit">Submit Loan</button>
    </form>
</div>
</body>
</html>
