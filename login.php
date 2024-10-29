<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Load existing users
    $users = json_decode(file_get_contents('data/users.json'), true);

    // Authenticate user
    foreach ($users as $user) {
        if ($user['username'] === $username && password_verify($password, $user['password'])) {
            // Password is correct
            $_SESSION['user'] = $username;
            header('Location: index.php');
            exit();
        }
    }

    // If we reach this point, authentication failed
    $error = "Invalid username or password.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Login</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="register.php">Register</a>
        </nav>
    </header>
    <main>
        <form method="post" action="login.php">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required style="margin-bottom:10px;">
            <br/>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required style="margin-bottom:10px;">
            <br/>
            <?php if (isset($error)): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
            
            <button type="submit">Login</button>
        </form>
    </main>
</body>
</html>
