<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
</head>
<body>
    <h1>Login Cita Perfecta</h1>
    <?php if (isset($_GET['error'])): ?>
        <p style="color: red;">Error de autenticación.</p>
    <?php endif; ?>
    <form action="index.php?action=login" method="post">
        <label>Username:</label>
        <input type="text" name="username" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
    <a href="index.php?action=register">Register</a>
</body>
</html>
