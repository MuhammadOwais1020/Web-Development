<?php
//Error variabls
$data_insertion = False;
$data_access = False;
$error = False;
$error_message = "";
//Data variabls

// $image_name = [];
$gr_number = 0;
$student_name = "";
$gender = "";
$disability = "";
$father_name = "";
$cast = "";
$date_of_birth = "";
$date_of_admission  = "";
$monthly_fees = "";
$address = "";
$cnic = 0;
$office_mobile_number = 0;
$mobile_number_home = 0;
$qualification = "";
$last_school_name = "";
$last_school_address = "";
$reason_to_leave_school = "";
$class = "";
$class_type = "";
$department = "";
$occupation = "";
$time_of_class = "";
$monthly_discount = 0;
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
$output = "";
// Data Insertion
if (isset($_POST['admission-form-submit'])) {
    $image_name = isset($_FILES['image']) ? $_FILES['image']['name'] : "no image accessed";
    $gr_number = $_POST['gr-number'];
    $student_name = $_POST['name-of-student'];
    $gender = $_POST['gender'];
    $disability = $_POST['disability'];
    $father_name = $_POST['father-name'];
    $cast = $_POST['sir-name'];
    $date_of_birth = $_POST['date-of-birth'];
    $date_of_admission  = $_POST['date-of-admission'];
    $monthly_fees = $_POST['monthly-fees'];
    $address = $_POST['address'];
    $cnic = $_POST['CNIC'];
    $office_mobile_number = $_POST['mobile-number-office'];
    $mobile_number_home = $_POST['mobile-number-home'];
    $qualification = $_POST['qualification'];
    $last_school_name = $_POST['last-school-name'];
    $last_school_address = $_POST['last-school-address'];
    $reason_to_leave_school = $_POST['reason-to-leave-last-school'];
    $class = $_POST['class'];
    $class_type = $_POST['class-type'];
    $department = $_POST['department'];
    $occupation = $_POST['occupation'];
    $time_of_class = $_POST['time-of-class'];
    $monthly_discount = $_POST['monthly-discount'];
    $fee_id = 1;

    if ($image_name != "no image accessed") {
        // Rename image name and store image in server folder
        $image_ext = pathinfo($image_name, PATHINFO_EXTENSION); //file extention
        $image_name = pathinfo($image_name, PATHINFO_FILENAME);
        $image_name = $gr_number . "." . $image_ext; //name placed with gr no

        $path = "C:/xampp/htdocs/pos/img/profile/" . $image_name;
    }

    //Database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "madrassa";

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

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        $error_message = "Connection failed: " . $conn->connect_error;
        $error = True;
    } else {
        //Insertion query
        $sql = "INSERT INTO students(GR_no,student_name,gender_g,disability,father_name,sir_name,date_of_birth,date_of_admission,monthly_fees,complete_address,CNIC,contact_office,contact_home,qualification,last_school_name,last_school_address,reason_for_leave_school,class,department,occupation,time_for_study,image_name,discount,class_type) VALUES ('$gr_number','$student_name','$gender','$disability','$father_name','$cast','$date_of_birth','$date_of_admission','$monthly_fees','$address','$cnic','$office_mobile_number','$mobile_number_home','$qualification','$last_school_name','$last_school_address','$reason_to_leave_school','$class','$department','$occupation','$time_of_class','$image_name','$monthly_discount','$class_type')";
        echo $output;
        if ($conn->query($sql) === TRUE) {
            if ($image_name != "no image accessed") {
                move_uploaded_file($_FILES['image']['tmp_name'], $path);

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                //insert fees
                $sql = "INSERT INTO fees(fee_id, GR_no, date_of_submit, fee_month, fee_year, monthly_fees, yearly_fees, remianing, challan, total, discount, recieved, status_) VALUES ('$fee_id','$gr_number', ' $date_of_admission ', '$month', '$year', '$monthly_fees', '$yearly_fees', '$remaining', '$challan', '$total', '$discount', '$pay','unpaid')";

                if ($conn->query($sql) === TRUE) {
                    //Insert remaining 
                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "INSERT INTO remaining(GR_no, remaning_balance) VALUES ('.$gr_number.', 0)";
                    if ($conn->query($sql) === TRUE) {

                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $sql = "INSERT INTO roll_number(GR_no, roll_no) VALUES ('.$gr_number.', 0)";
                        if ($conn->query($sql) === TRUE) {
                            $data_insertion = True;
                            //roll number update
                            include('roll-number-update.php');
                        } else {
                            $error_message = "Error: " . $conn->error;
                            $error = True;
                        }
                    } else {
                        $error_message = "Error: " . $conn->error;
                        $error = True;
                    }
                } else {
                    $error_message = "Error: " . $conn->error;
                    $error = True;
                }
            }
            // echo "Data has been saved!";
        } else {
            $error_message = "Error: " . $conn->error;
            $error = True;
        }
    }
}

// Data Access
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
        $sql = "SELECT * FROM students WHERE GR_no = " . $_POST['gr-id'];
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $gr_number = $row['GR_no'];
                $student_name = $row['student_name'];
                $gender = $row['gender_g'];
                $disability = $row['disability'];
                $father_name = $row['father_name'];
                $cast = $row['sir_name'];
                $date_of_birth = $row['date_of_birth'];
                $date_of_admission  = $row['date_of_admission'];
                $monthly_fees = $row['monthly_fees'];
                $address = $row['complete_address'];
                $cnic = $row['CNIC'];
                $office_mobile_number = $row['contact_office'];
                $mobile_number_home = $row['contact_home'];
                $qualification = $row['qualification'];
                $last_school_name = $row['last_school_name'];
                $last_school_address = $row['last_school_address'];
                $reason_to_leave_school = $row['reason_for_leave_school'];
                $class = $row['class'];
                $class_type = $row['class_type'];
                $department = $row['department'];
                $occupation = $row['occupation'];
                $time_of_class = $row['time_for_study'];
                $image_name = $row['image_name'];
            }
            $data_access = True;
        }
    }
}


// Print admission form
if ($data_access == True or $data_insertion == True) {
    include("C:/xampp/htdocs/pos/library/tcpdf.php");

    $pdf = new TCPDF('p', 'mm', 'A4', true, 'UTF-8', false);

    $pdf->setPrintHeader(false);
    // $pdf->setPrintFooter(false);
    // $fontname = $pdf->addTTFfont('C:\xampp\htdocs\pdf\library\mere\Jameel Noori Kasheeda.ttf', 'TrueTypeUnicode', '', 32);

    $pdf->AddPage();
    $pdf->Cell(189, 40);

    $pdf->Image('http://localhost/pos/img/logo/banner.jpg', 10, 10, 189);

    $pdf->Ln();
    $pdf->setFont('freeserif', '', 20);
    $urdu = "داخلہ فارم";

    $pdf->WriteHTMLCell(195, 0, '', '', '<h1 style="text-align:center; color:#007348;">' . $urdu . '</h1>', 0, 1);
    $pdf->Ln(4);
    $pdf->setFont('freeserif', '', 16);

    $basic_info = "بنیادی معلومات";
    $pdf->writeHTMLCell(190, 10, '', '', '<p style="background-color:#007348; color:white; border: solid 1px #007338; text-align:center; border-radius: 24px;">' . $basic_info . '</p>', 0, 1);

    $pdf->setFont('freeserif', '', 12);
    $col_1 = "محمد اویس";
    $col_2 = "Muhammad Rafique";

    $pdf->Cell(50, 50, "", 0, 0); //Pictuer box
    $pdf->Image('http://localhost/pos/img/profile/' . $image_name, 11, 75, 40, 45);

    // $pdf->WriteHTMLCell(45, 5, '', '', '', 0, 0);
    $pdf->WriteHTMLCell(25, 5, '', '', '<p style="text-align:right;">' . $monthly_fees . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(25, 5, '', '', '<p style="text-align:right;">ماہانہ فیس :</p>', 0, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">' . $gr_number . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(42.5, 5, '', '', '<p style="text-align:right;">مسلسل رجسٹر نمبر : </p>', 0, 1);
    $pdf->ln(2);

    $pdf->Cell(50, 5); //empty cell
    $pdf->WriteHTMLCell(25, 5, '', '', '<p style="text-align:right;">' . $gender . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(25, 5, '', '', '<p style="text-align:right;">جنس :</p>', 0, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">' . $student_name . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(42.5, 5, '', '', '<p style="text-align:right;">نام طالب علم/ طالبہ :</p>', 0, 1);
    $pdf->ln(2);

    $pdf->Cell(50, 5); //empty cell
    $pdf->WriteHTMLCell(25, 5, '', '', '<p style="text-align:right;">' . $cast . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(25, 5, '', '', '<p style="text-align:right;">قوم :</p>', 0, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">' . $father_name . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(42.5, 5, '', '', '<p style="text-align:right;">ولدیت :</p>', 0, 1);
    $pdf->ln(2);

    $pdf->Cell(50, 5); //empty cell
    $pdf->WriteHTMLCell(50, 5, '', '', '', 0, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">' . $disability . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(42.5, 5, '', '', '<p style="text-align:right;">معزوری :</p>', 0, 1);
    $pdf->ln(2);

    $pdf->Cell(50, 5); //empty cell
    $pdf->WriteHTMLCell(25, 5, '', '', '<p style="text-align:right;">' . $date_of_admission . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(25, 5, '', '', '<p style="text-align:right;">تاریخ داخلہ :</p>', 0, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">' . $date_of_birth . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(42.5, 5, '', '', '<p style="text-align:right;">تاریخ پیدائش :</p>', 0, 1);
    $pdf->ln(2);
    $pdf->Cell(50, 5); //empty cell

    $pdf->WriteHTMLCell(25, 5, '', '', '<p style="text-align:right;">' . $occupation . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(25, 5, '', '', '<p style="text-align:right;">پیشہ : </p>', 0, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">' . $cnic . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(42.5, 5, '', '', '<p style="text-align:right;">قومی شناختی کارڈ نمبر : </p>', 0, 1);
    $pdf->ln(2);

    $pdf->WriteHTMLCell(52.5, 5, '', '', '<p style="text-align:right;">' . $mobile_number_home . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">موبائل نمبر گھر : </p>', 0, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">' . $office_mobile_number . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(42.5, 5, '', '', '<p style="text-align:right;">موبائل نمبر دفتر :</p>', 0, 1);
    $pdf->ln(2);

    $pdf->WriteHTMLCell(147.5, 5, '', '', '<p style="text-align:right;">' . $address . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(42.5, 5, '', '', '<p style="text-align:right;">مکمل رہائشی پتہ :</p>', 0, 1);
    $pdf->ln(2);


    $pdf->WriteHTMLCell(52.5, 5, '', '', '<p style="text-align:right;">' . $last_school_name . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">سابقہ مکتب کانام :</p>', 0, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">' . $qualification . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(42.5, 5, '', '', '<p style="text-align:right;">تعلیمی قابلیت : </p>', 0, 1);
    $pdf->ln(2);


    $pdf->WriteHTMLCell(52.5, 5, '', '', '<p style="text-align:right;">' . $reason_to_leave_school . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">سابقہ مکتب چھوڑنے کی وجہ : </p>', 0, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">' . $last_school_address . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(42.5, 5, '', '', '<p style="text-align:right;">سابقہ مکتب کا پتہ :</p>', 0, 1);
    $pdf->ln(2);

    $pdf->WriteHTMLCell(52.5, 5, '', '', '<p style="text-align:right;"> ' . $class . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">مطلوبہ درجہ :</p>', 0, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">' . $department . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(42.5, 5, '', '', '<p style="text-align:right;">شعبہ :</p>', 0, 1);
    $pdf->ln(2);

    $pdf->WriteHTMLCell(52.5, 5, '', '', '<p style="text-align:right;"> ' . $class_type . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">سیکشن :</p>', 0, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">' . $time_of_class . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(42.5, 5, '', '', '<p style="text-align:right;">تعلیم کا وقت :</p>', 0, 1);
    $pdf->ln(2);


    $pdf->ln(5);
    $pdf->setFont('freeserif', '', 16);
    $basic_info = "افترار نامہ";
    $pdf->writeHTMLCell(190, 5, '', '', '<p style="background-color:#007348; color:white; border: solid 1px #007338; text-align:center; border-radius: 24px;">' . $basic_info . '</p>', 0, 1);


    $pdf->setFont('freeserif', '', 12);
    $pdf->ln(1);

    $pdf->WriteHTMLCell(180, 5, '', '', '<p style="text-align:right; font-size:12px;">میں اقرا کرتا/کرتی ہوں کہ میرے علم کے مطابق مندرجہ بالاتفصیلات بلکل درست ہیں۔</p>', 0, 0);
    $pdf->WriteHTMLCell(10, 5, '', '', '.1', 0, 1);

    $pdf->WriteHTMLCell(180, 5, '', '', '<p style="text-align:right; font-size:12px;">میں اپنے بیٹا / بیٹی کو مکتب کے قوانین وضوابط کی پانبدی کرواوٗں گا / کرواوٗں گی ۔</p>', 0, 0);
    $pdf->WriteHTMLCell(10, 5, '', '', '.2', 0, 1);

    $pdf->WriteHTMLCell(60, 5, '', '', '<p style="text-align:right; font-size:12px;">دستخط سرپرست :</p>', 0, 0);
    $pdf->WriteHTMLCell(120, 5, '', '', '<p style="text-align:right; font-size:12px;">میں مکتب کی فیس اور دیگر تمام واجبات پابندی سے ادا کروں گا / کروں گی ۔</p>', 0, 0);
    $pdf->WriteHTMLCell(10, 5, '', '', '.3', 0, 1);


    $pdf->ln(5);
    $pdf->setFont('freeserif', '', 16);
    $basic_info = "نوٹ";
    $pdf->writeHTMLCell(190, 5, '', '', '<p style="background-color:#de1738; color:white; border: solid 1px #de1738; text-align:center; ">' . $basic_info . '</p>', 0, 1);

    $pdf->setFont('freeserif', '', 12);
    $pdf->ln(1);

    $pdf->WriteHTMLCell(180, 5, '', '', '<p style="text-align:right; font-size:12px;">والد یا سرپرست کے قومی شناختی کارڈکی کاپی ساتھ منسلک کریں۔</p>', 0, 0);
    $pdf->WriteHTMLCell(10, 5, '', '', '.1', 0, 1);

    $pdf->WriteHTMLCell(180, 5, '', '', '<p style="text-align:right; font-size:12px;">مکتب کے قوانین کی خلاف ورزی کرنے پرمکتب کی انتظامیہ طالب علم / طالبہ کو مکتب سے خارج بھی کرسکتی ہے۔</p>', 0, 0);
    $pdf->WriteHTMLCell(10, 5, '', '', '.2', 0, 1);


    $pdf->Line(10, 258, 163, 258);
    $pdf->Line(10, 268, 200, 268);
    $pdf->Line(10, 278, 70, 278); //signature line

    $pdf->ln(5);
    $pdf->setFont('freeserif', '', 16);
    $basic_info = "صرف دفتری استعمال کے لئے";
    $pdf->writeHTMLCell(190, 5, '', '', '<p style="background-color:#007348; color:white; border: solid 1px #007348; text-align:center; ">' . $basic_info . '</p>', 0, 1);

    $pdf->setFont('freeserif', '', 12);
    // $pdf->ln();

    $pdf->WriteHTMLCell(150, 5, '', '', '<p style="text-align:right; font-size:12px;"></p>', 0, 0);
    $pdf->WriteHTMLCell(40, 5, '', '', '<p style="text-align:right; font-size:12px;">ناظم / ناظمہ کی رائے :</p>', 0, 1);

    $pdf->WriteHTMLCell(190, 5, '', '', '<p style=""></p>', 0, 1);
    $pdf->ln(8);
    $pdf->WriteHTMLCell(60, 5, '', '', '<p style="text-align:left; font-size:12px;"></p>', 0, 0);
    $pdf->WriteHTMLCell(130, 5, '', '', '<p style="text-align:left; font-size:12px;">دستخط ناظم / ناظمہ:</p>', 0, 1);
    // $pdf->WriteHTMLCell(140, 5, '', '', '<p style="text-align:center; font-weight:bold;"></p>', 1, 1);

    $pdf->Output("Admission form of " . $gr_number . " Date: " . $date_of_admission);
} else {
    $output .= ' akhir wala ';
    echo '<div class="alert-message">';
    echo '<div class="alert alert-danger" style="text-align: center; font-size:20px;">';
    echo '<strong>غلطی</strong>! مہربانی کر کہ دوباراہ کوشیش کریں۔ شکریہ ';
    echo '<br> ' . $error_message;
    echo '</div>';
    echo '</div>';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        body,
        p {
            font-family: urdu !important;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="C:\xampp\htdocs\pos\img\logo\logo.png" type="image/x-icon" />

    <title>پرینٹ داخلہ فارم</title>

    <link rel="stylesheet" href="C:\xampp\htdocs\pos\css\admissionStyle.css">
    <link rel="stylesheet" href="C:\xampp\htdocs\pos\css\bootstrap.css">
    <link rel="stylesheet" href="C:\xampp\htdocs\pos\css\bootstrap2.css">
</head>

<body>
</body>

</html>