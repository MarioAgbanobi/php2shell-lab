<?php
<<<<<<< HEAD
session_start();
=======
// Standard PHP session.upload_progress reader. Returns whatever progress
// key PHP populated in $_SESSION during the current/last multipart upload.
// This is ordinary PHP functionality, not lab-specific exploit code.
session_start();

>>>>>>> 4eba12f06d2593944d09803e1b325a5f57e3be13
header('Content-Type: application/json');

$key = ini_get('session.upload_progress.prefix') . ($_GET['key'] ?? ($_POST['PHP_SESSION_UPLOAD_PROGRESS'] ?? ''));

if ($key && isset($_SESSION[$key])) {
    echo json_encode($_SESSION[$key]);
} else {
    echo json_encode(['status' => 'no active upload found']);
}
