<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
</head>
<body>
    <h1>Register</h1>
    <?php if (isset($_GET['error'])): ?>
        <p style="color: red;">Error al registrar.</p>
    <?php endif; ?>
    <form action="index.php?action=register" method="post">
        <label>Username:</label>
        <input type="text" name="username" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <input type="submit" value="Register">
    </form>
    <a href="index.php?action=login">Login</a>
</body>
</html>
