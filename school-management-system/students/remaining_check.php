<?php
$remaining_balance = 0;
$student_id = $_POST['id'];
// remaining account balence 
//Database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "madrassa";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    $error_message .= "Connection failed: " . $conn->connect_error;
    $error = True;
} else {
    $sql = "SELECT remaning_balance FROM remaining WHERE GR_no = '.$student_id.'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $remaining_balance = $row['remaning_balance'];
        }
    }
}
echo $remaining_balance;
