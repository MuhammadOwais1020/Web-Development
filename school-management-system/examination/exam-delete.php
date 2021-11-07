<?php

$student_id = $_POST["id"];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "madrassa";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection Failed");

$sql = "DELETE FROM examination WHERE id = {$student_id}";

if (mysqli_query($conn, $sql)) {
    echo 1;
} else {
    echo 0;
}
