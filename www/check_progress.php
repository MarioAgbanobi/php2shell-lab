<?php
// Standard PHP session.upload_progress reader. Returns whatever progress
// key PHP populated in $_SESSION during the current/last multipart upload.
// This is ordinary PHP functionality, not lab-specific exploit code.
session_start();

header('Content-Type: application/json');

$key = ini_get('session.upload_progress.prefix') . ($_GET['key'] ?? ($_POST['PHP_SESSION_UPLOAD_PROGRESS'] ?? ''));

if ($key && isset($_SESSION[$key])) {
    echo json_encode($_SESSION[$key]);
} else {
    echo json_encode(['status' => 'no active upload found']);
}
