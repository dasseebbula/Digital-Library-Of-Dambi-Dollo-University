<?php
include 'db.php';

// Fetch all books that are currently on hold
$sql = "SELECT * FROM books WHERE status='on_hold'";
$result = $conn->query($sql);
?>
<a href="studentpage.php">Bach to Home</a>
<h2>Held Books</h2>
<?php if ($result->num_rows > 0): ?>
    <?php while ($row = $result->fetch_assoc()): ?>
        <div>
            <h3><?php echo $row['title']; ?></h3>
            <p>Author: <?php echo $row['author']; ?></p>
            <p>ISBN: <?php echo $row['isbn']; ?></p>
            <p><img src="<?php echo "book_cover/".$row['cover_image']; ?>" width="100px" alt="Cover Image"></p>
            <p>Status: <?php echo $row['status']; ?></p>
            <a href="borrow.php?book_id=<?php echo $row['book_id']; ?>">Borrow</a>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <p>There are no books currently on hold.</p>
<?php endif; ?>

<?php
$conn->close();
?>
