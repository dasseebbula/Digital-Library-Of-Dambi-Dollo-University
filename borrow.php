<?php
include 'db.php';
session_start();

$username = $_SESSION['username'] ?? null;
if (!$username) {
    exit("No user session found.");
}

// Step 1: Get user_id from username
$sql = "SELECT user_id FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_id = $row['user_id'];
} else {
    echo "User not found.";
    exit();
}

// Step 2: Get book_id from GET
$book_id = $_GET['book_id'] ?? null;
if (!$book_id) {
    exit("No book selected.");
}

$borrow_date = date('Y-m-d');

// Step 3: Insert into borrows table
$sql = "INSERT INTO borrows (user_id, book_id, borrow_date) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iis", $user_id, $book_id, $borrow_date);
$stmt->execute();

// Step 4: Update book status
$sql = "UPDATE books SET status = 'borrowed' WHERE book_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $book_id);
$stmt->execute();

// ✅ Step 5: Update book_holds status
$sql = "UPDATE book_holds SET status = 'borrowed' WHERE book_id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $book_id, $user_id); // FIXED: two parameters
$stmt->execute();

header('Location: books.php');
exit();
?>