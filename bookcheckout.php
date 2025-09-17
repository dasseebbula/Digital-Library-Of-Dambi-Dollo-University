<?php
session_start();
if (!isset($_SESSION['hold_cart']) || empty($_SESSION['hold_cart'])) {
    echo "<p>Your hold list is empty.</p>";
    echo "<p><a href='books.php'>Browse Books</a></p>";
    exit;
}

include 'db.php';

$holdItems = [];
foreach ($_SESSION['hold_cart'] as $bookId => $quantity) {
    $sql = "SELECT * FROM books WHERE book_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $bookId);
    $stmt->execute();
    $result = $stmt->get_result();
    $book = $result->fetch_assoc();

    if ($book) {
        $holdItems[] = [
            'book' => $book,
            'quantity' => $quantity
        ];
    }
}
if (!isset($_GET['book_id'])) {
    echo "<p>No book selected for checkout.</p>";
    exit;
}

$bookId = (int)$_GET['book_id'];
$stmt = $conn->prepare("SELECT * FROM books WHERE book_id = ?");
$stmt->bind_param("i", $bookId);
$stmt->execute();
$result = $stmt->get_result();
$book = $result->fetch_assoc();

if (!$book) {
    echo "<p>Book not found.</p>";
    exit;
}
if (isset($_POST['submit_checkout'])) {
    $name = $_POST['name'];
    $student_id = $_POST['student_id'];
    $phone = $_POST['phone'];
    $checkout_date = date('Y-m-d');
    $due_date = date('Y-m-d', strtotime('+5 days'));

    $checkoutSql = "INSERT INTO checkouts (name, student_id, phone, checkout_date, due_date) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($checkoutSql);
    $stmt->bind_param("sisss", $name, $student_id, $phone, $checkout_date, $due_date);
    $stmt->execute();
    $checkoutId = $stmt->insert_id;

    foreach ($holdItems as $item) {
        $bookId = $item['book']['book_id'];
        $quantity = $item['quantity'];
        $checkoutDetailSql = "INSERT INTO checkout_details (checkout_id, book_id, quantity) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($checkoutDetailSql);
        $stmt->bind_param("iii", $checkoutId, $bookId, $quantity);
        $stmt->execute();

        // reduce stock
        $stmt = $conn->prepare("UPDATE books SET available_qty = available_qty - ? WHERE book_id = ?");
        $stmt->bind_param("ii", $quantity, $bookId);
        $stmt->execute();
    }

    unset($_SESSION['hold_cart']);
    header("Location: confirm_hold.php?checkout_id=$checkoutId");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Checkout</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Book Checkout</h1>

    <h2>Your Hold List</h2>
    <table>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Quantity</th>
        </tr>
        <?php
        foreach ($holdItems as $item):
            $book = $item['book'];
            $quantity = $item['quantity'];
        ?>
        <tr>
            <td><?php echo htmlspecialchars($book['title']); ?></td>
            <td><?php echo htmlspecialchars($book['author']); ?></td>
            <td><?php echo $quantity; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h3>Total Books: <?php echo array_sum(array_column($holdItems, 'quantity')); ?></h3>

    <h2>User Information</h2>
    <form method="post">
        <label for="name">Full Name:</label><br>
        <input type="text" name="name" id="name" required><br>

        <label for="student_id">Student ID:</label><br>
        <input type="text" name="student_id" id="student_id" required><br>

        <label for="phone">Phone Number:</label><br>
        <input type="text" name="phone" id="phone" required><br>

        <input type="submit" name="submit_checkout" value="Confirm Book Checkout">
    </form>

    <br>
    <a href="books.php"> Browse More Books</a>
</body>
</html>
