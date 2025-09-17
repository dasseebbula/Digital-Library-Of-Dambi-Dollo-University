<?php
session_start();
include 'db.php';

if (!isset($_GET['checkout_id'])) {
    echo "<p>Invalid request. No checkout ID provided.</p>";
    echo "<p><a href='books.php'>Return to Browse Books</a></p>";
    exit;
}

$checkoutId = (int)$_GET['checkout_id'];

// Fetch checkout summary
$stmt = $conn->prepare("SELECT name, student_id, phone, checkout_date, due_date FROM checkouts WHERE checkout_id = ?");
$stmt->bind_param("i", $checkoutId);
$stmt->execute();
$stmt->bind_result($name, $studentId, $phone, $checkoutDate, $dueDate);
$stmt->fetch();
$stmt->close();

// Fetch checked-out books
$stmt = $conn->prepare("
    SELECT b.title, cd.quantity
    FROM checkout_details cd
    JOIN books b ON cd.book_id = b.book_id
    WHERE cd.checkout_id = ?
");
$stmt->bind_param("i", $checkoutId);
$stmt->execute();
$result = $stmt->get_result();
$books = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout Confirmation</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Checkout Confirmed</h1>

    <p><strong>Name:</strong> <?php echo htmlspecialchars($name); ?></p>
    <p><strong>Student ID:</strong> <?php echo htmlspecialchars($studentId); ?></p>
    <p><strong>Phone:</strong> <?php echo htmlspecialchars($phone); ?></p>
    <p><strong>Checkout Date:</strong> <?php echo htmlspecialchars($checkoutDate); ?></p>
    <p><strong>Due Date:</strong> <?php echo htmlspecialchars($dueDate); ?></p>

    <h3>Books Checked Out:</h3>
    <ul>
        <?php foreach ($books as $book): ?>
            <li><?php echo htmlspecialchars($book['title']) . " × " . $book['quantity']; ?></li>
        <?php endforeach; ?>
    </ul>

    <p>Please return your books by the due date to avoid late fees. Happy reading!</p>
    <a href="books.php">Browse More Books</a>
</body>
</html>