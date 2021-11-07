<?php

//Database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "madrassa";

$classes = array("پنجم", "چہارم", "سوم", "دوم", "اول", "ابتدائیہ");
$class_section = array("د", "ج", "ب", "الف");

$classes = array_reverse($classes);
$class_section = array_reverse($class_section);
// print_r($classes);
// print_r($class_section);
$roll_no = [];

foreach ($classes as $class_name) {
    foreach ($class_section as $class_section_name) {
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            $error_message .= "Connection failed: " . $conn->connect_error;
            $error = True;
        } else {
            $sql = "SELECT GR_no from students WHERE class = '$class_name' AND class_type = '$class_section_name' ORDER BY GR_no";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    array_push($roll_no, $row['GR_no']);
                }
            } else {
            }
        }
        $conn->close();
    }
}
$i = 1;
foreach ($roll_no as $rln) {
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        $error_message .= "Connection failed: " . $conn->connect_error;
        $error = True;
    } else {
        $sql = "UPDATE roll_number SET roll_no = '.$i.' WHERE GR_no = " . $rln;
        if (mysqli_query($conn, $sql)) {
        } else {
            echo mysqli_error($conn);
            echo ' error ';
        }
    }
    $conn->close();
    $i += 1;
}
// print_r($roll_no);
