<?php
require __DIR__ . '/includes/config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user'] = $user['username'];
        header('Location: index.php');
        exit;
    } else {
        $error = 'Invalid username or password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Log In — PHP2Shell Lab</title>
<link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="card">
    <h1>Log In</h1>

    <?php if ($error): ?><p class="error"><?= htmlspecialchars($error) ?></p><?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="MAX_FILE_SIZE" value="1048576">
        <label>Username
            <input type="text" name="username" required>
        </label>
        <label>Password
            <input type="password" name="password" required>
        </label>
        <button type="submit">Log in</button>
    </form>

    <p><a href="index.php">&larr; Back</a></p>
</div>
</body>
<<<<<<< HEAD
</html>
=======
</html>
>>>>>>> 4eba12f06d2593944d09803e1b325a5f57e3be13
