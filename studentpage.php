<?php
session_start();
$_SESSION['user_id'] = $_SESSION['user_id'] ?? null;

class NotificationDatabase {
    private $conn;

    public function __construct($host, $username, $password, $dbname) {
        $this->conn = new mysqli($host, $username, $password, $dbname);
        if ($this->conn->connect_error) die("Database connection failed: " . $this->conn->connect_error);
    }

    public function getNotifications($read_status) {
        $result = $this->conn->query("SELECT id, message FROM notificationss WHERE read_status = $read_status");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function markAsRead($ids) {
        if (!empty($ids)) $this->conn->query("UPDATE notificationss SET read_status = 1 WHERE id IN (" . implode(',', $ids) . ")");
    }

    public function close() { $this->conn->close(); }
}

$db = new NotificationDatabase('localhost', 'root', '', 'dadu_library');

$unread = $db->getNotifications(0);
$read = $db->getNotifications(1);
$notificationCount = count($unread);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Library Management</title>
    <link rel="stylesheet" href="styles.csss">
    <style>
        nav { background: lightseagreen; padding: 10px; text-align: center; }
        nav a { background: darkgreen; color: white; text-decoration: none; padding: 10px 15px; display: inline-block; font-size: 16px; }
        nav a:hover { background: #555; }
        .notification-badge { background: red; color: white; border-radius: 50%; padding: 5px 8px; font-size: 12px; <?= ($notificationCount > 0) ? 'display:inline-block;' : 'display:none;'; ?> }
    </style>
</head>
<body>
    <nav>
        <h2>Library Circulation Service Management System for Dambi Dollo University</h2>
        <a href="books.php">Books</a>
         <a href="returnborrowedbook.php">Return Book</a>
        <a href="notifications.php" class="notification-link">Notifications<span class="notification-badge"><?= $notificationCount; ?></span></a>
              <a href="heldbooks.php">Book hold</a>
        <a href="feedback.php">FeedBack</a>
        <?= isset($_SESSION["username"]) ? "<span style='color: blue;'>Logged in as: " . htmlspecialchars($_SESSION["username"]) . "</span>" : "<span style='color: white;'>User not logged in.</span>"; ?>
        
    </nav>
     <h4 align="right"><a href="logout.php">Logout</a></h4>
      <h2>Student Page</h2>
</body>
</html>
