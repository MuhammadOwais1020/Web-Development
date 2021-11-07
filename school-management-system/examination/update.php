<?php
//Database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "madrassa";

$id = $_POST['id'];
$exam_number = $_POST['exam_number'];
$date_of_exam = $_POST['date_of_exam'];
$teacher_name = $_POST['exam_teacher_name_'];
$performance = $_POST['performance'];
$total_class = $_POST['total_class'];
$student_percent = $_POST['student_percent'];
$student_absent = $_POST['student_absent'];
$percent = $_POST['percent'];
$quran_total = $_POST['quran_total'];
$quran_get = $_POST['quran_get'];
$emaniat_total = $_POST['emaniat_total'];
$emaniat_get = $_POST['emaniat_get'];
$hadees_total = $_POST['hadees_total'];
$hadees_get = $_POST['hadees_get'];
$ikhlaq_total = $_POST['ikhlaq_total'];
$ikhlaq_get = $_POST['ikhlaq_get_'];
$language_total = $_POST['language_total'];
$language_get = $_POST['language_get'];
$namaz_total = $_POST['namaz_total'];
$namaz_get = $_POST['namaz_get'];
$attend_total = $_POST['attend_total'];
$attend_get = $_POST['attend_get'];
$hasil = intval($quran_total) + intval($emaniat_total) + intval($hadees_total) + intval($ikhlaq_total) + intval($language_total) + intval($namaz_total) + intval($attend_total);
$kul_num = intval($quran_get) + intval($emaniat_get) + intval($hadees_get) + intval($ikhlaq_get) + intval($language_get) + intval($namaz_get) + intval($attend_get);
$per = $kul_num * 100 / $hasil;
if ($per > 79) {
    $grade = "ممتاز";
} else if ($per > 69) {
    $grade = "جیدجدا";
} else if ($per > 59) {
    $grade = "جید";
} else if ($per > 49) {
    $grade = "مقبول";
} else {
    $grade = "راسب";
}

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection Failed");

$sql = "UPDATE examination SET exam_number = '{$exam_number}', date_of_exam = '{$date_of_exam}', teacher_name = '{$teacher_name}', performance = '{$performance}', quran_total = '{$quran_total}', quran_get = '{$quran_get}', emaniat_total = '{$emaniat_total}', emaniat_get = '{$emaniat_get}', hadees_total = '{$hadees_total}', hadees_get = '{$hadees_get}', ikhlaq_total = '{$ikhlaq_total}', ikhlaq_get = '{$ikhlaq_get}', lang_total = '{$language_total}', lang_get = '{$language_get}', namaz_total = '{$namaz_total}', namaz_get = '{$namaz_get}', attend_total = '{$attend_total}', attend_get = '{$attend_get}', total_class = '{$total_class}', student_percent = '{$student_percent}', student_absent = '{$student_absent}', percent = '{$per}', student_percent = '{$student_percent}' WHERE id = {$id}";

if (mysqli_query($conn, $sql)) {
    echo 1;
} else {
    echo mysqli_error($conn);
}
