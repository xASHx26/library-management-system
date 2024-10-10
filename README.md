# library_system
I am new in web tech .just wanted to create an library system for my personal project
To run it in your computer just run the following sql_query in the phpmyadmin 

***If any of the database shows error in the code just go to the follwong code and change the name of that data **


-- Create the database
CREATE DATABASE IF NOT EXISTS book_borrow;
USE book_borrow;

-- Create the login_info table
CREATE TABLE IF NOT EXISTS login_info (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(255) NOT NULL,
    Email VARCHAR(255) NOT NULL,
    Password VARCHAR(255) NOT NULL,
    Number VARCHAR(15) NOT NULL,
    ID VARCHAR(255) NOT NULL,
    security_question VARCHAR(255) NOT NULL,
    security_answer VARCHAR(255) NOT NULL
);

-- Create the book_loan_history table
CREATE TABLE IF NOT EXISTS book_loan_history (
    history_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id VARCHAR(255) NOT NULL,
    book_name VARCHAR(255) NOT NULL,
    date DATE NOT NULL,
    number_of_time INT NOT NULL
);

-- Create the book_loans table
CREATE TABLE IF NOT EXISTS book_loans (
    loan_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    book_name VARCHAR(255) NOT NULL,
    loan_date DATE NOT NULL,
    end_date DATE NOT NULL
);

-- Create the books table
CREATE TABLE IF NOT EXISTS books (
    book_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    image VARCHAR(255) NOT NULL,
    genre VARCHAR(255) NOT NULL,
    availability INT DEFAULT 0
);

-- Insert data into the books table
INSERT INTO books (name, image, genre, availability) VALUES
('To Kill a Mockingbird', '1200px-To_Kill_a_Mockingbird_(first_edition_cover).jpg', 'Fiction', 2),
('1984', '1982_(book)_cover.jpg', 'Dystopian', 3),
('The Great Gatsby', 'images.jpg', 'Classics', 1),
('The Catcher in the Rye', 'observerbd.com_1580489151.jpg', 'Literary Fiction', 4),
('The Lord of the Rings', 'y648.jpg', 'Fantasy', 5),
('Pride and Prejudice', 'cover.jpg', 'Romance', 2),
('The Hobbit', '71k--OLmZKL._AC_UF894,1000_QL80_.jpg', 'Fantasy', 3),
('Moby Dick', '71k--OLmZKL._AC_UF894,1000_QL80_.jpg', 'Adventure', 1),
('War and Peace', '125209426.jpg', 'Historical', 2),
('The Odyssey', 'images (1).jpg', 'Epic Poetry', 0),
('Ulysses', 'cover (1).jpg', 'Modernist', 1),
('The Brothers Karamazov', '9781429927215.jpg', 'Philosophical Fiction', 2),
('Crime and Punishment', '71O2XIytdqL._AC_UF1000,1000_QL80_.jpg', 'Psychological Fiction', 1),
('Jane Eyre', 'JaneEyre.jpg', 'Romance', 3),
('Wuthering Heights', '9781471141638_hr.jpg', 'Gothic Fiction', 0),
('Brave New World', 'BraveNewWorld_FirstEdition.jpg', 'Science Fiction', 4),
('The Divine Comedy', '51i-9SGWr-L._AC_UF1000,1000_QL80_.jpg', 'Epic Poetry', 1),
('Anna Karenina', '15823480.jpg', 'Realist Novel', 2),
('Les Misérables', '24280.jpg', 'Historical Fiction', 0),
('The Iliad', 'canon-classics-books-the-iliad-worldview-edition-28066901131312.webp', 'Epic Poetry', 3);

