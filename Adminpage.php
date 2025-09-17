</html>
<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styles.csss">
    <title>Admin Page</title>
    <style>
        nav {
            background-color: lightseagreen;
            padding: 10px;
            text-align: center;
        }
        nav a {
            background-color: darkgreen;
            color: white; /* Changed from whiteblue to white */
            text-decoration: none;
            padding: 10px 15px;
            display: inline-block;
            font-size: 16px;
        }
        nav a:hover {
            background-color: #555;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        h1, h2 {
            text-align: center;
            font-size: 32px;
            font-family: initial;

        }
    </style>
</head>
<body> 
    <nav>
    	<h1>Library Management System for Dambi Dollo University</h1>
 <a href="registerUser.php"class="nounderline"> Register Users</a>
	<a href="Viewusers.php"class="nounderline">Manage users</a>
    <a href="verification.php"class="nounderline">Member verification</a>
    <a href="generate_report.php">Generate report</a>
    <a href="viewFeedBack.php">FeedBack</a>
     <?php 
      if (isset($_SESSION["username"])) {
          echo "<span style='color: blue;'>logged with: " . htmlspecialchars($_SESSION["username"]) . "</span><br>";
      } else {
          echo "<span style='color: white;'>User not logged in.</span><br>";
      }
      ?>
        
    </nav>
    <h4 align="right"><a href="logout.php">Logout</a></h4>
 <h2>Admin Page</h2>
    

</body>
</html>
