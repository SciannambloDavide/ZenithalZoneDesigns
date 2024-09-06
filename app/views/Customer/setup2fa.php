<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2FA Setup</title>
    <style>
        body {
            font-family: 'Barlow', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            max-width: 400px;
            background-color: #fff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }
        img {
            display: block;
            margin: 0 auto 20px;
            border-radius: 8px;
        }
        form {
            text-align: center;
        }
        label {
            font-size: 16px;
            display: block;
            margin-bottom: 10px;
            color: #555;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Setup Two-Factor Authentication</h1>
        <img height="300" width="300" src="<?= $QRCode ?>" alt="QR Code">
        <p>Scan the QR code with your mobile Authenticator app, such as Google Authenticator. The app will generate codes that are valid for 30 seconds.</p>
        <form method="post" action="">
            <label for="totp">Current Code:</label>
            <input type="text" id="totp" name="totp" placeholder="Enter code" required>
            <input type="submit" name="action" value="Verify Code">
        </form>
    </div>
</body>
</html>
