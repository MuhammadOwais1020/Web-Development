<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "madrassa";

//For fee voucher
$month = date("m");
$year = date("yy");
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

$gr = array();
$gr_unpaid = array();
$current_mahina = date("m");
$stored_mahina = "";
$date_ = date("y/m/d");

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
    $sql = "UPDATE current_month set month_ = '.$current_mahina.' WHERE ID = 1";
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

                $sql = "INSERT INTO fees(GR_no, date_of_submit, fee_month, fee_year, monthly_fees, yearly_fees, remianing, challan, total, discount, recieved, status_) VALUES ('.$gr[$i].', '.$date_.', '.$current_mahina.', '.$year.', '.$monthly_fees.', '.$yearly_fees.', '.$remaining.', '.$challan.', '.$total.', '.$discount.', '.$pay.','unpaid')";

                if ($conn->query($sql) === TRUE) {
                } else {
                    // echo 'error hy meri jan';
                }
            }
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
