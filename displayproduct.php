<?php
session_start();
include 'db.php';

$sql = "SELECT * FROM books";
$result = $conn->query($sql);

if (isset($_POST['add_to_cart'])) {
    $bookId = $_POST['book_id'];
    $quantity = $_POST['quantity'];

    // Initialize the cart if it doesn't exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Add product to cart
    if (isset($_SESSION['cart'][$bookId])) {
        $_SESSION['cart'][$bookId] += $quantity;
    } else {
        $_SESSION['cart'][$bookId] = $quantity;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>LMS</title>
</head>
<body>
    <h1>LMS</h1>
    <h2>books</h2>
    <table>
        <tr>
            <th>Title</th>
            <th>Quantity</th>
            <th>Add to Cart</th>
        </tr>
        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['quantity']; ?></td>
            <td>
                <form method="post">
                    <input type="hidden" name="book_id" value="<?php echo $row['book_id']; ?>">
                    <input type="number" name="quantity" min="1" value="1">
                    <input type="submit" name="add_to_cart" value="Add to Cart">
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>

    <h2><a href="cart.php">View Cart</a></h2>
</body>
</html>
