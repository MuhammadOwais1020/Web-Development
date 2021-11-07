<?php
// error messages
$data_insertion = False;
$data_access = False;
$error = False;
$error_message = "";

// Data variables
$teacher_id = $_POST['id'];

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
    $sql = "SELECT GR_no, teacher_name, designation, monthly_salary FROM teachers WHERE GR_no = " . $teacher_id;
    $result = $conn->query($sql);

    if ($result->num_rows >= 0) {
        $data_access = True;
        while ($row = $result->fetch_assoc()) {
            $output = $row['teacher_name'] . "*";
            $output .= $row['designation'] . "*";
            $output .= $row['monthly_salary'] . "*";
            $monthly_salary = $row['monthly_salary'];
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
            $sql = "SELECT remaining_balance FROM remaining_salary WHERE GR_no = '.$teacher_id.'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $remaining_balance = $row['remaining_balance'];
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
    $sql = "SELECT fee_id from salary ORDER BY fee_id DESC LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $fee_id = (int)($row['fee_id']);
        }
        $fee_id += 1;
    } else {
        $fee_id = 1;
    }
}
$conn->close();
$output .= $fee_id . "*";
$output .= $remaining_balance . "*";
$total = floatval($remaining_balance) + floatval($monthly_salary); //total
$output .= $total . "*";

echo $output;
