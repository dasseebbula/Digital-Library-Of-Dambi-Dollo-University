<?php
include('db.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = htmlspecialchars($_POST["user_id"]);
    $department = htmlspecialchars($_POST["department"]);
    $bookTitle = htmlspecialchars($_POST["book_title"]);
    $quantity = intval($_POST["quantity"]);

    // Insert data into the database
    $sql = "INSERT INTO Orders (user_id, department, book_title, quantity) 
            VALUES ($userId, '$department', '$bookTitle', $quantity)";

    if ($conn->query($sql) === TRUE) {
        echo "<h1>Order Confirmation</h1>";
        echo "<p>Thank you for your order!</p>";
        echo "<p><strong>User ID:</strong> $userId</p>";
        echo "<p><strong>Department:</strong> $department</p>";
        echo "<p><strong>Book Title:</strong> $bookTitle</p>";
        echo "<p><strong>Quantity:</strong> $quantity</p>";
        echo "<p>Your order has been placed successfully.</p>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
