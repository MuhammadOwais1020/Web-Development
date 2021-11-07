<?php

$fee_id = $_POST['id'];
$transaction_id = $_POST['transaction_id'];

$remaining = 0;
$total = 0;
$recieved = 0;
$bqaya = 0;
$gr = 0;
//Database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "madrassa";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    $error_message = "Connection failed: " . $conn->connect_error;
    echo $error_message;
} else {
    $sql = "SELECT total, recieved, previous_remaining, GR_no from salary WHERE fee_id = {$fee_id}";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $remaining = $row['previous_remaining'];
            $total = $row['total'];
            $recieved = $row['recieved'];
            $gr = $row['GR_no'];
        }
        $bqaya = (float)$total - (float)$recieved;

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            $error_message = "Connection failed: " . $conn->connect_error;
            echo $error_message;
        } else {
            $sql = "UPDATE remaining_salary SET remaining_balance = (remaining_balance - {$bqaya}) + {$remaining} WHERE GR_no = {$gr}";
            if ($conn->query($sql) === TRUE) {
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "DELETE FROM salary WHERE fee_id = {$fee_id}";

                if (mysqli_query($conn, $sql)) {
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "DELETE FROM finance WHERE id = {$transaction_id}";

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
        }
    } else {
        echo 0;
    }
}
