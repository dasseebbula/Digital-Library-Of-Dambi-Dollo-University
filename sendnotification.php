<?php
class NotificationDatabase {
    private $conn;

    public function __construct($host, $username, $password, $dbname) {
        $this->conn = new mysqli($host, $username, $password, $dbname);
        if ($this->conn->connect_error) die("Database connection failed: " . $this->conn->connect_error);
    }

    public function sendNotification($message) {
        $stmt = $this->conn->prepare("INSERT INTO notificationss (message, read_status) VALUES (?, 0)");
        $stmt->bind_param("s", $message);
        return $stmt->execute();
    }

    public function closeConnection() { $this->conn->close(); }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = $_POST['message'] ?? '';

    if (!empty($message)) {
        $db = new NotificationDatabase('localhost', 'root', '', 'dadu_library');
        if ($db->sendNotification($message)) {
            echo "Notification sent successfully!";
        } else {
            echo "Error sending notification.";
        }
        $db->closeConnection();
    } else {
        echo "Please enter a notification message.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Send Notification</title>
</head>
<body>
    <a href="circulationpage.php">Back to Home</a>
    <h2>Send Notification</h2>
    <form method="POST">
        <textarea name="message" placeholder="Enter your notification..." required></textarea><br>
        <button type="submit">Send Notification</button>
    </form>
</body>
</html>
