<?php
require __DIR__ . '/includes/config.php';

$message = '';
$messageType = '';
$uploadedFile = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];

    if ($file['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/uploads/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // INTENTIONALLY VULNERABLE: no extension filtering, no MIME check.
        $filename = basename($file['name']);
        $destination = $uploadDir . $filename;

        if (move_uploaded_file($file['tmp_name'], $destination)) {
            $uploadedFile = '/uploads/' . $filename;
            $message = 'File uploaded successfully: ' . htmlspecialchars($filename);
            $messageType = 'success';
        } else {
            $message = 'Upload failed. Check folder permissions.';
            $messageType = 'error';
        }
    } else {
        $message = 'No file received or upload error.';
        $messageType = 'error';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>File Upload — PHP2Shell Lab</title>
<link rel="stylesheet" href="assets/style.css">
<style>
.upload-box {
    border: 2px dashed #334155;
    border-radius: 8px;
    padding: 2rem;
    text-align: center;
    margin-bottom: 1rem;
    cursor: pointer;
    transition: border-color 0.2s;
}
.upload-box:hover { border-color: #3b82f6; }
.file-info { font-size: 0.8rem; color: #64748b; margin-top: 1rem; }
.warning { background: #451a03; border: 1px solid #92400e; border-radius: 6px; padding: 0.75rem; font-size: 0.8rem; color: #fbbf24; margin-bottom: 1rem; }
</style>
</head>
<body>
<div class="card" style="width:400px">
    <h1>File Upload</h1>

    <div class="warning">
        ⚠️ Lab target. No file validation. For local authorized testing only.
    </div>

    <?php if ($message): ?>
        <p class="<?= $messageType ?>">
            <?= $message ?>
            <?php if ($uploadedFile): ?>
                — <a href="<?= $uploadedFile ?>" target="_blank">open file</a>
            <?php endif; ?>
        </p>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="PHP_SESSION_UPLOAD_PROGRESS" value="lab_upload">
        <input type="hidden" name="MAX_FILE_SIZE" value="10485760">
        <div class="upload-box">
            <input type="file" name="file" id="file" style="display:none" onchange="this.form.submit()">
            <label for="file" style="cursor:pointer">
                Click to choose a file<br>
                <span style="font-size:0.8rem;color:#64748b">Any file type accepted</span>
            </label>
        </div>
        <button type="submit">Upload</button>
    </form>

    <div class="file-info">
        PHP version: <?= htmlspecialchars(phpversion()) ?><br>
        Upload path: <code>/uploads/</code><br>
        Session upload progress: <a href="check_progress.php" target="_blank">check_progress.php</a>
    </div>

    <p><a href="index.php">&larr; Back</a></p>
</div>
</body>
</html>