<?php
include('db.php');
session_start();

// Fetch all feedback from database
$sql = "SELECT * FROM feedback ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Feedback</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; text-align: left; border: 1px solid #ddd; }
        th { background-color: #f4f4f4; }
        input { padding: 8px; width: 200px; margin-bottom: 10px; }
    </style>
    <script>
        function searchFeedback() {
            let filter = document.getElementById("search").value.toLowerCase();
            let rows = document.querySelectorAll(".feedback-row");
            
            rows.forEach(row => {
                let email = row.querySelector(".email").textContent.toLowerCase();
                let comment = row.querySelector(".comment").textContent.toLowerCase();
                if (email.includes(filter) || comment.includes(filter)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        }
    </script>
</head>
<body>

    <h1>All Feedback</h1>
    <input type="text" id="search" placeholder="Search feedback..." onkeyup="searchFeedback()">
    <table>
        <tr>
            <th>Email</th>
            <th>Comment</th>
            <th>Rating (%)</th>
            <th>Time</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr class='feedback-row'>";
                echo "<td class='email'>" . htmlspecialchars($row['email']) . "</td>";
                echo "<td class='comment'>" . htmlspecialchars($row['comment']) . "</td>";
                echo "<td>" . ($row['percent_given'] !== null ? htmlspecialchars($row['percent_given']) . "%" : "N/A") . "</td>";
                echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No feedback submitted yet.</td></tr>";
        }
        ?>
    </table>

</body>
</html>
