<?php
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
$designation = "";
$teacher_name = "";
$fees_id = "";
$monthly_salary = "";
$bonus = "";
$already_paid = "";
$present = "";
$cut = "";
$previous_remaining = "";
$total = "";
$pay = "";
$fees = 0;
$remaining_balance = 0;
$date_of_submit = "";
$mezan = 0;
$transaction_id = 0;

$date_time = date("Y/m/d h:i:sa");
$type = "SS";
$details = "نتخواہ کی ادائیگی";
$dr = 0;
$cr = 0;

if (isset($_POST['salary-submit'])) {
    $gr_no = $_POST['gr-no'];
    $date_of_submit = $_POST['date-of-submit'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $designation = $_POST['designation'];
    $teacher_name = $_POST['teacher-name'];
    $fees_id = $_POST['fees-id'];
    $monthly_salary = $_POST['monthly-salary'];
    $bonus = $_POST['bonus'];
    $already_paid = $_POST['already-paid'];
    $previous_remaining = $_POST['remaining-salary'];
    $cut = $_POST['cut'];
    $present = $_POST['present'];
    $total = $_POST['total'];
    $pay = $_POST['pay'];

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
        echo '<strong>غلطی</strong>! مہربانی کر کہ دوباراہ کوشیش کریں۔ شکریہ ';
        echo '<br> ' . $error_message;
        echo '</div>';
        echo '</div>';
        $error = True;
    } else {
        $m .= " first else, ";
        $sql = 'SELECT * FROM salary WHERE (GR_no = ' . $gr_no . ' and fee_month = ' . $month . ') and (fee_year = ' . $year . ' and status_ = "paid")';
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $m .= " there is already paid before, ";
            while ($row = $result->fetch_assoc()) {
            }

            echo '<div class="alert-message">';
            echo '<div class="alert alert-danger" style="text-align: center; font-size:20px;">';
            echo '<strong>غلطی</strong>! آپ اس ماہ کی تنخواہ پہلے سے ہی ادا کر چوکے ہیں۔ شکریہ ';
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
                echo '<strong>غلطی</strong>! مہربانی کر کہ دوباراہ کوشیش کریں۔ شکریہ ';
                echo '<br> ' . $error_message;
                echo '</div>';
                echo '</div>';
                $error = True;
            } else {

                $m .= " fifth else, ";
                //pay fees
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    $error_message = "Connection failed: " . $conn->connect_error;
                    $error = True;
                } else {
                    $m .= " sixth else, ";
                    $sql = "INSERT INTO salary(fee_id, GR_no, date_of_submit, fee_month, fee_year, monthly_salary, previous_remaining, bonus, already_recieved, present, cut, total, recieved, status_, transaction_id) VALUES ('$fees_id', '$gr_no', '$date_of_submit', '$month', '$year', '$monthly_salary', '$previous_remaining', '$bonus', '$already_paid', '$present', '$cut', '$total', '$pay', 'paid','$transaction_id')";

                    // add in finance
                    if ($conn->query($sql) === TRUE) {

                        $conn = new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                            $error_message = "Connection failed: " . $conn->connect_error;
                            $error = True;
                        } else {
                            $cr = $pay;
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
                                            $sql = "UPDATE salary SET transaction_id = '$transaction_id' WHERE fee_id = " . $fees_id;

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
                $sql = 'UPDATE remaining_salary SET remaining_balance = ' . $remaining_balance . ' WHERE GR_no = ' . $gr_no;
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
        echo '<strong>غلطی</strong>! مہربانی کر کہ دوباراہ کوشیش کریں۔ شکریہ ';
        echo '<br> ' . $error_message;
        echo '</div>';
        echo '</div>';
    } else {
        $sql = "SELECT * FROM salary WHERE fee_id = " . $_POST['fee-id'];

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $gr_no = $row['GR_no'];
                $month = $row['fee_month'];
                $year = $row['fee_year'];
                $date_of_submit = $row['date_of_submit'];
                $fees_id = $row['fee_id'];
                $monthly_salary = $row['monthly_salary'];
                $previous_remaining = $row['previous_remaining'];
                $bonus = $row['bonus'];
                $already_paid = $row['already_recieved'];
                $present = $row['present'];
                $cut = $row['cut'];
                $total = $row['total'];
                $pay = $row['recieved'];
            }
            $data_access = True;
            $remaining_balance = (int)$total - (int)$pay;
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT teacher_name, designation FROM teachers WHERE GR_no = " . $gr_no;

            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $teacher_name = $row['teacher_name'];
                    $designation = $row['designation'];
                }
                $data_access = True;
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
    $urdu = "تنخواہ کی وصولی کی رسید";

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

    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">' . $designation . '</p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">عہدہ :</p>', 0, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">' . $teacher_name . '</p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">نام معلمین و ملازمین :</p>', 0, 1);
    $pdf->ln(2);

    $pdf->ln(5);
    $pdf->setFont('freeserif', '', 16);
    $basic_info = "تنخواہ معلومات";
    $pdf->writeHTMLCell(190, 5, '', '', '<p style="background-color:#007348; color:white; border: solid 1px #007338; text-align:center; border-radius: 24px;">' . $basic_info . '</p>', 0, 1);

    $pdf->setFont('freeserif', '', 12);
    $pdf->ln(1);

    // $pdf->Line(10, 125, 200, 125); //upper line 
    // $pdf->Line(10, 135, 200, 135); //midle line
    // $pdf->Line(10, 200, 200, 200); //lower line

    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">' . $previous_remaining . '</p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">سابقہ بقایاجات :</p>', 0, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">' . $monthly_salary . '</p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">قررہ مشاہرہ :</p>', 0, 1);
    $pdf->ln(2);

    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">' . $bonus . '</p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;"> اضافی (انعام وغیرہ) :</p>', 0, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">' . $already_paid . '</p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">یشگی وصول شدہ رقم :</p>', 0, 1);
    $pdf->ln(2);

    $mezan = ($monthly_salary + $previous_remaining + $bonus) - $already_paid;

    $pdf->WriteHTMLCell(142.5, 5, '', '', '<p style="text-align: right;">' . $mezan . '</p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">میزان :</p>', 0, 1);
    $pdf->ln(2);

    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">' . $present . '</p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">کل ایام کار :</p>', 0, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">' . $cut . '</p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">کٹوتی :</p>', 0, 1);
    $pdf->ln(2);

    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">' . $pay . '</p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">اداشدہ مشاہرہ :</p>', 0, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">' . $total . '</p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">کل واجب الاداٗ :</p>', 0, 1);
    $pdf->ln(2);

    $remaining_balance = $total - $pay;

    $pdf->WriteHTMLCell(142.5, 5, '', '', '<p style="text-align: right;">' . $remaining_balance . '</p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align: right;">بقایا</p>', 0, 1);

    $pdf->ln(10);
    $pdf->WriteHTMLCell(55, 5, '', '', '<p style="text-align:right; font-size:12px;">_________________________</p>', 0, 0);
    $pdf->WriteHTMLCell(40, 5, '', '', '<p style="text-align:right; font-size:12px;">دستخط وصول کنندہ :</p>', 0, 0);

    $pdf->WriteHTMLCell(55, 5, '', '', '<p style="text-align:right; font-size:12px;">_________________________</p>', 0, 0);
    $pdf->WriteHTMLCell(40, 5, '', '', '<p style="text-align:right; font-size:12px;">دستخط مقامی ذمہ دار :</p>', 0, 1);

    $pdf->Output("Salary Recipt of " . $gr_no . " Date: " . $date_of_submit);
}

echo 'A gya!';
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