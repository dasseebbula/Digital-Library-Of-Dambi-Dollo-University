
CREATE TABLE users ( user_id INT AUTO_INCREMENT PRIMARY KEY, username VARCHAR(50) NOT NULL, email VARCHAR(100) NOT NULL, password VARCHAR(255) NOT NULL );


CREATE TABLE books ( book_id INT AUTO_INCREMENT PRIMARY KEY, title VARCHAR(255) NOT NULL, author VARCHAR(255) NOT NULL, isbn VARCHAR(20), cover_image VARCHAR(255), status ENUM('available', 'borrowed') DEFAULT 'available' );


CREATE TABLE borrows ( borrow_id INT AUTO_INCREMENT PRIMARY KEY, user_id INT, book_id INT, borrow_date DATE NOT NULL, return_date DATE, FOREIGN KEY (user_id) REFERENCES users(user_id), FOREIGN KEY (book_id) REFERENCES books(book_id) );