<?php
$output = 0;
$date_time = $_POST['tarikh_'];
$type = $_POST['kisam_'];
$details = $_POST['tafseel_'];
$amount = (float)$_POST['raqam_'];
$dr_cr = $_POST['dr_cr_'];
$gr_number = $_POST['gr_number_'];
$maad = $_POST['maad_'];
$sadaqa_kisam = $_POST['sadaqa_kisam_'];

$remaining_balance = 0;
$remaining_salary = 0;

$dr = 0;
$cr = 0;

if ($dr_cr == "dr") {
    $dr = $amount;
}
if ($dr_cr == "cr") {
    $cr = $amount;
}

//Database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "madrassa";
// finance update
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    $error_message = "Connection failed: " . $conn->connect_error;
    $error = True;
} else {
    $sql = "INSERT INTO finance(datetime_,type,details,DR,CR,maad,sadaqa) VALUES ('$date_time','$type','$details','$dr','$cr','$maad','$sadaqa_kisam')";
    if ($conn->query($sql) === TRUE) {
        $output = 1;
    } else {
        $m .= " data insert nahi howa, ";
        $error_message = "Error: " . $conn->error;
        $error = True;
    }
}

// remaining balance fees update
if ($type == "F") {
    // remaining fees balance update
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        $error_message = "Connection failed: " . $conn->connect_error;
        $error = True;
    } else {
        $sql = "UPDATE remaining SET remaning_balance = (remaning_balance - '$amount') WHERE GR_no = '$gr_number'";
        if ($conn->query($sql) === TRUE) {
            $output = 1;
        } else {
            $m .= " data insert nahi howa, ";
            $error_message = "Error: " . $conn->error;
            $error = True;
        }
    }
}

// remaining salary update
if ($type == "S") {
    // remaining salary balance update
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        $error_message = "Connection failed: " . $conn->connect_error;
        $error = True;
    } else {
        $sql = "UPDATE remaining_salary SET remaining_balance = (remaining_balance - '$amount') WHERE GR_no = '$gr_number'";
        if ($conn->query($sql) === TRUE) {
            $output = 1;
        } else {
            $m .= " data insert nahi howa, ";
            $error_message = "Error: " . $conn->error;
            $error = True;
        }
    }
}

$conn->close();
echo $output;
