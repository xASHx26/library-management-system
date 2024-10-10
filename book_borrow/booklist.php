<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book List</title>
    <link rel="stylesheet" href="booklist.css">
</head>
<body>
    <div class="booklist-container">
        <h2>Book List</h2>
        <?php
            // Connect to the database
            $con = mysqli_connect('localhost', 'root', '', 'book_borrow');

            // Check for connection error
            if (!$con) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Fetch book data from the database
            $sql = "SELECT * FROM books";
            $result = mysqli_query($con, $sql);

            if (mysqli_num_rows($result) > 0) {
                while($book = mysqli_fetch_assoc($result)) {
                    // Set genre color based on genre
                    $genreColor = "";
                    switch ($book['genre']) {
                        case "Fiction":
                            $genreColor = "background-color: #f39c12;";
                            break;
                        case "Dystopian":
                            $genreColor = "background-color: #c0392b;";
                            break;
                        case "Classics":
                            $genreColor = "background-color: #27ae60;";
                            break;
                        case "Literary Fiction":
                            $genreColor = "background-color: #2980b9;";
                            break;
                        case "Fantasy":
                            $genreColor = "background-color: #8e44ad;";
                            break;
                        case "Romance":
                            $genreColor = "background-color: #e74c3c;";
                            break;
                        case "Adventure":
                            $genreColor = "background-color: #f1c40f;";
                            break;
                        case "Historical":
                            $genreColor = "background-color: #7f8c8d;";
                            break;
                        case "Epic Poetry":
                            $genreColor = "background-color: #9b59b6;";
                            break;
                        case "Modernist":
                            $genreColor = "background-color: #2c3e50;";
                            break;
                        case "Philosophical Fiction":
                            $genreColor = "background-color: #34495e;";
                            break;
                        case "Psychological Fiction":
                            $genreColor = "background-color: #16a085;";
                            break;
                        case "Gothic Fiction":
                            $genreColor = "background-color: #d35400;";
                            break;
                        case "Science Fiction":
                            $genreColor = "background-color: #00c3ff;";
                            break;
                        case "Realist Novel":
                            $genreColor = "background-color: #2ecc71;";
                            break;
                        case "Historical Fiction":
                            $genreColor = "background-color: #bdc3c7;";
                            break;
                        default:
                            $genreColor = "background-color: #bdc3c7;";
                    }

                    echo "<div class='book-item'>";
                    echo "<div class='availability-circle'>" . $book['availability'] . "</div>";  
                    echo "<img src='" . $book['image'] . "' alt='" . $book['name'] . "' class='book-image'>";
                    echo "<div class='book-info'>";
                    echo "<span><strong>Book ID:</strong> " . $book['book_id'] . "</span>";
                    echo "<span><strong>Book Name:</strong> " . $book['name'] . "</span>";
                    echo "<span class='book-genre' style='" . $genreColor . "'><strong>Genre:</strong> " . $book['genre'] . "</span>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>No books found in the database.</p>";
            }

            // Close connection
            mysqli_close($con);
        ?>
    </div>
</body>
</html>
