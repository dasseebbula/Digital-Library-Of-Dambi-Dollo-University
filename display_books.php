<?php
include 'db.php';

$sql = "SELECT * FROM books";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Books</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h2>View PDF Books</h2>
    <?php while ($row = $result->fetch_assoc()): ?>
        <div>
            <h3><?php echo $row['title']; ?></h3>
            <p>Author: <?php echo $row['author']; ?></p>
            <p>Uploaded on: <?php echo $row['upload_date']; ?></p>
                                <p><?php echo $row['cover_image']; ?></p>
                             <p> <img src="<?php  echo "book_cover/".$row['cover_image'];?>"width="100px"alt="cover_image">
            
            <a href="uploads/<?php echo $row['filename']; ?>" target="_blank">View PDF</a>
        </div>
    <?php endwhile; ?>
    
</body>
</html>