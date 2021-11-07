<?php
// error messages
$data_insertion = False;
$data_access = False;
$error = False;
$error_message = "";

// Data variables
$student_id = $_POST['id'];
$gr_no = "";
$student_name = "";
$father_name = "";
$class = "";
$department = "";
$monthly_fees = "";
$fee_id = 0;
$remaining_balance = "";
$total = 0;
$output = "";
$monthly_discount = 0;
$discount = 0;
//Database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "madrassa";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    $error_message = "Connection failed: " . $conn->connect_error;
    $error = True;
} else {
    $sql = "SELECT GR_no, student_name, father_name, class, department, monthly_fees, discount, class_type FROM students WHERE GR_no = " . $student_id;
    $result = $conn->query($sql);

    if ($result->num_rows >= 0) {
        $data_access = True;
        while ($row = $result->fetch_assoc()) {
            $output = $row['student_name'] . "*";
            $output .= $row['father_name'] . "*";
            $output .= $row['class'] . " - " . $row['class_type'] . " *";
            $output .= $row['department'] . "*";
            $output .= $row['monthly_fees'] . "*";
            $output .= $row['discount'] . "*";
            $discount = $row['discount'];
            $monthly_fees = $row['monthly_fees'];
        }

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
    } else {
        $error_message .= $conn->error;
        $error_message .= "else k ander ";
    }
}
$conn->close();

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    $error_message .= "Connection failed: " . $conn->connect_error;
    $error = True;
} else {
    $sql = "SELECT fee_id from fees ORDER BY fee_id DESC LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $fee_id = (int)($row['fee_id']);
        }
        $fee_id += 1;
    } else {
        $fee_id = 0;
    }
}
$conn->close();

$output .= $fee_id . "*";
$output .= $remaining_balance . "*";
$total = floatval($remaining_balance) + (floatval($monthly_fees) - floatval($discount)); //total
$output .= $total . "*";

echo $output;
