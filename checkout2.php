<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? null;
    $student_id = $_POST['student_id'] ?? null;
    $phone = $_POST['phone'] ?? null;
    $user_id = $_POST['user_id'] ?? null;
    $book_id = $_POST['book_id'] ?? null;
    $due_date = $_POST['due_date'] ?? null;
    $checkout_date = date("Y-m-d H:i:s");

    if (!$name || !$student_id || !$due_date || !$user_id || !$book_id) {
        exit("Missing required fields.");
    }

    try {
        // Step 1: Verify hold exists
        $stmt_check = $conn->prepare("SELECT id FROM book_holds WHERE user_id = ? AND book_id = ? AND status = 'on_hold'");
        $stmt_check->bind_param("ii", $user_id, $book_id);
        $stmt_check->execute();
        $result = $stmt_check->get_result();

        if ($result->num_rows === 0) {
            exit("❌ No valid hold found for this user and book.");
        }

        // Step 2: Insert checkout record
        $sql = "INSERT INTO checkouts (name, student_id, phone, checkout_date, due_date)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $name, $student_id, $phone, $checkout_date, $due_date);
        $stmt->execute();

        // Step 3: Update book status
        $stmt_update_book = $conn->prepare("UPDATE books SET status = 'checked_out' WHERE book_id = ?");
        $stmt_update_book->bind_param("i", $book_id);
        $stmt_update_book->execute();

        // Step 4: Update hold status
        $stmt_update_hold = $conn->prepare("UPDATE book_holds SET status = 'checked_out' WHERE user_id = ? AND book_id = ?");
        $stmt_update_hold->bind_param("ii", $user_id, $book_id);
        $stmt_update_hold->execute();

        echo "✅ Book checked out successfully!";
    } catch (Exception $e) {
        echo "❌ Error: " . $e->getMessage();
    }
} else {
    echo " ";
}
?>

<?php

try {
    $sql = "SELECT id, user_id, book_id, hold_date, status FROM book_holds WHERE status = 'on_hold'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Book ID</th>
                    <th>Hold Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['user_id']}</td>
                    <td>{$row['book_id']}</td>
                    <td>{$row['hold_date']}</td>
                    <td>{$row['status']}</td>
                    <td>";

            // Use regular HTML for the form
            ?>
                <form method='POST' action='checkout2.php'>
                    <input type='hidden' name='book_hold_id' value='<?= $row['id'] ?>'>
                    <input type='hidden' name='user_id' value='<?= $row['user_id'] ?>'>
                    <input type='hidden' name='book_id' value='<?= $row['book_id'] ?>'>
                    <input type='text' name='name' placeholder='Full Name' required>
                    <input type='text' name='student_id' placeholder='Student ID' required>
                    <input type='text' name='phone' placeholder='Phone Number'>
                    <input type='datetime-local' name='due_date' required>
                    <button type='submit'>Check Out</button>
                </form>
            <?php
            echo "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No hold records found.";
    }
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage();
}

$conn->close();
?>