<?php
session_start();
// timestamp_chat.php
include_once "config.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
// Create a new file with the name as timestamp_chat.txt
$outgoing_id = $_SESSION['unique_id'];
$incoming_id = $_POST['incoming_id'];
$output = "";
$sql = "SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id}) OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
// $sql = "SELECT * FROM messages ";
$query = mysqli_query($conn, $sql);
$filename = time() . "_chat.txt";

$fileContent = "Chat receipts:\n";
while ($row = mysqli_fetch_assoc($query)) {
    // Modify this part based on the structure of your data
    $fileContent .= "Sender: " . $row['fname'] . " " . $row['lname'] . "\n";
    $fileContent .= "Message: " . $row['msg'] . "\n";
    $fileContent .= "Timestamp: " . $row['timestamp'] . "\n";
    $fileContent .= "-----------------\n";
}

file_put_contents($filename, $fileContent);

// Set headers to force download
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($filename) . '"');

readfile($filename);

// Optionally, you can delete the file after download
unlink($filename);
}
?>

