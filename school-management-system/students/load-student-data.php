<?php
//Database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "madrassa";

$output = "";
$student_id = $_POST["id"];

$conn = mysqli_connect("localhost", "root", "", "madrassa") or die("Connection Failed");

$sql = "SELECT * FROM students WHERE GR_no = " . $student_id;
$result = mysqli_query($conn, $sql) or die("SQL Query Failed.");

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
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
        $monthly_discount = $row['discount'];
    }
    $output .= '<div id="data-to-show">';
    $output .= '<div class="right">';
    $output .= '<p> مسلسل رجسٹر نمبر: ' . $gr_number . '</p>';
    $output .= '<p>طالب علم / طالبہ: ' . $student_name . '</p>';
    $output .= '<p>جنس: ' . $gender . '</p>';
    $output .= '<p>معزوری: ' . $disability . '</p>';
    $output .= '<p>ولدیت: ' . $father_name . '</p>';
    $output .= '<p>قوم: ' . $cast . '</p>';
    $output .= '<p>تاریخ پیدائش: ' . $date_of_birth . '</p>';
    $output .= '<p>تاریخ داخلہ: ' . $date_of_admission . '</p>';
    $output .= '<p>ماہانہ فیس: ' . $monthly_fees . '</p>';
    $output .= '<p>رعایت: ' . $monthly_discount . '</p>';
    $output .= '<p>مکمل رہائشی پتہ: ' . $address . '</p>';
    $output .= '<p>قومی شناختی کارڈ نمبر: ' . $cnic . '</p>';

    $output .= '</div>';
    $output .= '<div class="left">';

    $output .= '<div class="image" id="imageP">';
    $output .= '<img src="http://localhost/pos/img/profile/' . $image_name . '" alt="فوٹو" class="image-preview__image">';
    $output .= '</div>';
    $output .= '<p>موبائل نمبر دفتر: ' . $office_mobile_number . '</p>';
    $output .= '<p>موبائل نمبر گھر: ' . $mobile_number_home . '</p>';
    $output .= '<p>تعلیمی قابلیت: ' . $qualification . '</p>';
    $output .= '<p>سابقہ مکتب کانام: ' . $last_school_name . '</p>';
    $output .= '<p>سابقہ مکتب کا پتہ: ' . $last_school_address . '</p>';
    $output .= '<p>سابقہ مکتب جھوڑنے کی وجہ: ' . $reason_to_leave_school . '</p>';
    $output .= '<p>مطلوبہ درجہ: ' . $class . '</p>';
    $output .= '<p>سیکشن: ' . $class_type . '</p>';
    $output .= '<p>شعبہ: ' . $department . '</p>';
    $output .= '<p>پیشہ: ' . $occupation . '</p>';
    $output .= '<p>تعلیم کا وقت: ' . $time_of_class . '</p>';
    $output .= '</div>';
    $output .= '</div>';

    mysqli_close($conn);

    echo $output;
} else {
    echo '<h2>No Record Found.</h2>';
}

// He