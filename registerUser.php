<?php
session_start();
include('db.php');

if (isset($_POST['submit'])) {
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $idnum=$_POST['idnum'];
    $entry_date=$_POST['entry_date'];
    $department=$_POST['department'];
    $email=$_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $sql = "INSERT INTO users (fname, lname, idnum, entry_date, department, email, username, password, role) VALUES ('$fname','$lname','$idnum','$entry_date','$department','$email','$username', '$password', '$role')";
    if ($conn->query($sql) === TRUE) {
        echo "New user registered successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Registration</title>
    <meta name="viewport" content="width=80PX, initial-scale=1">
<link rel="stylesheet" href="styles.css">
 <style>
        /* Styling the form and overall layout */
        form {
            width: 40%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.8);
        }
        .title {
            text-align: center;
            color: lightseagreen;
            margin-bottom: 20px;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
        }
    </style>


</head>
<body>
    <h2 align="center">Register User</h2>
    <form method="POST" action="">
        <label for="fname">First Name:</label>
    <input type="text" name="fname"><br>
    <label for="lname">Last Name:</label>
    <input type="text" name="lname"><br>
    <label for="idnum">Enter ID no</label>
    <input type="text" name="idnum"><br>
    <label for="entry_date">Entry Date</label>
    <input type="Date" name="entry_date"><br>
    <label for="department">Department</label>
    <input type="text" name="department"><br>
    <label for="email">Email</label>
    <input type="text" name="email"><br>
        <label for="username">Username:</label><br>
        <input type="text" name="username" required><br><br>

        <label for="password">Password:</label><br>
        <input type="password" name="password" required><br><br>

         <label for="role">Role:</label><br>
        <select name="role">
            <option value="Admin">Admin</option>
            <option value="Circulation">Circulation</option>
            <option value="Student">Student</option>
        </select><br><br>


        <input type="submit" name="submit" value="Register">
    </form>
    <a href="Adminpage.php">Go to Mainpage</a>
</body>
</html>
