<?php require __DIR__ . '/includes/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>PHP2Shell Lab</title>
<link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="card">
    <h1>PHP2Shell Lab</h1>
    <p>PHP version running: <strong><?= htmlspecialchars(phpversion()) ?></strong></p>

    <?php if (!empty($_SESSION['user'])): ?>
        <p>Logged in as <strong><?= htmlspecialchars($_SESSION['user']) ?></strong></p>
        <a class="btn" href="logout.php">Log out</a>
    <?php else: ?>
        <a class="btn" href="login.php">Log in</a>
        <a class="btn secondary" href="signup.php">Sign up</a>
    <?php endif; ?>

    <hr>
    <p class="hint">Upload progress check endpoint: <code>check_progress.php</code></p>
</div>
</body>
</html>
