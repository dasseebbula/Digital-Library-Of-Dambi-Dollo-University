    <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Send Email</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 40vh;
        }

        /* Form Container */
        .form-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        /* Form Elements */
        textarea, input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            background-color: lightseagreen;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: 0.3s;
            width: 100%;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<a href="Adminpage.php">Go to Mainpage</a>
<body>
  
    <div class="form-container">
        <h2>Send Email</h2>
        <form action="https://mail.google.com/mail/u/0/?view=cm&fs=1&to=recipient@example.com&su=Verification&body=Your verification message here"  method="POST" enctype="text/plain">
            <textarea name="message" placeholder="Type verification message..." required></textarea><br>
            <input type="email" name="mailto" placeholder="Recipient's email" required><br>
            <button type="submit">Send Email</button>
        </form>
    </div>

</body>
</html>
