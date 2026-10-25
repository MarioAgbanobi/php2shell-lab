<?php
<<<<<<< HEAD
=======
// Lab-only config. No real secrets. SQLite keeps the stack to one container.
>>>>>>> 4eba12f06d2593944d09803e1b325a5f57e3be13
session_start();

$dbPath = __DIR__ . '/../data/users.db';

try {
    $pdo = new PDO('sqlite:' . $dbPath);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec('CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT UNIQUE NOT NULL,
        password_hash TEXT NOT NULL,
        created_at TEXT DEFAULT CURRENT_TIMESTAMP
    )');
} catch (PDOException $e) {
    die('DB error: ' . $e->getMessage());
<<<<<<< HEAD
}
=======
}
>>>>>>> 4eba12f06d2593944d09803e1b325a5f57e3be13
