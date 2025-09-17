<?php
include('db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Borrowed Books</title>
    <style>
        /* General styling */
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f9f9f9; }
        table { width: 80%; margin: 20px auto; border-collapse: collapse; background: white; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: center; }
        th { background: lightseagreen; color: white; text-transform: uppercase; }
        tr:nth-child(even) { background: #f2f2f2; }
        tr:hover { background: #e9e9e9; }
        input[type="text"] { width: 200px; padding: 8px; margin: 10px auto; display: block; }
    </style>
    <script>
        function searchBooks() {
            let filter = document.getElementById("search").value.toLowerCase();
            let rows = document.querySelectorAll(".book-row");
            
            rows.forEach(row => {
                let title = row.querySelector(".title").textContent.toLowerCase();
                let username = row.querySelector(".username").textContent.toLowerCase();
                if (title.includes(filter) || username.includes(filter)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        }
    </script>
</head>
<body>
<a href="circulationpage.php">Back Home</a>
    <h2>Borrowed Books</h2>
    <input type="text" id="search" placeholder="Search by title or username" onkeyup="searchBooks()">
    
    <table>
        <tr>
            <th>Book ID</th>
            <th>Title</th>
            <th>User ID</th>
            <th>Username</th>
            <th>Borrow Date</th>
            <th>Status</th>
        </tr>
        <?php
        $sql = "SELECT books.book_id, books.title, books.status, users.user_id, users.username, borrows.borrow_date
                FROM borrows
                JOIN books ON borrows.book_id = books.book_id
                JOIN users ON borrows.user_id = users.user_id WHERE books.status='borrowed'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr class='book-row'>";
                echo "<td>" .$row["book_id"]. "</td>";
                echo "<td class='title'>" . htmlspecialchars($row["title"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["user_id"]) . "</td>";
                echo "<td class='username'>" . htmlspecialchars($row["username"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["borrow_date"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["status"]) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No borrowed books found.</td></tr>";
        }

        $conn->close();
        ?>
    </table>

</body>
</html>
