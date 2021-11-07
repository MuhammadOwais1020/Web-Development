<?php

$student_id = $_POST["id"];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "madrassa";

// delete remaining_salary
$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection Failed");

$sql = "DELETE FROM remaining_salary WHERE GR_no = {$student_id}";

if (mysqli_query($conn, $sql)) {
    // delete salary
    $conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection Failed");

    $sql = "DELETE FROM salary WHERE GR_no = {$student_id}";

    if (mysqli_query($conn, $sql)) {
        // delete teachers
        $conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection Failed");

        $sql = "DELETE FROM teachers WHERE GR_no = {$student_id}";

        if (mysqli_query($conn, $sql)) {
            echo 1;
        } else {
            echo 0;
        }
    } else {
        echo 0;
    }
} else {
    echo 0;
}
