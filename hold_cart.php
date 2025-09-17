<?php
session_start();
if (isset($_GET['book_id'])) {
    $book_id = (int)$_GET['book_id'];
    if (!isset($_SESSION['hold_cart'])) {
        $_SESSION['hold_cart'] = [];
    }
    $_SESSION['hold_cart'][$book_id] = ($_SESSION['hold_cart'][$book_id] ?? 0) + 1;
}
if (!isset($_SESSION['hold_cart']) || empty($_SESSION['hold_cart'])) {
    echo "<p>Your hold list is empty.</p>";
    echo "<p><a href='books.php'>Browse Books</a></p>";
    exit;
}

include 'db.php';

// Fetch book details from the database for the items in the hold cart
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

// Handle hold updates
if (isset($_POST['update_hold'])) {
    foreach ($_POST['quantity'] as $bookId => $quantity) {
        if ($quantity == 0) {
            unset($_SESSION['hold_cart'][$bookId]);
        } else {
            $_SESSION['hold_cart'][$bookId] = $quantity;
        }
    }
    header("Location: hold_cart.php");
    exit;
}

// Handle remove
if (isset($_POST['remove_item'])) {
    $bookId = (int)$_POST['remove_item']; // grab the value
    unset($_SESSION['hold_cart'][$bookId]);
    header("Location: hold_cart.php");
    exit;
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Book Holds</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Books on Hold</h1>

    <form method="post">
        <table>
            <tr>
                <th>Title</th>
                <th>Quantity</th>
                <th>Remove</th>
            </tr>
            <?php foreach ($holdItems as $item): 
                $book = $item['book'];
                $quantity = $item['quantity'];
            ?>
            <tr>
                <td><?php echo htmlspecialchars($book['title']); ?></td>
                <td>
                    <input type="number" name="quantity[<?php echo $book['book_id']; ?>]" value="<?php echo $quantity; ?>" min="0">
                </td>
                <td>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="book_id" value="<?php echo $book['book_id']; ?>">
                        <input type="submit" name="remove_item" value="Remove">
                       
                    </form>
                    <a href="bookcheckout.php?book_id=<?php echo $book['book_id']; ?>">hold</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>

        <br>
        <input type="submit" name="update_hold" value="Update Holds">
    </form>

    <a href="books.php">Browse More Books</a> 
</body>
</html>