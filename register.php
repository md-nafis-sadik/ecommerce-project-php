<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirm_password']);

    if ($password === $confirmPassword) {
        // Load existing users
        $users = json_decode(file_get_contents('data/users.json'), true);

        // Check if the username already exists
        foreach ($users as $user) {
            if ($user['username'] === $username) {
                $error = "Username already taken.";
                break;
            }
        }

        if (!isset($error)) {
            // Add new user
            $newUser = [
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ];
            $users[] = $newUser;

            // Save users back to JSON
            file_put_contents('data/users.json', json_encode($users, JSON_PRETTY_PRINT));

            // Redirect to login page after successful registration
            header('Location: login.php');
            exit();
        }
    } else {
        $error = "Passwords do not match.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Register</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="login.php">Login</a>
        </nav>
    </header>
    <main>
        <form method="post" action="register.php">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required  style="margin-bottom:10px;">
            <br/>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required style="margin-bottom:10px;">
            <br/>
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            <br/>
            <?php if (isset($error)): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
            <br/>
            <button type="submit">Register</button>
        </form>
    </main>
</body>
</html>
