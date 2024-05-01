<!-- resources/views/emails/stock_alert.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Alert</title>
    <style>
        /* CSS styles for the email */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            max-width: 150px;
        }

        .content {
            padding: 20px;
            border-top: 1px solid #ddd;
        }

        .footer {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            text-align: center;
            color: #888;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="logo">
        <img src="https://via.placeholder.com/150" alt="Placeholder Logo">
    </div>
    <div class="content">
        <h2>Stock Alert</h2>
        <p>Dear Admin,</p>
        <p>Stock for item <strong>{{ $itemName }}</strong> has fallen below the low stock margin.</p>
    </div>
    <div class="footer">
        <p>This is an automated email. Please do not reply to this email.</p>
    </div>
</div>
</body>
</html>
