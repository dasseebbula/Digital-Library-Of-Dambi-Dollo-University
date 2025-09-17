<?php
session_start();
include('db.php');

if ($_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

if (isset($_POST['status'])) {
    $status = $_POST['status'];

    $sql = "SELECT * FROM books WHERE status='$status'";
    $result = $conn->query($sql);

    echo "<h1>Books - $status</h1>";
    echo "<table><tr><th>Book ID </th><th>Title</th><th>Author</th><th>ISBN</th><th>Edition</th><th>Department</th></tr>";

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['book_id']}</td><td>{$row['title']}</td><td>{$row['author']}</td><td>{$row['isbn']}</td><td>{$row['edition']}</td><td>{$row['department']}</td></tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No requests found.</td></tr>";
    }

    echo "</table>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Generate Report</title>
    <style>
        /* General body styling */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f9f9f9;
    color: #333;
}

/* Heading styling */
h2 {
    text-align: center;
    margin-top: 20px;
    color: #555;
}

/* Table styling */
table {
    border-collapse: collapse;
    width: 80%;
    margin: 20px auto;
    background-color: white;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
}

th, td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center;
}

th {
    background-color: lightseagreen;
    color: white;
    font-weight: bold;
    text-transform: uppercase;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #e9e9e9;
}

/* Action links */
a {
    color: #007bff;
    text-decoration: none;
    font-weight: bold;
}

a:hover {
    text-decoration: underline;
}

form {
    display: inline-block;
}

input[type="submit"] {
    background-color: seagreen;
    border: none;
    color: white;
    padding: 5px 10px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
}

input[type="submit"]:hover {
    background-color: #d63333;
}

/* Responsive design */
@media screen and (max-width: 768px) {
    table {
        width: 95%;
    }

    th, td {
        padding: 8px;
        font-size: 14px;
    }
}

    </style>

</head>
<body>
    <a href="Adminpage.php">Go to Mainpage</a>
    <h1>Generate Report</h1>
    <form method="POST" action="">
        <label for="status">Select Status:</label>
        <select name="status">
            <option value="available">Available</option>
            <option value="borrowed">Borrowed</option>
        </select>
        <input type="submit" value="Generate Report">
    </form>
</body>
</html>
