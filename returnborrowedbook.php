<?php
include 'db.php';
session_start();

$sql = "SELECT * FROM books WHERE status='borrowed'"; // status='available'
$result = $conn->query($sql);
?>
<h2>Borrowed Books</h2>
<?php while ($row = $result->fetch_assoc()): ?>
    <div>
        <h3><?php echo $row['title']; ?></h3>
        <p>Author: <?php echo $row['author']; ?></p>
        <p>ISBN: <?php echo $row['isbn']; ?></p>
        <p> <img src="<?php echo "book_cover/" . $row['cover_image']; ?>" width="100px" alt="cover_image"></p>
        <p>Given Date: 5 days</p>
        <p>Status: <?php echo $row['status']; ?></p>
        <?php if ($row['status'] == 'available'): ?>
            <a href="borrow.php?book_id=<?php echo $row['book_id']; ?>">Borrow</a>
        <?php else: ?>
            <a href="return.php?book_id=<?php echo $row['book_id']; ?>">Return</a>
        <?php endif; ?>
    </div>
<?php endwhile; ?>
