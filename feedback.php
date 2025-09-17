<?php
include('db.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim(htmlspecialchars($_POST['email']));
    $comment = trim(htmlspecialchars($_POST['comment']));
    $percent_given = isset($_POST['give_percent']) ? intval($_POST['percent']) : null;

    if (!empty($email) && !empty($comment)) {
        $sql = "INSERT INTO feedback (email, comment, percent_given) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $email, $comment, $percent_given);
        
        if ($stmt->execute()) {
            echo "<script>alert('Feedback submitted successfully!'); window.location.href='feedback.php';</script>";
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "<script>alert('Please fill in all fields.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Submit Feedback</title>
    <script>
        function togglePercentInput() {
            let checkBox = document.getElementById("give_percent");
            let percentInput = document.getElementById("percent_input");
            percentInput.style.display = checkBox.checked ? "block" : "none";
        }
    </script>
</head>
<body>
       <a href="studentpage.php">Back to Home</a>
    <h1>Submit Feedback</h1>
    <form method="POST" action="">

        <label for="comment">Feedback:</label><br>
        <textarea name="comment" rows="5" required></textarea><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br><br>

        <input type="checkbox" id="give_percent" name="give_percent" onchange="togglePercentInput()">
        <label for="give_percent">Give a percentage rating</label><br>

        <div id="percent_input" style="display:none;">
            <label for="percent">Rating (%):</label>
            <input type="number" name="percent" min="1" max="100"><br><br>
        </div>

        <input type="submit" value="Submit">
    </form>

    <br><a href="viewFeedback.php">View Feedback</a>

</body>
</html>
