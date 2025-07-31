<!DOCTYPE html>
<html>

<head>
    <title>Password Reset Request</title>
    <link rel="icon" type="image/png" href="{{ asset('img/10-img.png') }}" class="w-6">
    <link rel="stylesheet" href="{{ asset('css/reset-password.css') }}">
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