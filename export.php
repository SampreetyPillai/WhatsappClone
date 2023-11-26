<?php
// timestamp_chat.php
include_once "config.php";

// Create a new file with the name as timestamp_chat.txt
$filename = time() . "_chat.txt";

$fileContent = "This is a sample content for the timestamp_chat.txt file.";

file_put_contents($filename, $fileContent);

// Set headers to force download
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($filename) . '"');

readfile($filename);

// Optionally, you can delete the file after download
unlink($filename);
?>

