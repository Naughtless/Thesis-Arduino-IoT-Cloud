<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    <link rel="stylesheet" href="../resources/css/dashboard.css" type="text/css">
    <link rel="stylesheet" href="../resources/css/login.css" type="text/css">
</head>
<body>
<div class="login-container">
    <h1>Login</h1>
    <form action="index.php" method="POST">
        <input type="hidden" name="action" value="attemptLogin">
        <input class="login-input" type="password" name="password" placeholder="Enter your password" required>
        <button class="login-button" type="submit">Login</button>
    </form>
</div>
</body>
</html>