<?php
include('db.php');  

if (isset($_POST['update'])) {  
    $user_id = $_POST['user_id'];
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $idnum=$_POST['idnum'];
    $entry_date=$_POST['entry_date'];
    $department=$_POST['department'];
    $email=$_POST['email'];
    $username = $_POST['username'];
     $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];
  
    // Prepare and bind the update query
    $update_sql = "UPDATE users SET username=?, password=?, role=? WHERE user_id=?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("sssi", $username, $password, $role, $user_id); // Correct parameter types
    if ($stmt->execute()) {
        header("Location: viewusers.php");
        exit;  
    } else {
        echo "Error updating record: " . $stmt->error;
    }
}

if (isset($_GET['id'])) {  
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Add a safeguard in case no row is found
    if (!$row) {
        die("User not found.");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
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
    background-color: #007bff;
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
    background-color: #ff4d4d;
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
    <title>Update User</title>
</head>
<body>
    <h1>Update User</h1>

<form method="POST" action=" "> <!-- Added action -->
    <table id="table" style="width: 400px; margin: auto; overflow-x:auto; overflow-y: auto;">
          <tr>
            <td>User id:</td>
            <td><input type="number" name="user_id" value="<?php echo htmlspecialchars($row['user_id']); ?>" required readonly></td> <!-- Use htmlspecialchars for safety -->
        </tr>
        <tr>
            <td>User Name:</td>
            <td><input type="text" name="username" value="<?php echo htmlspecialchars($row['username']); ?>" required></td>
        </tr>

        <tr>
            <td>Password:</td>
            <td><input type="password" style="width: 95px;" name="password" value="<?php echo htmlspecialchars($row['password']); ?>" required></td>
        </tr>
          <tr>
            <td><label>Role:</label></td>
            <td>
                <select name="role" required>
                    <option value="Admin" <?php if ($row['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                    <option value="student" <?php if ($row['role'] == 'student') echo 'selected'; ?>>student</option>
                    <option value="Circulation" <?php if ($row['role'] == 'circulation') echo 'selected'; ?>>Circulation</option>
                
                </select>
                </td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="update" class="btn btn-success btn-large" style="width: 225px" value="Save"></td>
        </tr>
    </table>
</form>

<br>
<a href="viewusers.php">View Users</a>

</body>
</html>
