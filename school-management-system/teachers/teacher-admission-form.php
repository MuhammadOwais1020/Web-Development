<?php
//Error variabls
$data_insertion = False;
$data_access = False;
$error = False;
$error_message = "";
//Data variabls

$image_name = "";
$gr_number = 0;
$teacher_name = "";
$gender = "";
$disability = "";
$father_name = "";
$cast = "";
$date_of_birth = "";
$date_of_admission  = "";
$monthly_salary = "";
$designation = "";
$address = "";
$cnic = 0;
$mobile_number = 0;
$qualification = "";



// Data Insertion
if (isset($_POST['admission-form-submit'])) {
    $image_name = isset($_FILES['image']) ? $_FILES['image']['name'] : "no image accessed";
    $gr_number = $_POST['gr-number'];
    $teacher_name = $_POST['name-of-teacher'];
    $gender = $_POST['gender'];
    $father_name = $_POST['father-name'];
    $cast = $_POST['sir-name'];
    $date_of_birth = $_POST['date-of-birth'];
    $date_of_admission  = $_POST['date-of-admission'];
    $monthly_salary = $_POST['monthly-salary'];
    $designation = $_POST['designation'];
    $address = $_POST['address'];
    $cnic = $_POST['CNIC'];
    $mobile_number = $_POST['mobile-number'];
    $qualification = $_POST['qualification'];

    if ($image_name != "no image accessed") {
        // Rename image name and store image in server folder
        $image_ext = pathinfo($image_name, PATHINFO_EXTENSION); //file extention
        $image_name = pathinfo($image_name, PATHINFO_FILENAME);
        $image_name = $gr_number . "." . $image_ext; //name placed with gr no

        $path = "C:/xampp/htdocs/pos/img/profile-teacher/" . $image_name;
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
        echo '<div class="alert-message">';
        echo '<div class="alert alert-danger" style="text-align: center; font-size:20px;">';
        echo '<strong>غلطی</strong>! مہربانی کر کہ دوباراہ کوشیش کریں۔ شکریہ ';
        echo '<br> ' . $error_message;
        echo '</div>';
        echo '</div>';
    } else {
        //Insertion query
        $sql = "INSERT INTO teachers(GR_no,teacher_name,gender_g,father_name,sir_name,date_of_birth,date_of_admission,monthly_salary,designation,complete_address,CNIC,contact,qualification,image_name) VALUES ('$gr_number','$teacher_name','$gender','$father_name','$cast','$date_of_birth','$date_of_admission','$monthly_salary','$designation','$address','$cnic','$mobile_number','$qualification','$image_name')";

        if ($conn->query($sql) === TRUE) {
            if ($image_name != "no image accessed") {
                move_uploaded_file($_FILES['image']['tmp_name'], $path);
                //Insert remaining 
                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "INSERT INTO remaining_salary(GR_no, remaining_balance) VALUES ('.$gr_number.', 0)";

                if ($conn->query($sql) === TRUE) {
                    $data_insertion = True;
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
        $sql = "SELECT * FROM teachers WHERE GR_no = " . $_POST['gr-id'];
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $gr_number = $row['GR_no'];
                $teacher_name = $row['teacher_name'];
                $gender = $row['gender_g'];
                $father_name = $row['father_name'];
                $cast = $row['sir_name'];
                $date_of_birth = $row['date_of_birth'];
                $date_of_admission  = $row['date_of_admission'];
                $monthly_salary = $row['monthly_salary'];
                $designation = $row['designation'];
                $address = $row['complete_address'];
                $cnic = $row['CNIC'];
                $mobile_number = $row['contact'];
                $qualification = $row['qualification'];
                $image_name = $row['image_name'];
            }
            $data_access = True;
        }
    }
}
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
    $urdu = "معلمین و ملازمین تقرر فارم";

    $pdf->WriteHTMLCell(195, 0, '', '', '<h1 style="text-align:center; color:#007348;">' . $urdu . '</h1>', 0, 1);
    $pdf->Ln(4);
    $pdf->setFont('freeserif', '', 16);

    $basic_info = "بنیادی معلومات";
    $pdf->writeHTMLCell(190, 10, '', '', '<p style="background-color:#007348; color:white; border: solid 1px #007338; text-align:center; border-radius: 24px;">' . $basic_info . '</p>', 0, 1);

    $pdf->setFont('freeserif', '', 12);


    $pdf->Cell(50, 50, "", 0, 0); //Pictuer box
    $pdf->Image('http://localhost/pos/img/profile/786.jpg', 11, 75, 40, 45);

    $pdf->WriteHTMLCell(25, 5, '', '', '<p style="text-align:right;">' . $monthly_salary . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(25, 5, '', '', '<p style="text-align:right;">مقررہ مشاہرہ :</p>', 0, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">' . $gr_number . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(42.5, 5, '', '', '<p style="text-align:right;">مسلسل رجسٹر نمبر : </p>', 0, 1);
    $pdf->ln(2);

    $pdf->Cell(50, 5); //empty cell
    $pdf->WriteHTMLCell(25, 5, '', '', '<p style="text-align:right;">' . $gender . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(25, 5, '', '', '<p style="text-align:right;">جنس :</p>', 0, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">' . $teacher_name . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(42.5, 5, '', '', '<p style="text-align:right;">نام معلمین و ملازمین :</p>', 0, 1);
    $pdf->ln(2);

    $pdf->Cell(50, 5); //empty cell
    $pdf->WriteHTMLCell(25, 5, '', '', '<p style="text-align:right;">' . $cast . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(25, 5, '', '', '<p style="text-align:right;">قوم :</p>', 0, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">' . $father_name . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(42.5, 5, '', '', '<p style="text-align:right;">ولدیت :</p>', 0, 1);
    $pdf->ln(2);

    $pdf->Cell(50, 5); //empty cell
    $pdf->WriteHTMLCell(97.5, 5, '', '', '<p style="text-align:right;">' . $designation . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(42.5, 5, '', '', '<p style="text-align:right;">عہدہ : </p>', 0, 1);
    $pdf->ln(2);

    $pdf->Cell(50, 5); //empty cell
    $pdf->WriteHTMLCell(25, 5, '', '', '<p style="text-align:right;">' . $date_of_birth . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(25, 5, '', '', '<p style="text-align:right;">تاریخ پیدائش :</p>', 0, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">' . $date_of_admission . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(42.5, 5, '', '', '<p style="text-align:right;">تاریخ داخلہ :</p>', 0, 1);
    $pdf->ln(2);

    $pdf->WriteHTMLCell(100, 5, '', '', '', 0, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">' . $qualification . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(42.5, 5, '', '', '<p style="text-align:right;">تعلیمی قابلیت : </p>', 0, 1);
    $pdf->ln(2);

    $pdf->WriteHTMLCell(52.5, 5, '', '', '<p style="text-align:right;">' . $cnic . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">قومی شناختی کارڈ نمبر : </p>', 0, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">' . $mobile_number . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(42.5, 5, '', '', '<p style="text-align:right;">موبائل نمبر : </p>', 0, 1);
    $pdf->ln(2);

    $pdf->WriteHTMLCell(147.5, 5, '', '', '<p style="text-align:right;">' . $address . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(42.5, 5, '', '', '<p style="text-align:right;">مکمل رہائشی پتہ :</p>', 0, 1);


    $pdf->ln(5);
    $pdf->setFont('freeserif', '', 16);
    $basic_info = "اصول و ضوابط برائے معلمین و ملازمین";
    $pdf->writeHTMLCell(190, 5, '', '', '<p style="background-color:#007348; color:white; border: solid 1px #007338; text-align:center; border-radius: 24px;">' . $basic_info . '</p>', 0, 1);


    $pdf->setFont('freeserif', '', 12);
    $pdf->ln(1);

    $pdf->WriteHTMLCell(180, 5, '', '', '<p style="text-align:right; font-size:12px;">ہر معلم / معلمہ کو چاہئے کہ طلبا / طلبات کی تجوید تھیک کرانے کی ان تک محنت کرے۔</p>', 0, 0);
    $pdf->WriteHTMLCell(10, 5, '', '', '.1', 0, 1);

    $pdf->WriteHTMLCell(180, 5, '', '', '<p style="text-align:right; font-size:12px;">اجتماعی تعلیم کم از کم ڈیڑھ گھنٹہ کی کلاس کے مطابق ہو گی اور معلم / معلمہ کو درسگاہ کے وقت سے 5 منٹ پہلے درسگاہ میں آناضروری ہوگا۔</p>', 0, 0);
    $pdf->WriteHTMLCell(10, 5, '', '', '.2', 0, 1);
    $pdf->ln();
    $pdf->WriteHTMLCell(180, 5, '', '', '<p style="text-align:right; font-size:12px;">طلبا / طلبات کو بغیر مار کے شفقت سے پڑھاناہوگا۔</p>', 0, 0);
    $pdf->WriteHTMLCell(10, 5, '', '', '.3', 0, 1);

    $pdf->WriteHTMLCell(180, 5, '', '', '<p style="text-align:right; font-size:12px;">کسی معلم / معلمہ کوانتظامی معاملات میں کسی قسم کی مداخلت کرنے کی اجازت نہیں ہوگی۔</p>', 0, 0);
    $pdf->WriteHTMLCell(10, 5, '', '', '.4', 0, 1);

    $pdf->WriteHTMLCell(180, 5, '', '', '<p style="text-align:right; font-size:12px;">ہر معلم / معلمہ کے لئے ماہانہ مشورہ میں اول سے آخر تک شرکت کرنا لازمی ہوگی۔ </p>', 0, 0);
    $pdf->WriteHTMLCell(10, 5, '', '', '.5', 0, 1);

    $pdf->WriteHTMLCell(180, 5, '', '', '<p style="text-align:right; font-size:12px;">ہر معلم / معلمہ کے لئے سالانہ تربیتی نشست میں مکمل وقت اور ایام کی پابندی کے ساتھ شرکت کرنا لازمی ہوگا۔</p>', 0, 0);
    $pdf->WriteHTMLCell(10, 5, '', '', '.6', 0, 1);

    $pdf->WriteHTMLCell(180, 5, '', '', '<p style="text-align:right; font-size:12px;">ہر معلم / معلمہ کو سال میں چوبیس (24) دن یعنی مہینے میں دو (2) دن کی رخصت مفت ہیں۔ اس سے زیادہ رخصت کرنے پر مشاہرہ سے کٹوتی کی جائے گی۔</p>', 0, 0);
    $pdf->WriteHTMLCell(10, 5, '', '', '.7', 0, 1);
    $pdf->ln();
    $pdf->WriteHTMLCell(180, 5, '', '', '<p style="text-align:right; font-size:12px;">بغیر اجازت کے چھٹی کرنے پر دگنی کٹوتی کی جائے گی۔</p>', 0, 0);
    $pdf->WriteHTMLCell(10, 5, '', '', '.8', 0, 1);

    $pdf->WriteHTMLCell(180, 5, '', '', '<p style="text-align:right; font-size:12px;">جو معلم / معلمہ بالکل چھوٹی نہیں کرے گا / گی، اس پر خصوصی انعام (بونس) دیا جائے گا۔</p>', 0, 0);
    $pdf->WriteHTMLCell(10, 5, '', '', '.9', 0, 1);

    $pdf->ln(5);
    $pdf->setFont('freeserif', '', 16);
    $basic_info = "اقرار نامہ";
    $pdf->writeHTMLCell(190, 5, '', '', '<p style="background-color:#2A1D50; color:white; border: solid 1px #2A1D50; text-align:center; ">' . $basic_info . '</p>', 0, 1);

    $pdf->setFont('freeserif', '', 12);
    $pdf->ln(1);

    $afliated = "میں _____________________________________ اقرار کرتا / کرتی ہوں کہ میں نے ان تمام اصول وضوابط کو بغور پڑھ کرسمجھ لیا ہے۔ اور میں ان تمام اصول و ضوابط کی پابندی کرنے کی پوری پوری کوشش کروں گا / گی۔";
    $pdf->WriteHTMLCell(190, 5, '', '', '<p style="text-align:right; font-size:12px;">' . $afliated . '</p>', 0, 1);

    $pdf->ln();
    // $pdf->Line(10, 255, 163, 255);
    // $pdf->Line(10, 262, 200, 262);
    $pdf->Line(10, 274, 70, 274); //signature line

    // $pdf->ln(5);
    // $pdf->setFont('freeserif', '', 16);
    // $basic_info = "صرف دفتری استعمال کے لئے";
    // $pdf->writeHTMLCell(190, 5, '', '', '<p style="background-color:#007348; color:white; border: solid 1px #007348; text-align:center; ">' . $basic_info . '</p>', 0, 1);

    // $pdf->setFont('freeserif', '', 12);
    // $pdf->ln(5);

    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right; font-size:12px;">' . $mobile_number . '</p>', 0, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right; font-size:12px;">رابطہ نمبر :</p>', 0, 0);

    $pdf->WriteHTMLCell(55, 5, '', '', '<p style="text-align:right; font-size:12px;">_________________________</p>', 0, 0);
    $pdf->WriteHTMLCell(40, 5, '', '', '<p style="text-align:right; font-size:12px;">دستخط معلم / معلمہ :</p>', 0, 1);

    // $pdf->WriteHTMLCell(40, 5, '', '', '<p style="text-align:right; font-size:12px;">ناظم / ناظمہ کی رائے :</p>', 0, 1);

    // $pdf->WriteHTMLCell(190, 5, '', '', '<p style=""></p>', 0, 1);
    $pdf->ln(7);
    $pdf->WriteHTMLCell(60, 5, '', '', '<p style="text-align:left; font-size:12px;"></p>', 0, 0);
    $pdf->WriteHTMLCell(130, 5, '', '', '<p style="text-align:left; font-size:12px;">دستخط ناظم / ناظمہ:</p>', 0, 1);
    // $pdf->WriteHTMLCell(140, 5, '', '', '<p style="text-align:center; font-weight:bold;"></p>', 1, 1);

    $pdf->Output();
} else {
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