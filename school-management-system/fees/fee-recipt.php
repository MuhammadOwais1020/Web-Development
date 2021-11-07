<?php
//Database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "madrassa";

// Error variables
$data_insertion = False;
$data_access = False;
$error = False;
$update_remaining_balence = False;
$error_message = "";
$m = "";
// Data variables
$gr_no = 0;
$month = "";
$year = "";
$department = "";
$class = "";
$class_type = "";
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
$remaining_balance = 0;
$date_of_submit = "";
$mezan = 0;
$transaction_id = 0;

$date_time = date("Y/m/d h:i:sa");
$type = "FF";
$details = "فیس کی وصولی";
$dr = 0;
$cr = 0;


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
        $m .= " first else, ";
        $sql = 'SELECT * FROM fees WHERE (GR_no = ' . $gr_no . ' and fee_month = ' . $month . ') and (fee_year = ' . $year . ' and status_ = "paid")';
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $m .= " there is already paid before, ";
            while ($row = $result->fetch_assoc()) {
            }

            echo '<div class="alert-message">';
            echo '<div class="alert alert-danger" style="text-align: center; font-size:20px;">';
            echo '<strong>غلطی</strong>! آپ اس ماہ کی فیس پہلے سے ہی ادا کر چکے ہیں۔ شکریہ ';
            echo '<br> ' . $error_message;
            echo '</div>';
            echo '</div>';
        } else {

            $m .= " second else, ";
            //check fees already unpaid or not?
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
                $m .= " third else, ";
                $sql = 'SELECT * FROM fees WHERE (GR_no = ' . $gr_no . ' and fee_month = ' . $month . ') and (fee_year = ' . $year . ' and status_ = "unpaid")';
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $m .= " there is data with unpaid, ";
                    while ($row = $result->fetch_assoc()) {
                        $fees = $row['fee_id'];
                    }
                    //update fees
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    if ($conn->connect_error) {
                        $error_message = "Connection failed: " . $conn->connect_error;
                        $error = True;
                    } else {
                        $m .= " fourth else, ";
                        $sql = "UPDATE fees SET GR_no = '$gr_no', date_of_submit = '$date_of_submit', fee_month = '$month', fee_year = '$year', monthly_fees = '$monthly_fees', yearly_fees = '$yearly_fees', remianing = '$remaining', challan = '$challan', total = '$total', discount = '$discount', recieved = '$discount', recieved = '$pay', status_ = 'paid' WHERE fee_id = " . $fees;

                        if ($conn->query($sql) === TRUE) {
                            $m .= " update data succsess fully, ";

                            // finance update
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            if ($conn->connect_error) {
                                $error_message = "Connection failed: " . $conn->connect_error;
                                $error = True;
                            } else {
                                $dr = $pay;
                                $sql = "INSERT INTO finance(datetime_,type,details,DR,CR) VALUES ('$date_time','$type','$details','$dr','$cr')";
                                if ($conn->query($sql) === TRUE) {

                                    //check fees already unpaid or not?
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
                                        $sql = 'SELECT id from finance ORDER by id DESC LIMIT 1';
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $transaction_id = $row['id'];
                                            }

                                            //update transaction id
                                            $conn = new mysqli($servername, $username, $password, $dbname);
                                            if ($conn->connect_error) {
                                                $error_message = "Connection failed: " . $conn->connect_error;
                                                $error = True;
                                            } else {
                                                $m .= " fourth else, ";
                                                $sql = "UPDATE fees SET transaction_id = '$transaction_id' WHERE fee_id = " . $fees;

                                                if ($conn->query($sql) === TRUE) {
                                                    $data_insertion = True;
                                                }
                                            }
                                        }
                                    }
                                } else {
                                    $m .= " data insert nahi howa, ";
                                    $error_message = "Error: " . $conn->error;
                                    $error = True;
                                }
                            }
                        } else {
                            $m .= "update nahi howa, ";
                            $error_message = "Error: " . $conn->error;
                            $error = True;
                        }
                    }
                } else {
                    $m .= " fifth else, ";
                    //pay fees
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    if ($conn->connect_error) {
                        $error_message = "Connection failed: " . $conn->connect_error;
                        $error = True;
                    } else {
                        $m .= " sixth else, ";
                        $sql = "INSERT INTO fees(fee_id, GR_no, date_of_submit, fee_month, fee_year, monthly_fees, yearly_fees, remianing, challan, total, discount, recieved, status_) VALUES ('$fees_id', '$gr_no', '$date_of_submit', '$month', '$year', '$monthly_fees', '$yearly_fees', '$remaining', '$challan', '$total', '$discount', '$pay','paid')";

                        if ($conn->query($sql) === TRUE) {

                            // finance update
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            if ($conn->connect_error) {
                                $error_message = "Connection failed: " . $conn->connect_error;
                                $error = True;
                            } else {
                                $dr = $pay;
                                $sql = "INSERT INTO finance(datetime_,type,details,DR,CR) VALUES ('$date_time','$type','$details','$dr','$cr')";
                                if ($conn->query($sql) === TRUE) {

                                    //check fees already unpaid or not?
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
                                        $sql = 'SELECT id from finance ORDER by id DESC LIMIT 1';
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $transaction_id = $row['id'];
                                            }

                                            //update transaction id
                                            $conn = new mysqli($servername, $username, $password, $dbname);
                                            if ($conn->connect_error) {
                                                $error_message = "Connection failed: " . $conn->connect_error;
                                                $error = True;
                                            } else {
                                                $m .= " fourth else, ";
                                                $sql = "UPDATE fees SET transaction_id = '$transaction_id' WHERE fee_id = " . $fees_id;

                                                if ($conn->query($sql) === TRUE) {
                                                    $data_insertion = True;
                                                }
                                            }
                                        }
                                    }
                                } else {
                                    $m .= " data insert nahi howa, ";
                                    $error_message = "Error: " . $conn->error;
                                    $error = True;
                                }
                            }
                        } else {
                            $m .= " data insert nahi howa, ";
                            $error_message = "Error: " . $conn->error;
                            $error = True;
                        }
                    }
                }
            }
        }

        // update remaining balence
        if ($data_insertion == True) {
            $m .= " update remaining balance, ";
            // access remaining balance
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                $error_message .= "Connection failed: " . $conn->connect_error;
                $error = True;
            } else {
                $remaining_balance = $total - $pay;
                $sql = 'UPDATE remaining SET remaning_balance = ' . $remaining_balance . ' WHERE GR_no = ' . $gr_no;
                if ($conn->query($sql) === TRUE) {
                    $m .= " remaining balance updated succsessfully, ";
                    $update_remaining_balence = True;
                } else {
                    $error_message = "Error: " . $conn->error;
                    $error = True;
                }
            }
        }

        $conn->close();
    }
}

//  request for print script
if (isset($_POST['print'])) {
    // echo $_POST['fee-id'];
    //Database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "madrassa";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        $error_message = "Connection failed: " . $conn->connect_error;
        echo '<div class="alert-message">';
        echo '<div class="alert alert-danger" style="text-align: center; font-size:20px;">';
        echo '<strong>معزرت</strong>! مہربانی کر کہ دوباراہ کوشیش کریں۔ شکریہ ';
        echo '<br> ' . $error_message;
        echo '</div>';
        echo '</div>';
    } else {
        // echo " first else k ander ";
        $sql = "SELECT * FROM fees WHERE fee_id = " . $_POST['fee-id'];

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $gr_no = $row['GR_no'];
                $month = $row['fee_month'];
                $year = $row['fee_year'];
                $date_of_submit = $row['date_of_submit'];
                $fees_id = $row['fee_id'];
                $monthly_fees = $row['monthly_fees'];
                $yearly_fees = $row['yearly_fees'];
                $remaining = $row['remianing'];
                $challan = $row['challan'];
                $total = $row['total'];
                $discount = $row['discount'];
                $pay = $row['recieved'];
            }
            // echo " first id k ander ";
            $data_access = True;
            $mezan = (int)$monthly_fees + (int)$yearly_fees + (int)$challan + (int)$remaining;
            $remaining_balance = (int)$total - (int)$pay;
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            // echo " " . $gr_no . " ";
            $sql = "SELECT student_name, father_name, department, class FROM students WHERE GR_no = " . $gr_no;

            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $student_name = $row['student_name'];
                    $father_name = $row['father_name'];
                    $department = $row['department'];
                    $class = $row['class'];
                }
                // echo " " . $student_name . " " . $father_name . " " . $department . " " . $class;
                $data_access = True;
            } else {
                // echo " data nahi aya ";
            }
        }
    }
    $conn->close();
}

//Print fee recipt
if ($data_access == True or $data_insertion == True) {

    include("C:/xampp/htdocs/pos/library/tcpdf.php");

    $pdf = new TCPDF('p', 'mm', 'A4', true, 'UTF-8', false);

    // $fontname = $pdf->addTTFfont('/ path - to - font / DejaVuSans . ttf', 'TrueTypeUnicode', '', 32);

    $pdf->setPrintHeader(false);
    // $pdf->setPrintFooter(false);
    // $fontname = $pdf->addTTFfont('C:\xampp\htdocs\pdf\library\mere\Jameel Noori Kasheeda.ttf', 'TrueTypeUnicode', '', 32);

    $pdf->AddPage();
    $pdf->Cell(189, 40);

    $pdf->Image('http://localhost/pos/img/logo/banner.jpg', 10, 10, 189);

    $pdf->Ln();
    $pdf->setFont('freeserif', '', 20);
    $urdu = "فیس کی وصولی کی رسید";

    $pdf->WriteHTMLCell(195, 0, '', '', '<h1 style="text-align:center; color:#007348;">' . $urdu . '</h1>', 0, 1);
    $pdf->Ln(4);
    $pdf->setFont('freeserif', '', 16);

    $basic_info = "بنیادی معلومات";
    $pdf->writeHTMLCell(190, 10, '', '', '<p style="background-color:#007348; color:white; border: solid 1px #007338; text-align:center; border-radius: 24px;">' . $basic_info . '</p>', 0, 1);

    $pdf->setFont('freeserif', '', 12);


    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">' . $gr_no . '</p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">مسلسل رجسٹر نمبر :</p>', 0, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">' . $fees . '</p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">رسید نمبر :</p>', 0, 1);
    $pdf->ln(2);

    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">' . $date_of_submit . '</p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">تاریخ اجرا :</p>', 0, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">' . $month . ' / ' . $year . '</p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">فیس با بت ماہ :</p>', 0, 1);
    $pdf->ln(2);

    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">' . $father_name . '</p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">ولدیت :</p>', 0, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">' . $student_name . '</p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">نام طالب علم / طالبہ :</p>', 0, 1);
    $pdf->ln(2);

    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">' . $class . '</p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">درسگاہ :</p>', 0, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">' . $department . '</p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">شعبہ :</p>', 0, 1);

    $pdf->ln(5);
    $pdf->setFont('freeserif', '', 16);
    $basic_info = "فیس معلومات";
    $pdf->writeHTMLCell(190, 5, '', '', '<p style="background-color:#007348; color:white; border: solid 1px #007338; text-align:center; border-radius: 24px;">' . $basic_info . '</p>', 0, 1);

    $pdf->setFont('freeserif', '', 12);
    $pdf->ln(1);

    // $pdf->Line(10, 125, 200, 125); //upper line 
    // $pdf->Line(10, 135, 200, 135); //midle line
    // $pdf->Line(10, 200, 200, 200); //lower line

    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">' . $yearly_fees . '</p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">سالانہ فیس :</p>', 0, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">' . $monthly_fees . '</p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">ماہانہ فیس :</p>', 0, 1);
    $pdf->ln(2);

    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">' . $remaining . '</p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">سابقہ بقایاجات :</p>', 0, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">' . $challan . '</p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">جرمانہ :</p>', 0, 1);
    $pdf->ln(2);

    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">' . $discount . '</p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">رعایت :</p>', 0, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">' . $mezan . '</p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">میزان :</p>', 0, 1);
    $pdf->ln(2);

    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">' . $pay . '</p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">وصول :</p>', 0, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">' . $total . '</p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">کل واجب الاداٗ :</p>', 0, 1);
    $pdf->ln(2);

    $pdf->WriteHTMLCell(142.5, 5, '', '', '<p style="text-align: right;">' . $remaining_balance . '</p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">بقایا</p>', 0, 1);


    $pdf->ln(8);
    $pdf->setFont('freeserif', '', 16);
    $basic_info = "وضاحت سالانہ فیس";
    $pdf->writeHTMLCell(190, 5, '', '', '<p style="background-color:#2A1D50; color:white; border: solid 1px #2A1D50; text-align:center; ">' . $basic_info . '</p>', 0, 1);

    $pdf->setFont('freeserif', '', 12);
    $pdf->ln(1);

    $note = "پنج ماہی و سالانہ امتحانات، سالانہ تقریب اور دیگر ضروریات کی مد میں سالانہ امتحان سے پہلے مہینے میں سال میں ایک بار سالانہ فیس وصول کی جاتی ہے۔";
    $pdf->WriteHTMLCell(190, 5, '', '', '<p style="text-align:right; font-size:12px;">' . $note . '</p>', 0, 1);

    $pdf->ln(5);
    $pdf->WriteHTMLCell(55, 5, '', '', '<p style="text-align:right; font-size:12px;">_________________________</p>', 0, 0);
    $pdf->WriteHTMLCell(40, 5, '', '', '<p style="text-align:right; font-size:12px;">دستخط وصول کنندہ :</p>', 0, 0);

    $pdf->WriteHTMLCell(55, 5, '', '', '<p style="text-align:right; font-size:12px;">_________________________</p>', 0, 0);
    $pdf->WriteHTMLCell(40, 5, '', '', '<p style="text-align:right; font-size:12px;">دستخط مقامی ذمہ دار :</p>', 0, 1);

    $pdf->Output("Fee Recipt of " . $gr_no . " Date: " . $date_of_submit);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پرینٹ داخلہ فارم</title>
    <?php
    include('C:\xampp\htdocs\pos\assets\header.php');
    ?>
</head>

<body>

</body>

</html>