<?php
//Database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "madrassa";

$output = "";

$conn = mysqli_connect("localhost", "root", "", "madrassa") or die("Connection Failed");

$sql = "SELECT * FROM examination INNER JOIN students ON students.GR_no = examination.GR_no WHERE examination.id = " . $_POST['id'];
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $gr_no = $row['GR_no'];
        $exam_number = $row['exam_number'];
        $student_name = $row['student_name'];
        $father_name = $row['father_name'];
        $date_of_exam  = $row['date_of_exam'];
        $department = $row['department'];
        $class = $row['class'];
        $exam_teacher_name = $row['teacher_name'];
        $performance = $row['performance'];
        $total_class = $row['total_class'];
        $student_present = $row['student_percent'];
        $student_absent = $row['student_absent'];
        $percent = $row['percent'];
        $quran_total = $row['quran_total'];
        $quran_get = $row['quran_get'];
        $emaniat_total = $row['emaniat_total'];
        $emaniat_get = $row['emaniat_get'];
        $hadees_total = $row['hadees_total'];
        $hadees_get = $row['hadees_get'];
        $ikhlaq_total = $row['ikhlaq_total'];
        $ikhlaq_get = $row['ikhlaq_get'];
        $language_total = $row['lang_total'];
        $language_get = $row['lang_get'];
        $namaz_total = $row['namaz_total'];
        $namaz_get = $row['namaz_get'];
        $attend_total = $row['attend_total'];
        $attend_get = $row['attend_get'];
        $image_name = $row['image_name'];
    }
    $hasil = intval($quran_total) + intval($emaniat_total) + intval($hadees_total) + intval($ikhlaq_total) + intval($language_total) + intval($namaz_total) + intval($attend_total);
    $kul_num = intval($quran_get) + intval($emaniat_get) + intval($hadees_get) + intval($ikhlaq_get) + intval($language_get) + intval($namaz_get) + intval($attend_get);
    $per = $kul_num * 100 / $hasil;
    if ($per > 79) {
        $grade = "??????????";
    } else if ($per > 69) {
        $grade = "????????????";
    } else if ($per > 59) {
        $grade = "??????";
    } else if ($per > 49) {
        $grade = "??????????";
    } else {
        $grade = "????????";
    }
    echo '<div id="data-to-show">';
    echo '<div class="right">';
    echo '<input style="display:none" type="text" id="exam-id" value="' . $id . '">';
    echo '<p><span class="space_infont"> ?????????? ?????????? ???????? :</span>' . $gr_no . '</span></p>';
    echo '<p><span class="space_infont"> ???????? ?????? / ?????????? :</span>' . $student_name . '</p>';
    echo '<p><span class="space_infont"> ??????????  :</span>' . $father_name . '</p>';
    echo '<p><span class="space_infont"> ???????????? ?????? ????????:</span>' . $exam_number . '</p>';
    echo '<p><span class="space_infont"> ?????????? :</span>' . $date_of_exam . '</p>';
    echo '<p><span class="space_infont"> ???????? :</span>' . $department . '</p>';
    echo '<p><span class="space_infont"> ???????????? ???????? ?????? :</span>' . $class . '</p>';
    echo '<p><span class="space_infont"> ?????? ??????????/ ?????????? :</span>' . $exam_teacher_name . '</p>';
    echo '<p><span class="space_infont"> ???????? ?????????? :</span>' . $performance . '</p>';
    echo '<p><span class="space_infont"> ???????? ?????????????? :</span>' . $grade . '</p>';
    echo '<p><span class="space_infont"> ???? ???????? ?????????? :</span>' . $total_class . '</p>';
    echo '<p><span class="space_infont"> ???? ?????????????? :</span>' . $student_present . '</p>';
    echo '<p><span class="space_infont"> ???? ?????? ?????????????? :</span>' . $student_absent . '</p>';
    echo '<p><span class="space_infont"> ???????? :</span>' . $percent . '</p>';

    echo '</div>';
    echo '<div style="margin-left:370px" class="image" id="imageP">';
    echo '<img src="http://localhost/pos/img/profile/' . $image_name . '" alt="????????" class="image-preview__image">';
    echo '</div>';
    echo '<div class="left">';

    echo '<table style="font-size: 20px; border:2px">';
    echo '<tr>';
    echo '<th style="text-align:center; width:200px; background-color: grey; color: white;">???????? ???????? ????????</th>';
    echo '<th style="text-align:center; width:200px; background-color: grey; color: white;">???? ????????</th>';
    echo '<th style="text-align:center; width:400px; background-color: grey; color: white;">????????????</th>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>' . $quran_total . '</td>';
    echo '<td>' . $quran_get . '</td>';
    echo '<td>: ?????????? ????????/ ???????????? ?????????? </td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>' . $emaniat_total . '</td>';
    echo '<td>' . $emaniat_get . '</td>';
    echo '<td>: ???????????????? ?????????????? </td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>' . $hadees_total . '</td>';
    echo '<td>' . $hadees_get . '</td>';
    echo '<td>: ???????????? ???????????? ???????????? </td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>' . $ikhlaq_total . '</td>';
    echo '<td>' . $ikhlaq_get . '</td>';
    echo '<td>: ???????? ???????????? ?????????????? </td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>' . $language_total . '</td>';
    echo '<td>' . $language_get . '</td>';
    echo '<td>: ???????? (?????????? ????????) </td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>' . $namaz_total . '</td>';
    echo '<td>' . $namaz_get . '</td>';
    echo '<td>: ???????? ???? ?????????? </td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>' . $attend_total . '</td>';
    echo '<td>' . $attend_get . '</td>';
    echo '<td>: ???????? ?????? ?????????? ???? ?????????? </td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td class="table_grey">' . $hasil . '</td>';
    echo '<td class="table_grey">' . $kul_num . '</td>';
    echo '<td class="table_grey">: ???? ?????????? </td>';
    echo '</tr>';
    echo '</table>';
    echo '</div>';
    echo '</div>';

    mysqli_close($conn);
} else {
    echo '<h2>No Record Found.</h2>';
}

// He