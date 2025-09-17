<?php
include 'db.php';

if (isset($_GET['query'])) {
    $search = $_GET['query'];
    $sql = "SELECT * FROM books WHERE (title LIKE ? OR author LIKE ? OR isbn LIKE ?) AND status='available'";
    $stmt = $conn->prepare($sql);
    $searchParam = "%$search%";
    $stmt->bind_param("sss", $searchParam, $searchParam, $searchParam);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div>";
            echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
            echo "<p>Author: " . htmlspecialchars($row['author']) . "</p>";
            echo "<p>ISBN: " . htmlspecialchars($row['isbn']) . "</p>";
            echo "<img src='book_cover/" . htmlspecialchars($row['cover_image']) . "' width='100px' alt='Cover Image'>";
            echo "<p>Status: " . htmlspecialchars($row['status']) . "</p>";
            echo "<a href='bookhold.php?book_id=" . htmlspecialchars($row['book_id']) . "'>Hold</a>";
            echo "</div>";
        }
    } else {
        echo "<p>No books found matching your search.</p>";
    }

    $stmt->close();
}

$conn->close();
?>
