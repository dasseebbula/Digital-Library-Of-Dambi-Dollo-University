<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Books</title>
</head>
<body>
    <a href="circulationpage.php">Back to Home</a>
    <h2>
<a href="Computerscincebooks.php">Computer Scince Books</a><br><br>
<a href="Physicsbooks.php">Physics Bossoks</a><br><br>
<a href="Healthbooks.php">Health Books</a><br><br>
</h2>

</body>
</html>
<?php
include 'db.php';
session_start();
$sql = "SELECT * FROM books WHERE status='available'";//status='available'
$result = $conn->query($sql);
?>

<h3>All Books</h3>
<?php while ($row = $result->fetch_assoc()): ?>
    <div>
        <h3><?php echo $row['title']; ?></h3>
        <p>Author: <?php echo $row['author']; ?></p>
        <p>ISBN: <?php echo $row['isbn']; ?></p>
        <p> <img src="<?php  echo "book_cover/".$row['cover_image'];?>"width="100px"alt="cover_image">
        
        <p>Status: <?php echo $row['status']; ?></p>
        <?php if ($row['status'] == 'available'): ?>
            <a href="bookhold.php?book_id=<?php echo $row['book_id']; ?>">Add to hold</a>

        <?php else: ?>
            <a href="return.php?book_id=<?php echo $row['book_id']; ?>">Return</a>
            
        <?php endif; ?>
    </div>
<?php endwhile; ?>
