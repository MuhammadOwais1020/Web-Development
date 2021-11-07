<?php
// Error variables
$data_insertion = False;
$data_access = False;
$error = False;
$error_message = "";
$m = "";
// Data variables
$gr_no = 0;
$month = "";
$year = "";
$department = "";
$class = "";
$student_name = "";
$father_name = "";
$fees_id = "";
$monthly_fees = "";
$yearly_fees = "";
$remaining = "";
$challan = "";
$total = "";
$discount = "";
$pay = "";
$fees = 0;

if (isset($_POST['fees-submit'])) {
    $gr_no = $_POST['gr-no'];
    $date_of_submit = $_POST['date-of-submit'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $department = $_POST['department'];
    $class = $_POST['class'];
    $student_name = $_POST['student-name'];
    $father_name = $_POST['father-name'];
    $fees_id = $_POST['fees-id'];
    $monthly_fees = $_POST['monthly-fees'];
    $yearly_fees = $_POST['yearly-fees'];
    $remaining = $_POST['remaining'];
    $challan = $_POST['challan'];
    $total = $_POST['total'];
    $discount = $_POST['discount'];
    $pay = $_POST['pay'];

    // echo $gr_no . $date_of_submit . $month . $year . $department . $class . $student_name . $father_name . $fees_id . $monthly_fees . $yearly_fees . $remaining . $challan . $total . $discount . $pay;

    //Database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "madrassa";

    //check fees already paid or not?
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        $error_message = "Connection failed: " . $conn->connect_error;
        echo '<div class="alert-message">';
        echo '<div class="alert alert-danger" style="text-align: center; font-size:20px;">';
        echo '<strong>معزرت</strong>! مہربانی کر کہ دوباراہ کوشیش کریں۔ شکریہ ';
        echo '<br> ' . $error_message;
        echo '</div>';
        echo '</div>';
        $error = True;
    } else {
        $sql = 'SELECT * FROM fees WHERE (GR_no = ' . $gr_no . ' and fee_month = ' . $month . ') and (fee_year = ' . $year . ' and status_ = "paid")';
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo " there is not paid before, ";
            while ($row = $result->fetch_assoc()) {
                echo "Fee ID: " . $row['fee_id'];
            }

            echo '<div class="alert-message">';
            echo '<div class="alert alert-danger" style="text-align: center; font-size:20px;">';
            echo '<strong>معزرت</strong>! آپ اس ماہ کی فیس پہلے سے ہی ادا کر چکے ہیں۔ شکریہ ';
            echo '<br> ' . $error_message;
            echo '</div>';
            echo '</div>';
        } else {
            echo "there is no record, ";
            print_r($result);
        }
        $conn->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        @font-face {
            font-family: urdu;
            src: url(JameelNooriNastaleeq.ttf);
        }

        body,
        p {
            font-family: urdu !important;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fees Wasool</title>
</head>

<body>

</body>

</html>