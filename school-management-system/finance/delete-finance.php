<?php
$transaction_id = $_POST['transaction_id'];
//Database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "madrassa";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "DELETE FROM finance WHERE id = {$transaction_id}";

if (mysqli_query($conn, $sql)) {
    echo 1;
} else {
    echo 0;
}
