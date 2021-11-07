<?php
//Database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "madrassa";

$gr_number = $_POST['gr'];
$student_name = $_POST['s_name'];
$gender = $_POST['gender'];
$disability = $_POST['disability'];
$father_name = $_POST['father_name'];
$cast = $_POST['cast'];
$date_of_birth = $_POST['date_of_birth'];
$date_of_admission  = $_POST['date_of_admission'];
$monthly_fees = $_POST['monthly_fees'];
$address = $_POST['address'];
$cnic = $_POST['cnic'];
$office_mobile_number = $_POST['mobile_number_office'];
$mobile_number_home = $_POST['mobile_number_home'];
$qualification = $_POST['qualification'];
$last_school_name = $_POST['last_school_name'];
$last_school_address = $_POST['last_school_address'];
$reason_to_leave_school = $_POST['reason_to_leave_last_school'];
$class = $_POST['class_'];
$class_type = $_POST['class-type'];
$department = $_POST['department'];
$occupation = $_POST['occupation'];
$time_of_class = $_POST['time_of_class'];
$monthly_discount = $_POST['monthly_discount'];

// $image_name = isset($_FILES['image']) ? $_FILES['image']['name'] : "no image accessed";

if ($_FILES['image']['name'] == '') {

    $conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection Failed");

    $sql = "UPDATE students SET student_name = '{$student_name}', gender_g = '{$gender}', disability = '{$disability}', father_name = '{$father_name}', sir_name = '{$cast}', date_of_birth = '{$date_of_birth}', date_of_admission = '{$date_of_admission}', monthly_fees = '{$monthly_fees}', complete_address = '{$address}', CNIC = '{$cnic}', contact_office = '{$office_mobile_number}', contact_home = '{$mobile_number_home}', qualification = '{$qualification}', last_school_name = '{$last_school_name}', last_school_address = '{$last_school_address}', reason_for_leave_school = '{$reason_to_leave_school}', class = '{$class}', department = '{$department}', occupation = '{$occupation}', time_for_study = '{$time_of_class}', discount = '{$monthly_discount}', class_type='{$class_type}' WHERE GR_no = {$gr_number}";

    if (mysqli_query($conn, $sql)) {
        echo 1;
    } else {
        echo mysqli_error($conn);
    }
} else {
    $image_name = $_FILES['image']['name'];
    // Rename image name and store image in server folder
    $image_ext = pathinfo($image_name, PATHINFO_EXTENSION); //file extention
    $image_name = pathinfo($image_name, PATHINFO_FILENAME);
    $image_name = $gr_number . "." . $image_ext; //name placed with gr no

    $path = "C:/xampp/htdocs/pos/img/profile/" . $image_name;

    $conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection Failed");

    $sql = "UPDATE students SET student_name = '{$student_name}', gender_g = '{$gender}', disability = '{$disability}', father_name = '{$father_name}', sir_name = '{$cast}', date_of_birth = '{$date_of_birth}', date_of_admission = '{$date_of_admission}', monthly_fees = '{$monthly_fees}', complete_address = '{$address}', CNIC = '{$cnic}', contact_office = '{$office_mobile_number}', contact_home = '{$mobile_number_home}', qualification = '{$qualification}', last_school_name = '{$last_school_name}', last_school_address = '{$last_school_address}', reason_for_leave_school = '{$reason_to_leave_school}', class = '{$class}', department = '{$department}', occupation = '{$occupation}', time_for_study = '{$time_of_class}', image_name = '{$image_name}', discount = '{$monthly_discount}', class_type='{$class_type}' WHERE GR_no = {$gr_number}";

    if (mysqli_query($conn, $sql)) {
        move_uploaded_file($_FILES['image']['tmp_name'], $path);
        echo 1;
    } else {
        echo mysqli_error($conn);
    }
}
