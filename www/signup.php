<?php
require __DIR__ . '/includes/config.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = 'Username and password are required.';
    } else {
        $stmt = $pdo->prepare('SELECT id FROM users WHERE username = ?');
        $stmt->execute([$username]);

        if ($stmt->fetch()) {
            $error = 'That username is already taken.';
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare('INSERT INTO users (username, password_hash) VALUES (?, ?)');
            $stmt->execute([$username, $hash]);
            $success = 'Account created. You can log in now.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Sign Up — PHP2Shell Lab</title>
<link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="card">
    <h1>Sign Up</h1>

    <?php if ($error): ?><p class="error"><?= htmlspecialchars($error) ?></p><?php endif; ?>
    <?php if ($success): ?><p class="success"><?= htmlspecialchars($success) ?> <a href="login.php">Log in</a></p><?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="MAX_FILE_SIZE" value="1048576">
        <label>Username
            <input type="text" name="username" required>
        </label>
        <label>Password
            <input type="password" name="password" required>
        </label>
        <button type="submit">Create account</button>
    </form>

    <p><a href="index.php">&larr; Back</a></p>
</div>
</body>
<<<<<<< HEAD
</html>
=======
</html>
>>>>>>> 4eba12f06d2593944d09803e1b325a5f57e3be13
