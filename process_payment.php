<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $penalty = $_POST['penalty'];
    $book_id = $_POST['book_id'];

    // Simulate payment processing
    // You can replace this with actual payment gateway integration
    $payment_successful = true; // Assume payment is successful for now

    if ($payment_successful) {
        // Update the book status to 'available'
        $sql = "UPDATE books SET status = 'available' WHERE book_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $book_id);
        $stmt->execute();

        // Redirect to confirmation page
        header('Location: returnborrowedbook.php?msg=Payment Successful&status=Book Returned');
        exit();
    } else {
        // Redirect back with an error message
        header('Location: returnborrowedbook.php?msg=Payment Failed&penalty=' . $penalty);
        exit();
    }
} else {
    // Invalid request method
    header('Location: returnborrowedbook.php?msg=Invalid Request');
    exit();
}
?>
