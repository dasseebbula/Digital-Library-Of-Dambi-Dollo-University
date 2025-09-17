<?php
include('db.php'); 
session_start();  


if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];    
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];    


        if ($_SESSION['role'] == 'admin') {
            header('Location: Adminpage.php'); 
        } elseif ($_SESSION['role'] == 'student') {
            header('Location: studentpage.php');
        } elseif ($_SESSION['role'] == 'circulation') {
            header('Location: circulationpage.php'); 
        } else {
            echo "<p style='color: red; text-align: center;'>Role not recognized. Please contact the administrator.</p>";
        }
        exit();
    } else {
        // Invalid credentials
        echo "<p style='color: red; text-align: center;'>Invalid username or password. Please try again or contact the admin.</p>";
    }
}
?>


<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Library Circulation Service Management System</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        /* Styling the form and overall layout */
        form {
            width: 40%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.8);
        }
        .main-header {
            display: flex;
            height: 20vh;
            border-style: solid;
        }
        .lefthead, .righthead {
            width: 10%; 
            height: 100%;
            background-color: White; 
        }
        .midhead {
            width: 80%; 
            height: 100%;
            background-color: lightseagreen;
            font-size: 25px; 
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .main-login {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 40vh;
            margin-top: 60px;
        }
        .content{
           width: 100%; 
            height: 5%;
            font-size: 14px; 
            text-align: center; 
        }
        #btn-logn {
            background-color: lightseagreen;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            color: white;
        }
        #btn-logn:hover {
            background-color: darkcyan;
        }
        .title {
            text-align: center;
            color: lightseagreen;
            margin-bottom: 20px;
        }
        input[type="text"], input[type="password"] {
            width: 300px;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        h2{
            font-size: 28;
            font-family: sans-serif;

        }
    </style>
</head>
<body>
    <div class="main-header">
        <div class="lefthead">
            <img src="Logo.jpg" width="100" height="100" alt="University Logo">
        </div>
        <div class="midhead">
            <h2 style="color:black; font-family:cursive;">Library Circulation Service Management System for Dambi Dollo University</h2>
        </div>
        <div class="righthead">
            <img src="Logo.jpg" width="100" height="100" alt="University Logo">
        </div>
    </div>
    <div class="content">

        <a href="aboutus.php"style="text-decoration: none; color: black;">About Us</a>
    <a href="feedback.php"style="text-decoration: none; color: black;">contact</a>
    <a href="search1.php" style="text-decoration: none; color: black;">Search Books</a>
</div>
    <div class="main-login">
        <form method="POST" action="">
            <div class="title">
                <label><b>Login</b></label>
            </div>
            <div class="form">
                <div class="input_field">
                    <label>Username</label>
                    <input type="text" class="input_field" name="username" placeholder="Enter your username" required>
                </div>
                <div class="input_field">
                    <label>Password</label>
                    <input type="password" class="input_field" name="password" placeholder="Enter your password" required>
                </div>
                <div>
                    <input id="btn-logn" type="submit" name="submit" value="Login">
                </div>
            </div>
        </form>
    </div>
</body>
</html>
