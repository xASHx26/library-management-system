<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Book List</title>
    <link rel="stylesheet" href="onlin.css">
    
       
</head>
<body>

    <div class="booklist-container">
        <h2>Online Book List</h2>
        <table class="book-table">
            <thead>
                <tr>
                    <th>Book No</th>
                    <th>Book Name</th>
                    <th>Genre</th>
                    <th>Released Year</th>
                    <th>Read online</th>
                    <th>Download</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $books = [
                        ["id" => 1, "name" => "Beloved", "genre" => "Historical Fiction", "year" => 2020, "pdf" => "Beloved.pdf"],
                        ["id" => 2, "name" => "Dune by Frank Herbert", "genre" => "Si-Fi", "year" => 1965, "pdf" => "Dune by Frank Herbert.pdf"],
                        ["id" => 3, "name" => "The Great Gatsby", "genre" => "Fiction", "year" => 1925, "pdf" => "gatsby.pdf"],
                        ["id" => 4, "name" => "The Catcher in the Rye", "genre" => "Fiction", "year" => 1951, "pdf" => "catcher.pdf"],
                        ["id" => 5, "name" => "The Lord of the Rings", "genre" => "Fantasy", "year" => 1954, "pdf" => "lotr.pdf"],
                        
                    ];

                    foreach ($books as $book) {
                        echo "<tr>";
                        echo "<td>" . $book['id'] . "</td>";
                        echo "<td>" . $book['name'] . "</td>";
                        echo "<td>" . $book['genre'] . "</td>";
                        echo "<td>" . $book['year'] . "</td>";
                        echo "<td><a href='pdfs/" . $book['pdf'] . "' target='_blank'>Read online</a></td>";
                        echo "<td><a href='pdfs/" . $book['pdf'] . "' download>Download PDF</a></td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
    <div>
     <div class="wave"></div>
     <div class="wave"></div>
     <div class="wave"></div>
  </div>
</body>
</html>
