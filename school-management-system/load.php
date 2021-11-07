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
$reaso_to_leave_school = "";
$class = "";
$department = "";
$occupation = "";
$time_of_class = "";


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
    $reaso_to_leave_school = $_POST['reason-to-leave-last-school'];
    $class = $_POST['class'];
    $department = $_POST['department'];
    $occupation = $_POST['occupation'];
    $time_of_class = $_POST['time-of-class'];
    $id = 1;

    if ($image_name != "no image accessed") {
        // Rename image name and store image in server folder
        $image_ext = pathinfo($image_name, PATHINFO_EXTENSION); //file extention
        $image_name = pathinfo($image_name, PATHINFO_FILENAME);
        $image_name = $gr_number . "." . $image_ext; //name placed with gr no

        $path = "img/profile/" . $image_name;
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
        //Insertion query
        $sql = "INSERT INTO students(id,GR_no,student_name,gender_g,disability,father_name,sir_name,date_of_birth,date_of_admission,monthly_fees,complete_address,CNIC,contact_office,contact_home,qualification,last_school_name,last_school_address,reason_for_leave_school,class,department,occupation,time_for_study,image_name) VALUES ('$id','$gr_number','$student_name','$gender','$disability','$father_name','$cast','$date_of_birth','$date_of_admission','$monthly_fees','$address','$cnic','$office_mobile_number','$mobile_number_home','$qualification','$last_school_name','$last_school_address','$reaso_to_leave_school','$class','$department','$occupation','$time_of_class','$image_name')";

        if ($conn->query($sql) === TRUE) {
            $data_insertion = True;
            if ($image_name != "no image accessed") {
                move_uploaded_file($_FILES['image']['tmp_name'], $path);
            }
            // echo "Data has been saved!";
        } else {
            $error_message = "Error: " . $conn->error;
            $error = True;
        }
    }
}

// Data Access
if (isset($_POST['print-form'])) {
    $data_access = True;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo/logo.png" type="image/x-icon" />

    <title>پرینٹ داخلہ فارم</title>

    <link rel="stylesheet" href="css/admissionStyle.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap2.css">
</head>

<body>

    <?php
    if ($data_access == True or $data_insertion == True) {
        echo '<div class="admission-form">';
        echo '';
        echo '<div class="company-title"><img src="img/logo/banner.jpg" alt="تصویر"></div>';
        echo '';
        echo '<div class="heading">';
        echo '<p>داخلہ فارم</p>';
        echo '</div>';
        echo '<br>';
        echo '';
        echo '<div class="inner-box">';
        echo '<div class="right">';
        echo '<p>:مسلسل رجسٹر نمبر</p>';
        echo '<p>:نام طالب علم/طالبہ</p>';
        echo '<p>:جنس</p>';
        echo '<p>:معزوری</p>';
        echo '<p>:ولدیت</p>';
        echo '<p>:قوم</p>';
        echo '<p>:تاریخ پیدائش</p>';
        echo '<p>:تاریخ داخلہ</p>';
        echo '<p>:ماہانہ فیس</p>';
        echo '<p>:مکمل رہائشی پتہ</p>';
        echo '<p>:قومی شناختی کارڈ نمبر</p>';
        echo '</div>';
        echo '';
        echo '<div class="left">';
        echo '<div class="image"><img src="img/profile/default.jpg" alt="تصویر"></div>';
        echo '<!-- <br class="b-r"><br class="b-r"><br class="b-r"><br class="b-r"><br class="b-r"><br class="b-r"><br class="b-r"><br class="b-r"><br class="b-r"> -->';
        echo '<p>:تعلیمی قابلیت</p>';
        echo '<p>:پیشہ</p>';
        echo '<p>:مطلوبہ درجہ</p>';
        echo '<p>:شعبہ</p>';
        echo '<p>:موبائل نمبر دفتر</p>';
        echo '<p>:موبائل نمبر گھر</p>';
        echo '<p>:سابقہ مکتب کانام</p>';
        echo '<p>:سابقہ مکتب کا پتہ</p>';
        echo '<p>:سابقہ مکتب چھوڑنے کی وجہ</p>';
        echo '';
        echo '<p>:تعلیم کا وقت</p>';
        echo '';
        echo '</div>';
        echo '</div>';
        echo '';
        echo '<div class="line"></div>';
        echo '';
        echo '<div class="iftar-nama">';
        echo '<h1>افترار نامہ</h1>';
        echo '<table>';
        echo '<tr>';
        echo '<td>میں اقرا کرتا/کرتی ہوں کہ میرے علم کے مطابق مندرجہ بالاتفصیلات بلکل درست ہیں۔</td>';
        echo '<td> .1</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>میں اپنے بیٹا / بیٹی کو مکتب کے قوانین وضوابط کی پانبدی کرواوٗں گا / کرواوٗں گی۔</td>';
        echo '<td> .2</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>میں مکتب کی فیس اور دیگر تمام واجبات پابندی سے ادا کروں گا / کروں گی۔</td>';
        echo '<td> .3</td>';
        echo '</tr>';
        echo '</table>';
        echo '';
        echo '</div>';
        echo '';
        echo '<div class="note">';
        echo '<h1>نوٹ</h1>';
        echo '<table>';
        echo '<tr>';
        echo '<td>والد یا سرپرست کے قومی شناختی کارڈکی کاپی ساتھ منسلک کریں۔</td>';
        echo '<td> .1</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>مکتب کے قوانین کی خلاف ورزی کرنے پرمکتب کی انتظامیہ طالب علم / طالبہ کو مکتب سے خارج بھی کرسکتی ہے۔</td>';
        echo '<td> .2</td>';
        echo '</tr>';
        echo '</table>';
        echo '</div>';
        echo '';
        echo '<div class="office-use-only">';
        echo '<h1>صرف دفتری استعمال کے لئے</h1>';
        echo '<p> ناظم / ناظمہ کی رائے۔</p>';
        echo '<p>___________________________________________________________________________________________________________________________________</p>';
        echo '<p>___________________________________________________________________________________________________________________________________</p><br>';
        echo '<p> :دستخط ناظم / ناظمہ</p>';
        echo '';
        echo '</div>';
        echo '';
        echo '</div>';
    } else {
        echo '<div class="alert-message">';
        echo '<div class="alert alert-danger" style="text-align: center; font-size:20px;">';
        echo '<strong>غلطی</strong>! مہربانی کر کہ دوباراہ کوشیش کریں۔ شکریہ ';
        echo '<br> ' . $error_message;
        echo '</div>';
        echo '</div>';
    }
    ?>

    <a href="#" class="btn btn-success btn-lg">
        <span class="glyphicon glyphicon-print"></span> Print
    </a>

</body>

</html>