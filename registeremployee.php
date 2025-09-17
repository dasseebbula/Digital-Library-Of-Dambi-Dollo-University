<?php
session_start();
session_destroy();
include('db.php');
if(isset($_POST['submit'])){
	  $fname = $_POST['fname'];
     $lname = $_POST['lname'];
     $gender = $_POST['gender'];
     $department = $_POST['department'];
     $educationallevel = $_POST['educationallevel'];
     $position = $_POST['position'];
     $reference = $_POST['reference'];
     $role = $_POST['role'];

$sql ="INSERT INTO employee (fname, lname, gender, department, educationallevel, position, reference, role) VALUES ('$fname','$lname','$gender','$department','$educationallevel','$position','$reference','$role')";
if($conn->query($sql) === TRUE) {
	echo "New Employee Registered!";
}else{
	echo "Error: " . $sql . "<br>" . $conn->error;
}
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    
	<h2 align="center">Register New Employee</h2>
    <a href="Viewemployee.php">View Employee</a>
<div class="container">
      <form method="POST" action="">
		<div class="title">
			<p align="center"> New Employee Registerion Form</p>
		</div>
        <div class="text_field">
       	    <label class="text_field">Fname:</label><br>
       	    <input type="text" name="fname"value="">
       </div>
       <div class="text_field">
           	<label class="text_field">Lname:</label><br>
       	   <input type="text" name="lname"value=" ">
       </div>
       <div class="text_field">
       	   <label class="text_field">Gender:</label><br>
       	  <input type="text" name="gender"value="">
       </div>
       <div class="text_field">
       	  <label class="text_field">Department:</label><br>
       	  <input type="text" name="department"value="">
       </div>
        <div class="text_field">
       	  <label class="text_field">Educational Level:</label><br>
       	  <input type="text" name="educationallevel"value="">
       </div>

      <div class="text_field">
       	<label class="text_field">Position:</label><br>
       	  <input type="text" name="position"value="">
       </div>
        <div class="text_field">
       	<label class="text_field">Reference:</label><br>
       	  <input type="text" name="reference"value="">
       </div>
<label for="role">Role:</label><br>
        <select name="role">
            <option value="admin">Admin</option>
            <option value="manager">manager</option>
            <option value="expert">expert</option>
            <option value="staff">Staff</option>
            <option value="Circulation">Circulation</option>
            <option value="Attendant">Attendant</option>


        </select><br><br>



          <input type="submit" name="submit"value="Register">
	</form>
	

</div>
</body>
</html>