<?php

$student_id = $_POST["id"];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "madrassa";

// delete from examination
$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection Failed");

$sql = "DELETE FROM examination WHERE GR_no = {$student_id}";

if (mysqli_query($conn, $sql)) {
    // delete from attendance
    $conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection Failed");

    $sql = "DELETE FROM attendance WHERE GR_no = {$student_id}";

    if (mysqli_query($conn, $sql)) {
        // delete from fees
        $conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection Failed");

        $sql = "DELETE FROM fees WHERE GR_no = {$student_id}";

        if (mysqli_query($conn, $sql)) {
            // delete from remaining
            $conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection Failed");

            $sql = "DELETE FROM remaining WHERE GR_no = {$student_id}";

            if (mysqli_query($conn, $sql)) {
                // delete from students
                $conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection Failed");

                $sql = "DELETE FROM students WHERE GR_no = {$student_id}";

                if (mysqli_query($conn, $sql)) {
                    //roll number update
                    include('roll-number-update.php');
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
    } else {
        echo 0;
    }
} else {
    echo 0;
}
