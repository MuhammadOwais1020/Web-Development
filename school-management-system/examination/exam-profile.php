<?php
$image_name = "";
$gr_no = 0;
$exam_number = 0;
$student_name = "";
$father_name = "";
$date_of_exam  = "";
$department = "";
$class = "";
$exam_teacher_name = "";
$performance = "";
$grade = "";
$total_class = 0;
$student_present = 0;
$student_absent = 0;
$percent = 0;
$quran_total = 0;
$quran_get = 0;
$emaniat_total = 0;
$emaniat_get = 0;
$hadees_total = 0;
$hadees_get = 0;
$ikhlaq_total = 0;
$ikhlaq_get = 0;
$language_total = 0;
$language_get = 0;
$namaz_total = 0;
$namaz_get = 0;
$attend_total = 0;
$attend_get = 0;
$id = 0;

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
    $sql = "SELECT * FROM examination INNER JOIN students ON students.GR_no = examination.GR_no WHERE examination.id = " . $_POST['exam-id'];
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
            $class_type = $row['class_type'];
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
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        @font-face {
            font-family: urdu;
            src: url(JameelNooriNastaleeq.ttf);
        }

        body {
            font-family: urdu !important;
        }

        p {
            font-family: urdu !important;
        }
    </style>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .space_infont {
            font-weight: 800;
            margin-left: 10px;
        }

        .table_set {
            text-align: center;
            width: 400px;
            background-color: grey;
            color: white;
        }

        .table_grey {
            background-color: grey;
            color: white;
        }

        .readonly {
            background-color: #e4e3e3;
            border: none;
            border-radius: 4px;
        }
    </style>
    <title>???????? ?????? ??????????????</title>
    <?php
    include('C:\xampp\htdocs\pos\assets\header.php');
    ?>
    <style>
        .container-pro-box {
            height: 800px;
        }
    </style>
</head>

<body style="background-color: rgba(233, 229, 229, 0.938);">
    <?php
    include('C:\xampp\htdocs\pos\assets\nav-bar.php');
    ?>
    <div class="container-pro-box">
        <div class="heading">
            <p>???????? ?????? / ??????????</p>
        </div>
        <div style="padding: 10px; font-size:16px;">
            <br>

            <div class="alert-message" id="success-message">
                <div class="alert alert-success">
                    <strong>??????????????</strong>! ???????? ?????? ???? ?????? ?????? ??????????
                </div>
            </div>
            <div class="alert-message" id="error-message">
                <div class="alert alert-danger">
                    <strong>????????</strong>! ?????????????? ???? ???? ?????????????? ?????????? ?????????? ??????????
                </div>
            </div>
        </div>
        <?php
        $kul_num = intval($quran_total) + intval($emaniat_total) + intval($hadees_total) + intval($ikhlaq_total) + intval($language_total) + intval($namaz_total) + intval($attend_total);
        $hasil = intval($quran_get) + intval($emaniat_get) + intval($hadees_get) + intval($ikhlaq_get) + intval($language_get) + intval($namaz_get) + intval($attend_get);
        $per = $hasil * 100 / $kul_num;
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

        if ($gr_no != 0) {
            echo '<div id="data-to-show">';
            echo '<div class="right">';
            echo '<input style="display:none" type="text" id="exam-id" value="' . $id . '">';
            echo '<p><span class="space_infont"> ?????????? ?????????? ???????? :</span>' . $gr_no . '</span></p>';
            echo '<p><span class="space_infont"> ???????? ?????? / ?????????? :</span>' . $student_name . '</p>';
            echo '<p><span class="space_infont"> ??????????  :</span>' . $father_name . '</p>';
            echo '<p><span class="space_infont"> ???????????? ?????? ????????:</span>' . $exam_number . '</p>';
            echo '<p><span class="space_infont"> ?????????? :</span>' . $date_of_exam . '</p>';
            echo '<p><span class="space_infont"> ???????? :</span>' . $department . '</p>';
            echo '<p><span class="space_infont"> ???????????? ???????? ?????? :</span>' . $class . ' - ' . $class_type . '</p>';
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
            echo '<td>' . $quran_get . '</td>';
            echo '<td>' . $quran_total . '</td>';
            echo '<td>: ?????????? ????????/ ???????????? ?????????? </td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td>' . $emaniat_get . '</td>';
            echo '<td>' . $emaniat_total . '</td>';
            echo '<td>: ???????????????? ?????????????? </td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td>' . $hadees_get . '</td>';
            echo '<td>' . $hadees_total . '</td>';
            echo '<td>: ???????????? ???????????? ???????????? </td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td>' . $ikhlaq_get . '</td>';
            echo '<td>' . $ikhlaq_total . '</td>';
            echo '<td>: ???????? ???????????? ?????????????? </td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td>' . $language_get . '</td>';
            echo '<td>' . $language_total . '</td>';
            echo '<td>: ???????? (?????????? ????????) </td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td>' . $namaz_get . '</td>';
            echo '<td>' . $namaz_total . '</td>';
            echo '<td>: ???????? ???? ?????????? </td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td>' . $attend_get . '</td>';
            echo '<td>' . $attend_total . '</td>';
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
        } else {
            echo '<div class="alert alert-danger">';
            echo '<strong>????????</strong>! ???? ???????? ?????? ???? ???????? ?????? ??????????';
            echo '</div>';
        }

        echo '<div id="data-updated">';
        echo '';
        echo '<div class="right">';
        echo '<div class="text-align-center">';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* ???????????? ?????? ????????</b><br />';
        echo '<input type="numeric" id="exam-number" name="exam-number" title="???????????? ?????? ????????" value="' . $exam_number . '" required>';
        echo '</label>';
        echo '';
        echo '</div>';
        //echo '<br class="b-r"><br class="b-r"><br class="b-r"><br class="b-r"><br class="b-r"><br class="b-r"><br class="b-r"><br class="b-r"><br class="b-r"><br class="b-r"><br class="b-r"> <br>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b> * ?????????? ?????????? ????????</b><br />';
        echo '<input class="gr_num" type="numeric" id="gr-number" name="gr-number" title="?????????? ??????????????????" value="' . $gr_no . '" readonly>';
        echo '</label>';
        echo '';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* ??????????</b><br>';
        echo '<input type="text" id="date-of-exam" title="??????????" value="' . $date_of_exam . '" required="">';
        echo '</label>';
        echo '';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* ?????? ??????????/ ??????????</b><br>';
        echo '<input type="text" id="teacher-name" title="?????? ??????????/ ??????????" value="' . $exam_teacher_name . '" required="" />';
        echo '</label>';
        echo '';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* ???????? ??????????</b><br>';
        echo '<select name="performance" id="performance" class="selection" id="" title="???????? ??????????" required="" required>';
        echo '<option value="' . $performance . '" disabled></option>';
        echo '<option value="????????">????????</option>';
        echo '<option value="??????????">??????????</option>';
        echo '<option value="???????? ????????">???????? ????????</option>';
        echo '</select>';
        echo '</label>';
        echo '';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* ???? ???????? ??????????</b><br>';
        echo '<input type="numeric" name="total-class" id="total-class"  title="???? ???????? ??????????" value="' . $total_class . '" readonly style="background-color:grey; color:white;" required="" />';
        echo '</label>';
        echo '';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* ???? ??????????????</b><br>';
        echo '<input type="numeric" name="student-percent" id="student-percent"  title="???? ??????????????" value="' . $student_present . '" readonly style="background-color:grey; color:white;" required="" />';
        echo '</label>';
        echo '';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* ???? ?????? ??????????????</b><br>';
        echo '<input readonly type="numeric" name="student-absent" id="student-absent" title="???? ?????? ??????????????" value=' . $student_absent . ' readonly style="background-color:grey; color:white;" required="" />';
        echo '</label>';
        echo '';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* ????????</b><br>';
        echo '<input readonly type="numeric" name="percent" id="percent" title="????????" value=' . $percent . ' readonly style="background-color:grey; color:white;" required="" />';
        echo '</label>';
        echo '';
        echo '</div>';
        echo '</div>';
        echo '<input type="submit" id="outter-btn" class="update-form-data" id="admission-form-submit" value="???????? ???? ?????? ????????" title="???????? ???? ?????? ????????">';
        echo '</div>';
        echo '';
        echo '<div class="left">';
        echo '<div class="text-align-center">';
        echo '<h1 style="text-align:center; background-color:grey; border-radius:4px; color:white">????????????</h1>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<h3 style="color:green">:?????????? ????????/ ???????????? ??????????</h3><br>';
        echo '<label for="">';
        echo '<input style="width:100px" type="numeric" id="quran-get" name="quran-get" title="???????? ???????? ????????" value="' . $quran_get . '" required="" />';
        echo '<b>???? ????????</b>';
        echo '<input style="width:100px" type="numeric" id="quran-total" name="quran-total" title="???? ????????" value="' . $quran_total . '" required="" />';
        echo '<b>???????? ???????? ????????</b>';
        echo '</label>';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<h3 style="color:green">:???????????????? ??????????????</h3><br>';
        echo '<label for="">';
        echo '<input style="width:100px" type="numeric" id="emaniat-get" name="emaniat-get" title="???????? ???????? ????????" value="' . $emaniat_get . '" required="" />';
        echo '<b>???? ????????</b>';
        echo '<input style="width:100px" type="numeric" id="emaniat-total" name="emaniat-total" title="???? ????????" value="' . $emaniat_total . '" required="" />';
        echo '<b>???????? ???????? ????????</b>';
        echo '</label>';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<h3 style="color:green">:???????????? ???????????? ????????????</h3><br>';
        echo '<label for="">';
        echo '<input style="width:100px" type="numeric" id="hadees-get" name="hadees-get" title="???????? ???????? ????????" value="' . $hadees_get . '" required="" />';
        echo '<b>???? ????????</b>';
        echo '<input style="width:100px" type="numeric" id="hadees-total" name="hadees-total" title="???? ????????" value="' . $hadees_total . '" required="" />';
        echo '<b>???????? ???????? ????????</b>';
        echo '</label>';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<h3 style="color:green">:???????? ???????????? ??????????????</h3><br>';
        echo '<label for="">';
        echo '<input style="width:100px" type="numeric" id="ikhlaq-get" name="ikhlaq-get" title="???????? ???????? ????????"  value="' . $ikhlaq_get . '" required="" />';
        echo '<b>???? ????????</b>';
        echo '<input style="width:100px" type="numeric" id="ikhlaq-total" name="ikhlaq-total" title="???? ????????" value="' . $ikhlaq_total . '" required="" />';
        echo '<b>???????? ???????? ????????</b>';
        echo '</label>';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<h3 style="color:green">:???????? (?????????? ????????)</h3><br>';
        echo '<label for="">';
        echo '<input style="width:100px" type="numeric" id="language-get" name="language-get" title="???????? ???????? ????????" value="' . $language_get . '" required="" />';
        echo '<b>???? ????????</b>';
        echo '<input style="width:100px" type="numeric" id="language-total" name="language-total" title="???? ????????" value="' . $language_total . '" required="" />';
        echo '<b>???????? ???????? ????????</b>';
        echo '</label>';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<h3 style="color:green">:???????? ???? ??????????</h3><br>';
        echo '<label for="">';
        echo '<input style="width:100px" type="numeric" id="namaz-get" name="namaz-get" title="???????? ???????? ????????" value="' . $namaz_get . '" required="" />';
        echo '<b>???? ????????</b>';
        echo '<input style="width:100px" type="numeric" id="namaz-total" name="namaz-total" title="???? ????????"  value="' . $namaz_total . '" required="" />';
        echo '<b>???????? ???????? ????????</b>';
        echo '</label>';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<h3 style="color:green">:???????? ?????? ?????????? ???? ??????????</h3><br>';
        echo '<label for="">';
        echo '<input style="width:100px; background-color:grey; color:white;" type="numeric" id="attend-get" name="attend-get" title="???????? ???????? ????????" value="' . $attend_get . '" readonly required="" />';
        echo '<b>???? ????????</b>';
        echo '<input style="width:100px; background-color:grey; color:white;" type="numeric" id="attend-total" name="attend-total" title="???? ????????" value="' . $attend_total . '" readonly  required="" />';
        echo '<b>???????? ???????? ????????</b>';
        echo '</label>';
        echo '</div>';
        echo '';
        echo '<input type="submit" id="inner-btn" name="admission-form-submit" class="update-form-data" value="???????? ???? ?????? ????????" title="???????? ???? ?????? ????????">';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        ?>


        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <br>
        <div style="margin-right:640px" class="data-modification">
            <form action="exam-form.php" method="post">
                <?php
                echo '<input type="text" name="id" id="gr-no" value="' . $id . '" style="display:none;">';
                ?>
                <input type="submit" name="print" value="?????????? ??????" class="btn btn-primary" id="print-info">
            </form>

            <input type="submit" name="delete" value="?????? ??????" class="btn btn-danger" id="delete-info">

            <input type="submit" name="update" value="?????????? ??????" class="btn btn-success" id="update-info">
        </div>
    </div>

    <?php
    include('C:\xampp\htdocs\pos\assets\footer.php');
    ?>

    <script>
        $(document).ready(function() {
            $('#student-percent').keyup(function() {
                var student_present = $('#student-percent').val();
                var total_class = $('#total-class').val();
                var percentage = student_present * 100 / total_class;
                $('#student-absent').val(total_class - student_present);
                $('#percent').val(percentage.toFixed(2));
            });
            // Delete record
            $("#delete-info").on("click", function(e) {
                if (confirm("?????? ?????? ???????? ?????? ???????? ?????????? ????????")) {
                    var id = $("#exam-id").val();

                    $.ajax({
                        url: "exam-delete.php",
                        type: "POST",
                        data: {
                            id: id
                        },
                        success: function(data) {
                            if (data == 1) {
                                $("#update-info, #delete-info, #print-info, .left, .right").fadeOut();
                                $("#success-message").fadeIn();
                                $("#error-message").fadeOut();
                            } else {
                                $("#error-message").fadeIn();
                                $("#message-message").fadeOut();
                            }
                        }
                    });
                }
            });

            // Show form 
            $("#update-info").on("click", function(e) {
                $("#data-updated").show();
                $("#data-to-show").hide();
                $(".data-modification").hide();
                $(".container-pro-box").css("height", "1200px");

            });
            // Hide form
            $(".update-form-data").on("click", function(e) {
                var id = $("#exam-id").val();
                var exam_number = $("#exam-number").val();
                var date_of_exam = $("#date-of-exam").val();
                var exam_teacher_name = $("#teacher-name").val();
                var performance = $("#performance").val();
                var total_class = $("#total-class").val();
                var student_percent = $("#student-percent").val();
                var student_absent = $("#student-absent").val();
                var percent = $("#percent").val();
                var quran_total = $("#quran-total").val();
                var quran_get = $("#quran-get").val();
                var emaniat_total = $("#emaniat-total").val();
                var emaniat_get = $("#emaniat-get").val();
                var hadees_total = $("#hadees-total").val();
                var hadees_get = $("#hadees-get").val();
                var ikhlaq_total = $("#ikhlaq-total").val();
                var ikhlaq_get = $("#ikhlaq-get").val();
                var language_total = $("#language-total").val();
                var language_get = $("#language-get").val();
                var namaz_total = $("#namaz-total").val();
                var namaz_get = $("#namaz-get").val();
                var attend_total = $("#attend-total").val();
                var attend_get = $("#attend-get").val();

                $.ajax({
                    url: "update.php",
                    type: "POST",
                    data: {
                        id: id,
                        exam_number: exam_number,
                        date_of_exam: date_of_exam,
                        exam_teacher_name_: exam_teacher_name,
                        performance: performance,
                        total_class: total_class,
                        student_percent: student_percent,
                        student_absent: student_absent,
                        percent: percent,
                        quran_total: quran_total,
                        quran_get: quran_get,
                        emaniat_total: emaniat_total,
                        emaniat_get: emaniat_get,
                        hadees_total: hadees_total,
                        hadees_get: hadees_get,
                        ikhlaq_total: ikhlaq_total,
                        ikhlaq_get_: ikhlaq_get,
                        language_total: language_total,
                        language_get: language_get,
                        namaz_total: namaz_total,
                        namaz_get: namaz_get,
                        attend_total: attend_total,
                        attend_get: attend_get
                    },
                    success: function(data) {
                        if (data == 1) {
                            $("#data-updated").hide();
                            $("#data-to-show").show();
                            $(".data-modification").show();
                            $(".container-pro-box").css("height", "700px");

                            loadData(); //Load data
                        } else {
                            alert(data);
                        }
                    }
                });


            });

            // Load data fucntion 
            function loadData() {
                var id = $("#exam-id").val();
                $.ajax({
                    url: "load-exam-data.php",
                    type: "POST",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        $("#data-to-show").html(data);
                    }
                });
            }

        });
    </script>
</body>

</html>