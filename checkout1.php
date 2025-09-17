<?php
session_start();
if (!isset($_SESSION['bookhold']) || empty($_SESSION['bookhold'])) {
    echo "<p>Your bookhold is empty.</p>";
    echo "<p><a href='index.php'>Go to Shop</a></p>";
    exit;
}
include 'db.php';
$cartItems = [];
foreach ($_SESSION['bookhold'] as $bookId => $quantity) {
    $sql = "SELECT * FROM books WHERE book_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $bookId);
    $stmt->execute();
    $result = $stmt->get_result();
    $book = $result->fetch_assoc();
    
    if ($book) {
        $bookholdItems[] = [
            'product' => $book,
            'quantity' => $quantity
        ];
    }
}

if (isset($_POST['submit_order'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $zip = $_POST['zip'];
    $phone = $_POST['phone'];
    $totalPrice = 0;
    foreach ($cartItems as $item) {
        $book = $item['book'];
        $quantity = $item['quantity'];
        $totalPrice += $book['isbn'] * $quantity;
    }
    $orderSql = "INSERT INTO orders (customer_name, address, city, zip, phone, total_price) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($orderSql);
    $stmt->bind_param("sssssd", $name, $address, $city, $zip, $phone, $totalPrice);
    $stmt->execute();
    $orderId = $stmt->insert_id;
    foreach ($cartItems as $item) {
        $productId = $item['book']['product_id'];
        $quantity = $item['quantity'];
        $isbn = $item['book']['isbn'];
        $orderDetailSql = "INSERT INTO order_details (order_id, product_id, quantity, isbn) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($orderDetailSql);
        $stmt->bind_param("iiid", $orderId, $productId, $quantity, $isbn);
        $stmt->execute();
    }
    unset($_SESSION['bookhold']);
    header("Location: order_confirmation.php?order_id=$orderId");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Checkout</title>
</head>
<body>
    <h1>Checkout</h1>

    <h2>Your book hold</h2>
    <table>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>

        <?php
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $book = $item['book'];
            $quantity = $item['quantity'];
            $total = $book['isbn'] * $quantity;
            $totalPrice += $total;
        ?>

        <tr>
            <td><?php echo $book['title']; ?></td>
            <td>$<?php echo number_format($book['author'], 2); ?></td>
            <td><?php echo $quantity; ?></td>
            <td>$<?php echo number_format($total, 2); ?></td>
        </tr>

        <?php } ?>

    </table>

    <h3>Total: $<?php echo number_format($totalPrice, 2); ?></h3>

    <h2>Shipping Information</h2>
    <form method="post">
        <label for="name">Full Name:</label><br>
        <input type="text" name="name" id="name" required><br>

        <label for="address">Address:</label><br>
        <input type="text" name="address" id="address" required><br>

        <label for="city">City:</label><br>
        <input type="text" name="city" id="city" required><br>

        <label for="zip">POST Code:</label><br>
        <input type="text" name="zip" id="zip" required><br>

        <label for="phone">Phone Number:</label><br>
        <input type="text" name="phone" id="phone" required><br>

        <input type="submit" name="submit_order" value="Place Order">
    </form>

    <br>
    <a href="index.php">Continue Shopping</a>
</body>
</html>
