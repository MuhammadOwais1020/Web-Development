<?php
//Database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "madrassa";

$output = "";
$teacher_id = $_POST["id"];

$conn = mysqli_connect("localhost", "root", "", "madrassa") or die("Connection Failed");

$sql = "SELECT * FROM teachers WHERE GR_no = " . $teacher_id;
$result = mysqli_query($conn, $sql) or die("SQL Query Failed.");

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $gr_number = $row['GR_no'];
        $teacher_name = $row['teacher_name'];
        $gender = $row['gender_g'];
        $father_name = $row['father_name'];
        $cast = $row['sir_name'];
        $date_of_birth = $row['date_of_birth'];
        $date_of_admission  = $row['date_of_admission'];
        $monthly_fees = $row['monthly_salary'];
        $designation = $row['designation'];
        $address = $row['complete_address'];
        $cnic = $row['CNIC'];
        $mobile_number = $row['contact'];
        $qualification = $row['qualification'];
        $image_name = $row['image_name'];
    }
    $output .= '<div id="data-to-show">';
    $output .= '<div class="right">';
    $output .= '<p> مسلسل رجسٹر نمبر: ' . $gr_number . '</p>';
    $output .= '<p>ناظم / ناظمہ: ' . $teacher_name . '</p>';
    $output .= '<p>جنس: ' . $gender . '</p>';
    $output .= '<p>ولدیت: ' . $father_name . '</p>';
    $output .= '<p>قوم: ' . $cast . '</p>';
    $output .= '<p>تاریخ پیدائش: ' . $date_of_birth . '</p>';
    $output .= '<p>تاریخ داخلہ: ' . $date_of_admission . '</p>';

    $output .= '</div>';
    $output .= '<div class="left">';

    $output .= '<div class="image" id="imageP">';
    $output .= '<img src="http://localhost/pos/img/profile-teacher/' . $image_name . '" alt="فوٹو" class="image-preview__image">';
    $output .= '</div>';
    $output .= '<p>مقررہ مشاہرہ: ' . $monthly_fees . '</p>';
    $output .= '<p>عہدہ:' . $designation . '</p>';
    $output .= '<p>مکمل رہائشی پتہ: ' . $address . '</p>';
    $output .= '<p>قومی شناختی کارڈ نمبر: ' . $cnic . '</p>';
    $output .= '<p>موبائل نمبر: ' . $mobile_number . '</p>';
    $output .= '<p>تعلیمی قابلیت: ' . $qualification . '</p>';
    $output .= '</div>';
    $output .= '</div>';

    mysqli_close($conn);
} else {
    $output .= '<h2>No Record Found.</h2>';
}
echo $output;
