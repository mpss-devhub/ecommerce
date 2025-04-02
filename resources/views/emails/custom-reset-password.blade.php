<!DOCTYPE html>
<html>
<head>
    <title>Password Reset Request</title>
    <link rel="icon" type="image/png" href="{{ asset('img/10-img.png') }}" class="w-6">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            text-align: center;
        }
        .email-container {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);

        }
        .email-container a{
            text-decoration: none;
        }
        .email-container img {
            width: 100px;
            margin-bottom: 15px;
            text-align: center;
        }
        .email-container h2 {
            color: #333;
            margin-bottom: 10px;
            text-align: left;
        }
        .email-container p {
            font-size: 16px;
            color: #555;
            line-height: 1.6;
            text-align: left
        }
        .reset-button {
            display: inline-block;
            padding: 12px 20px;
            background: #2779bd;
            color: black;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 15px;
            transition: background 0.3s ease-in-out;
            text-align: center
        }
        .reset-button:hover {
            background: #2779bd;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h2>Hello,</h2>
        <p>You are receiving this email because we received a password reset request for your account.</p>
        <p>Click the button below to reset your password:</p>

        <a style="color: white;" href="{{ url('/reset-password/' . $token . '?email=' . urlencode($email)) }}" class="reset-button">
            Reset Password
        </a>

        <p>If you did not request a password reset, no further action is required.</p>
        <p class="footer">Thank you.</p>
    </div>
</body>
</html>
