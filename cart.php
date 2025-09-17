<?php
session_start();

// Check if the cart is empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<p>Your cart is empty.</p>";
    echo "<p><a href='index.php'>Go to Shop</a></p>";
    exit;
}

// Include the database connection
include 'db.php';

// Fetch product details from the database for the items in the cart
$cartItems = [];
foreach ($_SESSION['cart'] as $bookId => $quantity) {
    $sql = "SELECT * FROM books WHERE book_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $bookId);
    $stmt->execute();
    $result = $stmt->get_result();
    $book = $result->fetch_assoc();
    
    if ($book) {
        $cartItems[] = [
            'book' => $book,
            'quantity' => $quantity
        ];
    }
}

// Handle update cart
if (isset($_POST['update_cart'])) {
    foreach ($_POST['quantity'] as $bookId => $quantity) {
        if ($quantity == 0) {
            unset($_SESSION['cart'][$bookId]); // Remove product if quantity is 0
        } else {
            $_SESSION['cart'][$bookId] = $quantity; // Update quantity
        }
    }
    header("Location: cart.php"); // Reload the page to reflect changes
    exit;
}

// Handle remove item from cart
if (isset($_POST['remove_item'])) {
    $bookId = $_POST['book_id'];
    unset($_SESSION['cart'][$bookId]);
    header("Location: cart.php"); // Reload the page after removal
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>View Cart</title>
</head>
<body>
    <h1>Book hold</h1>

    <form method="post">
        <table>
            <tr>
                <th>Title</th>
                <th> </th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Remove</th>
            </tr>

            <?php
            $totalPrice = 0;
            foreach ($cartItems as $item) {
                $book = $item['book'];
                $quantity = $item['quantity'];
                $total = $book['quantity'] - $quantity;
                $quantity += $total;
            ?>

            <tr>
                <td><?php echo $book['title']; ?></td>
                <td><?php echo $book['author']; ?></td>
                <td>
                    <input type="number" name="quantity[<?php echo $book['book_id']; ?>]" value="<?php echo $quantity; ?>" min="0">
                </td>
                <td><?php echo $quantity; ?></td>
                <td>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="book_id" value="<?php echo $book['book_id']; ?>">
                        <input type="submit" name="remove_item" value="Remove">
                    </form>
                </td>
                   <td>
                   <a href="checkout2.php?book_id=<?php echo $row['book_id']; ?>">checkout2</a>
                </td>
            </tr>

            <?php } ?>

        </table>
        
        <br>
        <input type="submit" name="update_cart" value="Update Cart">
    </form><br>

    <a href="books.php">Continue to hold book</a> | <a href="checkout2.php">Proceed to Checkout</a>
</body>
</html>
