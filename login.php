<?php
include('db.php');

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];

        if ($_SESSION['role'] == 'Admin') {
            header('Location: Adminpage.php');
        } else {
            header('Location: staffpage.php');
        }

        if ($_SESSION['role'] == 'Circulation') {
            header('Location: managerpage.php');
        }
    } else {
        echo "Invalid username or password:";
        echo"Contact Admin to Register and get username";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Library Management System</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h1>Library Management System for Dambi Dollo University</h1>
    
        <form method="POST"action="">
<div class="title">
    <label>Login</label>
</div>
      <div class="form">
        <div class="input_field">
            <label>Name</label>
            <input type="text" class="input_field"name="username">
        </div>
        <div class="input_field">
            <label>Password</label>
            <input type="password" class="input_field"name="password">
        </div>
        <div class="input_field">
            <input type="submit" name="submit" value="Login">
        </div>
             
        
     </div>

      </div>
  </form>
  
</div>
</div>
</body>
</html>