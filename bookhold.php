<?php
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $book_id = $_GET['book_id'] ?? null;
    $user_id = $_POST['user_id'] ?? null;

    if (!$book_id || !$user_id) {
        exit("Missing required fields.");
    }

    try {
        $sql_check = "SELECT book_id FROM books WHERE book_id = ? AND status = 'available'";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param("i", $book_id);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows === 0) {
            exit("Book is not available for hold.");
        }

        $sql_update = "UPDATE books SET status = 'on_hold' WHERE book_id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("i", $book_id);
        $stmt_update->execute();

        $sql_insert = "INSERT INTO book_holds (user_id, book_id, hold_date, status)
                       VALUES (?, ?, NOW(), 'on_hold')";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("ii", $user_id, $book_id);
        $stmt_insert->execute();

        echo "✅ Book placed on hold and recorded successfully!";
    } catch (Exception $e) {
        echo "❌ Error: " . $e->getMessage();
    }

    $conn->close();
    exit;
}
?>

<?php
$book_id = $_GET['book_id'] ?? null;

if ($book_id) {
    echo "<h3>Place Hold for Book ID: {$book_id}</h3>";
    ?>
    <form method="POST" action="bookhold.php?book_id=<?= $book_id ?>">
        <input type="number" name="user_id" placeholder="User ID" required>
        <button type="submit">Place Hold</button>
    </form>
    <?php
} else {
    try {
        $sql = "SELECT book_id, title FROM books WHERE status = 'available'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<ul>";
            while ($book = $result->fetch_assoc()) {
                echo "<li>
                        {$book['title']} 
                        <a href='bookhold.php?book_id={$book['book_id']}'>Place Hold</a>
                      </li>";
            }
            echo "</ul>";
        } else {
            echo "No available books.";
        }
    } catch (Exception $e) {
        echo "❌ Error: " . $e->getMessage();
    }

    $conn->close();
}
?>