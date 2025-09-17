<?php
include 'db.php';
session_start();

$book_id = $_GET['book_id'];
$return_date = date('Y-m-d');

// Fetch borrow date for the book
$sql = "SELECT borrow_date FROM borrows WHERE book_id = ? AND return_date IS NULL";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $book_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row) {
    $borrow_date = $row['borrow_date']; 
    $penalty = 0;

    // Calculate expected return date (assuming a fixed borrowing period, e.g., 5 days)
    $expected_return_date = date('Y-m-d', strtotime($borrow_date . ' + 5 days'));

    // Check if the return date is past the expected return date
    if ($return_date > $expected_return_date) {
        // Calculate overdue days
        $overdue_days = (strtotime($return_date) - strtotime($expected_return_date)) / (60 * 60 * 24);
        $fine_per_day = 5; 
        $penalty = $overdue_days * $fine_per_day;

        // Notification for overdue returns
        if ($overdue_days > 5) {
            echo "<div class='notification'>
                    <h3>Important Notification: Late Return</h3>
                    <p>Your book is overdue by " . intval($overdue_days) . " days. A penalty of ETB " . number_format($penalty, 2) . " has been applied.</p>
                    <p>Please return the book as soon as possible to avoid further penalties.</p>
                  </div>";
        }
    }

    // Update return date and penalty in the database
    $sql = "UPDATE borrows SET return_date = ?, penalty = ? WHERE book_id = ? AND return_date IS NULL";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdi", $return_date, $penalty, $book_id);
    $stmt->execute();

    if ($penalty > 0) {
        // Show payment notification 
        echo "<div class='notification'>
                <h3>Notification: Penalty Applied</h3>
                <p>Your penalty for late return is ETB " . number_format($penalty, 2) . ". Please proceed with payment to complete the return process.</p>
              </div>";
        echo "<form action='process_payment.php' method='POST'>
                <label for='paymentmethod'>Choose payment Method:</label>
                <select name='paymentbank'>
                <option value='CBE'>CBE</option>
                <option value='OIB'>OIB</option>
                <option value='Awash'>Awash</option>
                <option value='Gadaa'>Gadaa</option>
                </select><br>

                <label for='name'>Enter your name:</label>
                <input type='text' name='name' required><br>
                
                <label for='account'>Enter your account number:</label>
                <input type='text' name='account' required><br>
                
                <label for='amount'>Enter the penalty amount:</label>
                <input type='text' name='amount' value='" . htmlspecialchars($penalty) . "' readonly><br>
                
                <input type='hidden' name='penalty' value='" . htmlspecialchars($penalty) . "'><br>
                <input type='hidden' name='book_id' value='" . htmlspecialchars($book_id) . "'>
                
                <button type='submit' class='pay-button'>Pay Now</button>
              </form>";
    } else {
        // Update the book status to 'available' if no penalty
        $sql = "UPDATE books SET status = 'available' WHERE book_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $book_id);
        $stmt->execute();

        header('Location: returnborrowedbook.php?msg=Return Successful');
        exit();
    }
} else {
    echo "<div class='notification'>
            <h3>Error: No active borrow record found.</h3>
          </div>";
}

$stmt->close();
$conn->close();
?>

<style>
.notification {
    border: 1px solid #f44336;
    background-color: #ffe6e6;
    padding: 15px;
    margin: 10px 0;
    font-family: Arial, sans-serif;
    color: #f44336;
    border-radius: 5px;
}

.notification h3 {
    margin: 0 0 10px;
}

.pay-button {
   /* background-color: #4CAF50;*/
   background-color: red;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

.pay-button:hover {
    background-color: #45a049;
}
</style>