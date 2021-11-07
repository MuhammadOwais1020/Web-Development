<?php
//Database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "madrassa";
$month = date("m");
$date_from = $_POST['date-from'];
$date_to = $_POST['date-to'];

$output = "";

$conn = mysqli_connect("localhost", "root", "", "madrassa") or die("Connection Failed");
// SELECT SUM(DR) as DR, SUM(CR) as CR from finance WHERE datetime_ BETWEEN '2020-12-02' AND '2021-02-20'
$sql = "SELECT SUM(DR) as DR, SUM(CR) as CR from finance WHERE datetime_ BETWEEN '$date_from' AND '$date_to'";
$result = mysqli_query($conn, $sql) or die("SQL Query Failed.");

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['DR'] != "") {
            $output .= $row['DR'] . "*";
        } else {
            $output .= "0*";
        }
        if ($row['CR'] != "") {
            $output .= $row['CR'] . "*";
        } else {
            $output .= "0*";
        }
    }
}
echo $output;
