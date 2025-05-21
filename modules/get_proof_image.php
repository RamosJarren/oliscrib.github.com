<?php
// get_proof_image.php?file=filename.jpg

// Security: Only allow alphanumeric, dash, underscore, dot in filenames
if (!isset($_GET['file']) || !preg_match('/^[\w\-.]+\.(jpg|jpeg|png|gif)$/i', $_GET['file'])) {
    http_response_code(400);
    echo "Invalid file name.";
    exit;
}

$filename = $_GET['file'];
$filepath = __DIR__ . '/uploads/' . $filename;

if (file_exists($filepath) && is_file($filepath)) {
    $mime = mime_content_type($filepath);
    header('Content-Type: ' . $mime);
    header('Content-Length: ' . filesize($filepath));
    readfile($filepath);
    exit;
} else {
    http_response_code(404);
    echo "File not found.";
    exit;
}
?>