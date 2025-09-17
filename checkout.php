<?php
include 'db.php';
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    echo "Please log in to check out a book.";
    exit();
}

$user_id = $_SESSION['user_id'];

if (isset($_GET['book_id'])) {
    $book_id = $_GET['book_id'];

    // Check if the book is available
    $sql_check = "SELECT * FROM books WHERE book_id=? AND status='available'";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("i", $book_id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows === 1) {
        // Update book status to 'checked_out' and assign user ID
        $sql_update = "UPDATE books SET status='checked_out', user_id=? WHERE book_id=?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("ii", $user_id, $book_id);

        if ($stmt_update->execute()) {
            echo "Book has been successfully checked out!";
        } else {
            echo "Error: Unable to check out the book.";
        }

        $stmt_update->close();
    } else {
        echo "Sorry, this book is not available for checkout.";
    }

    $stmt_check->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>
