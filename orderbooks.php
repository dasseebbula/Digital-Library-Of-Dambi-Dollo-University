
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order a Book</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
        }
        label, input, select, button {
            display: block;
            margin-bottom: 15px;
        }
        .form-container{
            border: rebeccapurple;
        }
    </style>
</head>
<body>
    <form action="process_order.php" method="post">
        <div class="form-container">
        <label for="user-id">User ID:</label>
        <input type="text" id="user-id" name="user_id" required>

        <label for="department">Department:</label>
        <input type="text" id="department" name="department" required>

        <label for="book-title">Book Title:</label>
        <input type="text" id="book-title" name="book_title" required>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" required>

        <button type="submit">Place Order</button>
    </div>
    </form>
</body>
</html>
