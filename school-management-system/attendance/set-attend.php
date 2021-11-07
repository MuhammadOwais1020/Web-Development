<?php
$data = json_decode(stripslashes($_POST['count']));
$output = "";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "madrassa";
$date_ = "";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    $error_message = "Connection failed: " . $conn->connect_error;
    $error = True;
} else {
    $gr = $_POST['gr'];
    $date_of_attend = 0;
    $date_ = $_POST['date_'];
    $sqlz = "select date_ from attendance where GR_no = '" . $gr . "' and date_ = '" . $date_ . "'";
    $result = $conn->query($sqlz);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $date_of_attend = 1;
        }
    } else {
        $error_message = "Error: " . $conn->error;
        $error = True;
    }

    $sqlz = $_POST['query'];
    $result = $conn->query($sqlz);
    if ($result->num_rows > 0) {
        $i = 0;
        if ($date_of_attend == 0) {
            while ($row = $result->fetch_assoc()) {
                $dataa = $data[$i];
                $gr = $row['GR_no'];
                $conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection Failed");
                $sql = "INSERT INTO attendance (GR_no, date_, attendance) VALUES ('{$gr}','{$date_}','{$dataa}')";
                $i++;
                if ($conn->query($sql)) {
                } else {
                }
            }
            $output = 'Success';
        } else {
            $error_message = "Error: " . $conn->error;
            $error = True;
            $output = 'Already';
        }
    }
}

echo $output;
