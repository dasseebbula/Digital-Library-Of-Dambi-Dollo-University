<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>notify</title>
</head>
<body>
<a href="circulationpage.php">Back to Home</a>
</body>
</html>
<?php
include('db.php');
$sql = "SELECT borrows.borrow_id, books.title, users.username, borrows.borrow_date, DATE_ADD(borrows.borrow_date, INTERVAL 5 DAY) AS return_date 
        FROM borrows 
        JOIN books ON borrows.book_id = books.book_id 
        JOIN users ON borrows.user_id = users.user_id";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<h2>Borrowed Books Notification</h2>";

    echo "<table border='1'>";
    echo "<tr><th>Book Title</th><th>Username</th><th>Borrow Date</th><th>Return Date</th><th>Notification Link</th></tr>";

    while ($row = $result->fetch_assoc()) {
        $title = htmlspecialchars($row["title"]);
        $username = htmlspecialchars($row["username"]);
        $borrow_date = htmlspecialchars($row["borrow_date"]);
        $return_date = htmlspecialchars($row["return_date"]); 

     
        $link = "sendnotification.php?user=" . urlencode($username) . "&book=" . urlencode($title) . "&return_date=" . urlencode($return_date);

        echo "<tr>";
        echo "<td>$title</td>";
        echo "<td>$username</td>";
        echo "<td>$borrow_date</td>";
        echo "<td>$return_date</td>";
        echo "<td><a href='$link' target='_blank'>Send Notification</a></td>"; 
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No borrowed books found.";
}

$conn->close();
?>
