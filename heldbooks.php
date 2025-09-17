<?php
include 'db.php';
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $sql = "SELECT 
                bh.user_id,
                bh.book_id,
                bh.hold_date,
                bh.status,
                b.title,
                b.author
            FROM book_holds bh
            JOIN books b ON bh.book_id = b.book_id
            WHERE bh.status = 'checked_out'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>User ID</th>
                    <th>Book ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Hold Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['user_id']}</td>
                    <td>{$row['book_id']}</td>
                    <td>{$row['title']}</td>
                    <td>{$row['author']}</td>
                    <td>{$row['hold_date']}</td>
                    <td>{$row['status']}</td>
                    <td>
                        <a href='borrow.php?book_id={$row['book_id']}&user_id={$row['user_id']}'>Borrow</a>
                    </td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No checked-out records found.";
    }
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage();
}

$conn->close();
?>
<?php
include 'db.php';
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$book_id = $_GET['book_id'] ?? null;
$user_id = $_GET['user_id'] ?? null;

if (!$book_id || !$user_id) {
    exit("Missing book or user ID.");
}

try {
    // Step 1: Verify the hold exists and is 'checked_out'
    $stmt_check = $conn->prepare("SELECT id FROM book_holds WHERE book_id = ? AND user_id = ? AND status = 'checked_out'");
    $stmt_check->bind_param("ii", $book_id, $user_id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows === 0) {
        exit("❌ No matching checked-out record found.");
    }

    // Step 2: Update book status to 'borrowed'
    $stmt_update_book = $conn->prepare("UPDATE books SET status = 'borrowed' WHERE book_id = ?");
    $stmt_update_book->bind_param("i", $book_id);
    $stmt_update_book->execute();

    // Step 3: Update book_holds status to 'borrowed'
    $stmt_update_hold = $conn->prepare("UPDATE book_holds SET status = 'borrowed' WHERE book_id = ? AND user_id = ?");
    $stmt_update_hold->bind_param("ii", $book_id, $user_id);
    $stmt_update_hold->execute();

    echo "✅ Book and hold status successfully updated to 'borrowed'!";
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage();
}

$conn->close();
?>