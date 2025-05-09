<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'connection.php';
session_start();

$outgoing_id = $_SESSION['user_id'];
$output = "";

// Fixed SQL syntax and logic
$sql = "SELECT * FROM `users` WHERE user_id != '{$outgoing_id}' ORDER BY user_id DESC";
$run = mysqli_query($conn, $sql);

if (mysqli_num_rows($run) == 0) {
    $output .= "No user available to chat";
} elseif (mysqli_num_rows($run) > 0) {
    include 'user_data.php'; // this script builds $output
}

echo $output;
?>