<?php
//Database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "madrassa";

$gr_number = $_POST['gr'];
$teacher_name = $_POST['s_name'];
$gender = $_POST['gender'];
$father_name = $_POST['father_name'];
$cast = $_POST['cast'];
$date_of_birth = $_POST['date_of_birth'];
$date_of_admission  = $_POST['date_of_admission'];
$monthly_fees = $_POST['monthly_fees'];
$designation = $_POST['designation'];
$address = $_POST['address'];
$cnic = $_POST['cnic'];
$mobile_number = $_POST['mobile_number'];
$qualification = $_POST['qualification'];

if ($_FILES['image']['name'] == '') {
    $conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection Failed");

    $sql = "UPDATE teachers SET teacher_name = '{$teacher_name}', gender_g = '{$gender}', father_name = '{$father_name}', sir_name = '{$cast}', date_of_birth = '{$date_of_birth}', date_of_admission = '{$date_of_admission}', monthly_salary = '{$monthly_fees}', designation = '{$designation}', complete_address = '{$address}', CNIC = '{$cnic}', contact = '{$mobile_number}', qualification = '{$qualification}' WHERE GR_no = {$gr_number}";

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

    $path = "C:/xampp/htdocs/pos/img/profile-teacher/" . $image_name;

    $conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection Failed");

    $sql = "UPDATE teachers SET teacher_name = '{$teacher_name}', gender_g = '{$gender}', father_name = '{$father_name}', sir_name = '{$cast}', date_of_birth = '{$date_of_birth}', date_of_admission = '{$date_of_admission}', monthly_salary = '{$monthly_fees}', designation = '{$designation}', complete_address = '{$address}', CNIC = '{$cnic}', contact = '{$mobile_number}', qualification = '{$qualification}' WHERE GR_no = {$gr_number}";

    if (mysqli_query($conn, $sql)) {
        move_uploaded_file($_FILES['image']['tmp_name'], $path);
        echo 1;
    } else {
        echo mysqli_error($conn);
    }
}
