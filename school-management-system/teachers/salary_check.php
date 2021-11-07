<?php
$remaining_salary = "nul";
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
    $sql = "SELECT remaining_balance FROM remaining_salary WHERE GR_no = '.$student_id.'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $remaining_salary = $row['remaining_balance'];
        }
    }
}
echo $remaining_salary;
