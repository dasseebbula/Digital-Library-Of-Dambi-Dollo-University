<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $isbn = $_POST['isbn'];
    $edition = $_POST['edition'];
    $publisher = $_POST['publisher'];
    $department = $_POST['department'];

    if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] == 0) {
        $cover_image = $_FILES['cover_image']['name'];
        $image_tmp = $_FILES['cover_image']['tmp_name'];
        $image_dir = 'book_cover/' . $cover_image;

        if (move_uploaded_file($image_tmp, $image_dir)) {

            $sql = "INSERT INTO books (title, author, isbn, edition, publisher, department, cover_image) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssss", $title, $author, $isbn, $edition, $publisher, $department, $cover_image);
            
            if ($stmt->execute()) {
                echo "New book uploaded successfully!";
                header('Location: books.php');
                exit();
            } else {
                echo "Error uploading book details.";
            }
            
            $stmt->close();
        } else {
            echo "Error uploading image.";
        }
    } else {
        echo "Please upload a valid image.";
    }
}
?>


<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>add books</title>
</head>
<body>
       <a href="circulationpage.php">Back to Home</a>
<link rel="stylesheet" type="text/css" href="styles.css">
<title>Register books</title>
<h2>Register books</h2>
<form action=""method="POST"enctype="multipart/form-data">
    Title: <input type="text" name="title" required><br>
    Author: <input type="text" name="author" required><br>
    ISBN: <input type="text" name="isbn" required><br>
    Edition<input type="text"name="edition"><br>
    Publisher:<input type="text" name="publisher" required><br>
    Department:<input type="text" name="department" required><br>

    <label for="cover_image"> Image:</label>
    <input type="file" id="cover_image" name="cover_image" accept="image/*" ><br><br>
    <button type="submit">Add Book</button>
</form>
</body>
</html>
