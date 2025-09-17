<?php
include('db.php');
session_start();
if (isset($_POST['delete'])) {
    $user_id = $_POST['user_id'];
    $delete_sql = "DELETE FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
}
$sql= "SELECT *FROM users";
$result=$conn->query($sql);
 ?>

 <!DOCTYPE html>
 <html>
 <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>view users</title>
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
    border: 1px solid dodgerblue;
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
 </head>
 <body>
      <a href="Adminpage.php">Go to Mainpage</a><br><br>
    <h2>Give username and Approve Users</h2>
    <table onresize="device-width">
        <tr>
            <th>User ID</th>
     		<th>fname</th>
     		<th>lname</th>
     		<th>ID num</th>
            <th>Entry Date</th>
     		<th>Department</th>
             <th>Email</th>
            <th>username</th>
            <th>role</th>
            <th>Action</th>
        

     	</tr>
<?php
        if ($result->num_rows>0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['user_id'] . "</td>
                        <td>" . $row['fname'] . "</td>
                        <td>" . $row['lname'] . "</td>
                        <td>" . $row['idnum'] . "</td>
                        <td>" . $row['entry_date'] . "</td>
                        <td>" . $row['department'] . "</td>
                        <td>" . $row['email'] . "</td>
                        <td>" . $row['username'] . "</td>
                        <td>" . $row['role'] . "</td>
                           <td>
                        <a href='update.php?id=".$row['user_id']."'>Update</a> |
                        <form action='' method='POST' style='display:inline;'>
                            <input type='hidden' name='user_id' value='".$row['user_id']."'>
                            <input type='submit' name='delete' value='Delete' onclick='return confirm(\"Are you sure?\");'>
                        </form>
                    </td>

                    </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No requests found</td></tr>";
        }
        ?>


     </table>
</body>



</html>





