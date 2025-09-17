<?php
class NotificationDatabase {
    private $conn;

    public function __construct($host, $username, $password, $dbname) {
        $this->conn = new mysqli($host, $username, $password, $dbname);
        if ($this->conn->connect_error) die("Database connection failed: " . $this->conn->connect_error);
    }

    public function getNotifications($read_status) {
        $stmt = $this->conn->prepare("SELECT id, message FROM notificationss WHERE read_status = ?");
        $stmt->bind_param("i", $read_status);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function markAsRead($notificationIds) {
        if (!empty($notificationIds)) {
            $this->conn->query("UPDATE notificationss SET read_status = 1 WHERE id IN (" . implode(',', array_map('intval', $notificationIds)) . ")");
        }
    }

    public function closeConnection() { $this->conn->close(); }
}

$db = new NotificationDatabase('localhost', 'root', '', 'dadu_library');

$unreadNotifications = $db->getNotifications(0);
$readNotifications = $db->getNotifications(1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Notifications</title>
</head>
<body>
    <a href="studentpage.php">Back to Home</a>
    <?php
    function displayNotifications($title, $notifications) {
        echo "<h2>$title</h2>";
        echo !empty($notifications) ? "<ul><li>" . implode("</li><li>", array_column($notifications, 'message')) . "</li></ul>" : "<p>No $title notifications.</p>";
    }

    displayNotifications("Unread", $unreadNotifications);
    displayNotifications("Read", $readNotifications);

    if (!empty($unreadNotifications)) $db->markAsRead(array_column($unreadNotifications, 'id'));

    $db->closeConnection();
    ?>
</body>
</html>
