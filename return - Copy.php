<?php
include 'db.php';
session_start();

$book_id = $_GET['book_id'];
$return_date = date('Y-m-d');

$sql = "UPDATE borrows SET return_date = ? WHERE book_id = ? AND return_date IS NULL";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $return_date, $book_id);
$stmt->execute();

$sql = "UPDATE books SET status = 'available' WHERE book_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $book_id);
$stmt->execute();

header('Location: books.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Return Books</title>
</head>
<body>
    <h1>Return Books</h1>
    <form method="post" action="return.php">
        <label for="book_id">Book ID:</label>
        <input type="number" id="book_id" name="book_id" required>
        <br>
        <button type="submit">Return Book</button>
    </form>
    <a href="index.php">Back to Dashboard</a>
</body>
</html>
