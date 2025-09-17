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
        }
    </style>
</head>
<body> 
    <nav>
    	<h3>Library Circulation Service Management System for Dambi Dollo University</h3>
        <a href="add_book.php">Add Book</a>
        <a href="cBooks.php">Books</a>
        <a href="checkout2.php">Book Checkout</a>
        <a href="borrowed_books.php">Borrowed Books</a>
        <a href="registermembers.php">Register Members</a>
        <a href="notify_borrowers.php">Send notifications</a>

         <?php 
      if (isset($_SESSION["username"])) {
          echo "<span style='color: blue;'>logged with: " . htmlspecialchars($_SESSION["username"]) . "</span><br>";
      } else {
          echo "<span style='color: white;'>User not logged in.</span><br>";
      }
      ?>
    </nav>
     <h4 align="right"><a href="logout.php">Logout</a></h4>
 <h2>Circulation Page</h2>
    

</body>
</html>
