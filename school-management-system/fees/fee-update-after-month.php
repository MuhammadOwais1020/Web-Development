<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "madrassa";

//For fee voucher
$month = date("m");
$year = date("Y");
$department = "";
$class = "";
$student_name = "";
$father_name = "";
$fees_id = "";
$yearly_fees = 0;
$remaining = 0;
$challan = 0;
$total = 0;
$discount = 0;
$pay = 0;
$monthly_fees = 0;
$fees_id = False;
$fee_id = 1;
$transaction_id = 0;
$gr = array();
$gr_unpaid = array();
$current_mahina = date("m");
$stored_mahina = "";
$date_ = date("y/m/d");


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    $error_message = "Connection failed: " . $conn->connect_error;
    $error = True;
} else {
    $sql = "SELECT fee_id from fees ORDER BY fee_id DESC LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $fee_id = $row['fee_id'];
        }
        $fee_id += 1;
    } else {
        $fee_id = 1;
    }
}
$conn->close();


// First retrieve the stored month
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "select month_ from current_month";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $stored_mahina = $row['month_'];
    }
} else {
    echo 'mahina retrieve nahi howa';
}
$conn->close();

if ($current_mahina != $stored_mahina) {
    //update all studetns as a unpaid 

    // Retrieve all students GR no
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Get all GR numbers
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "select GR_no from students";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $i = 0;
        while ($row = $result->fetch_assoc()) {
            $gr[$i] = $row['GR_no'];
            $i += 1;
        }
    }
    $conn->close();

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "UPDATE current_month set month_ = '$current_mahina' WHERE ID = 1";
    if ($conn->query($sql) === TRUE) {
        // echo 'mahina update ho gya';
        //insert all students gr no into fees with default unpaid value

        // Retrieve all students GR no who already payed fees of this month

        $conn->close();

        for ($i = 0; $i < count($gr); $i++) {
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = 'SELECT * FROM fees WHERE (GR_no = ' . $gr[$i] . ' and fee_month = ' . $current_mahina . ') and fee_year = ' . $year;
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                }
            } else {
                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "INSERT INTO fees(fee_id, GR_no, date_of_submit, fee_month, fee_year, monthly_fees, yearly_fees, remianing, challan, total, discount, recieved, status_, transaction_id) VALUES ('$fee_id', '$gr[$i]', '$date_', '$current_mahina', '$year', '$monthly_fees', '$yearly_fees', '$remaining', '$challan', '$total', '$discount', '$pay','unpaid','$transaction_id')";

                if ($conn->query($sql) === TRUE) {
                    // echo '<script>alert("اس مہینے کی فیس رمیم ہو چوکی ہے۔")</script>';
                    $fee_update = True;
                } else {
                    // echo 'error hy meri jan';
                }
                $fee_id += 1;
            }
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
