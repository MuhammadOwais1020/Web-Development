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
    <title>طالب علم پروفائل</title>
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
            <p>طالب علم / طالبہ</p>
        </div>
        <div style="padding: 10px; font-size:16px;">
            <br>

            <div class="alert-message" id="success-message">
                <div class="alert alert-success">
                    <strong>کامیابی</strong>! ڈیٹا حزف ہو گیا ہے۔ شکریہ
                </div>
            </div>
            <div class="alert-message" id="error-message">
                <div class="alert alert-danger">
                    <strong>غلطی</strong>! مہربانی کر کہ دوباراہ کوشیش کریں۔ شکریہ
                </div>
            </div>
        </div>
        <?php
        $kul_num = intval($quran_total) + intval($emaniat_total) + intval($hadees_total) + intval($ikhlaq_total) + intval($language_total) + intval($namaz_total) + intval($attend_total);
        $hasil = intval($quran_get) + intval($emaniat_get) + intval($hadees_get) + intval($ikhlaq_get) + intval($language_get) + intval($namaz_get) + intval($attend_get);
        $per = $hasil * 100 / $kul_num;
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

        if ($gr_no != 0) {
            echo '<div id="data-to-show">';
            echo '<div class="right">';
            echo '<input style="display:none" type="text" id="exam-id" value="' . $id . '">';
            echo '<p><span class="space_infont"> مسلسل رجسٹر نمبر :</span>' . $gr_no . '</span></p>';
            echo '<p><span class="space_infont"> طالب علم / طالبہ :</span>' . $student_name . '</p>';
            echo '<p><span class="space_infont"> ولدیت  :</span>' . $father_name . '</p>';
            echo '<p><span class="space_infont"> امتھان رول نمبر:</span>' . $exam_number . '</p>';
            echo '<p><span class="space_infont"> تاریخ :</span>' . $date_of_exam . '</p>';
            echo '<p><span class="space_infont"> شعبہ :</span>' . $department . '</p>';
            echo '<p><span class="space_infont"> تربیتی نصاب حصہ :</span>' . $class . ' - ' . $class_type . '</p>';
            echo '<p><span class="space_infont"> نام معالم/ معلمہ :</span>' . $exam_teacher_name . '</p>';
            echo '<p><span class="space_infont"> عملی کیفیت :</span>' . $performance . '</p>';
            echo '<p><span class="space_infont"> درجہ کامیابی :</span>' . $grade . '</p>';
            echo '<p><span class="space_infont"> کل ایام تعلیم :</span>' . $total_class . '</p>';
            echo '<p><span class="space_infont"> کل حاضریاں :</span>' . $student_present . '</p>';
            echo '<p><span class="space_infont"> کل غیر حاضریاں :</span>' . $student_absent . '</p>';
            echo '<p><span class="space_infont"> فیصد :</span>' . $percent . '</p>';

            echo '</div>';
            echo '<div style="margin-left:370px" class="image" id="imageP">';
            echo '<img src="http://localhost/pos/img/profile/' . $image_name . '" alt="فوٹو" class="image-preview__image">';
            echo '</div>';
            echo '<div class="left">';
            echo '<table style="font-size: 20px; border:2px">';
            echo '<tr>';
            echo '<th style="text-align:center; width:200px; background-color: grey; color: white;">حاصل کردہ نمبر</th>';
            echo '<th style="text-align:center; width:200px; background-color: grey; color: white;">کل نمبر</th>';
            echo '<th style="text-align:center; width:400px; background-color: grey; color: white;">مضامین</th>';
            echo '</tr>';
            echo '<tr>';
            echo '<td>' . $quran_get . '</td>';
            echo '<td>' . $quran_total . '</td>';
            echo '<td>: قرآن کریم/ نورانی قاعدہ </td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td>' . $emaniat_get . '</td>';
            echo '<td>' . $emaniat_total . '</td>';
            echo '<td>: ایمانیات وعبادات </td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td>' . $hadees_get . '</td>';
            echo '<td>' . $hadees_total . '</td>';
            echo '<td>: احادیث ومسنون دعاھین </td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td>' . $ikhlaq_get . '</td>';
            echo '<td>' . $ikhlaq_total . '</td>';
            echo '<td>: سیرت واخلاق وعبادات </td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td>' . $language_get . '</td>';
            echo '<td>' . $language_total . '</td>';
            echo '<td>: زبان (عربی، اردو) </td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td>' . $namaz_get . '</td>';
            echo '<td>' . $namaz_total . '</td>';
            echo '<td>: نماز کی ڈاںری </td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td>' . $attend_get . '</td>';
            echo '<td>' . $attend_total . '</td>';
            echo '<td>: طالب علم طالبہ کی حاضری </td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td class="table_grey">' . $hasil . '</td>';
            echo '<td class="table_grey">' . $kul_num . '</td>';
            echo '<td class="table_grey">: کل میزان </td>';
            echo '</tr>';
            echo '</table>';
            echo '</div>';
            echo '</div>';
        } else {
            echo '<div class="alert alert-danger">';
            echo '<strong>غلطی</strong>! یہ ڈیٹا حزف ہو چوکا ہے۔ شکریہ';
            echo '</div>';
        }

        echo '<div id="data-updated">';
        echo '';
        echo '<div class="right">';
        echo '<div class="text-align-center">';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* امتھان رول نمبر</b><br />';
        echo '<input type="numeric" id="exam-number" name="exam-number" title="امتھان رول نمبر" value="' . $exam_number . '" required>';
        echo '</label>';
        echo '';
        echo '</div>';
        //echo '<br class="b-r"><br class="b-r"><br class="b-r"><br class="b-r"><br class="b-r"><br class="b-r"><br class="b-r"><br class="b-r"><br class="b-r"><br class="b-r"><br class="b-r"> <br>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b> * مسلسل رجسٹر نمبر</b><br />';
        echo '<input class="gr_num" type="numeric" id="gr-number" name="gr-number" title="مسلسل رجسٹرنمبر" value="' . $gr_no . '" readonly>';
        echo '</label>';
        echo '';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* تاریخ</b><br>';
        echo '<input type="text" id="date-of-exam" title="تاریخ" value="' . $date_of_exam . '" required="">';
        echo '</label>';
        echo '';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* نام معالم/ معلمہ</b><br>';
        echo '<input type="text" id="teacher-name" title="نام معالم/ معلمہ" value="' . $exam_teacher_name . '" required="" />';
        echo '</label>';
        echo '';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* عملی کیفیت</b><br>';
        echo '<select name="performance" id="performance" class="selection" id="" title="عملی کیفیت" required="" required>';
        echo '<option value="' . $performance . '" disabled></option>';
        echo '<option value="بہتر">بہتر</option>';
        echo '<option value="مناسب">مناسب</option>';
        echo '<option value="قابل توجہ">قابل توجہ</option>';
        echo '</select>';
        echo '</label>';
        echo '';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* کل ایام تعلیم</b><br>';
        echo '<input type="numeric" name="total-class" id="total-class"  title="کل ایام تعلیم" value="' . $total_class . '" readonly style="background-color:grey; color:white;" required="" />';
        echo '</label>';
        echo '';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* کل حاضریاں</b><br>';
        echo '<input type="numeric" name="student-percent" id="student-percent"  title="کل حاضریاں" value="' . $student_present . '" readonly style="background-color:grey; color:white;" required="" />';
        echo '</label>';
        echo '';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* کل غیر حاضریاں</b><br>';
        echo '<input readonly type="numeric" name="student-absent" id="student-absent" title="کل غیر حاضریاں" value=' . $student_absent . ' readonly style="background-color:grey; color:white;" required="" />';
        echo '</label>';
        echo '';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* فیصد</b><br>';
        echo '<input readonly type="numeric" name="percent" id="percent" title="فیصد" value=' . $percent . ' readonly style="background-color:grey; color:white;" required="" />';
        echo '</label>';
        echo '';
        echo '</div>';
        echo '</div>';
        echo '<input type="submit" id="outter-btn" class="update-form-data" id="admission-form-submit" value="ڈیٹا کو صیو کریں" title="ڈیٹا کو صیو کریں">';
        echo '</div>';
        echo '';
        echo '<div class="left">';
        echo '<div class="text-align-center">';
        echo '<h1 style="text-align:center; background-color:grey; border-radius:4px; color:white">مضامین</h1>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<h3 style="color:green">:قرآن کریم/ نورانی قاعدہ</h3><br>';
        echo '<label for="">';
        echo '<input style="width:100px" type="numeric" id="quran-get" name="quran-get" title="حاصل کردہ نمبر" value="' . $quran_get . '" required="" />';
        echo '<b>کل نمبر</b>';
        echo '<input style="width:100px" type="numeric" id="quran-total" name="quran-total" title="کل نمبر" value="' . $quran_total . '" required="" />';
        echo '<b>حاصل کردہ نمبر</b>';
        echo '</label>';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<h3 style="color:green">:ایمانیات وعبادات</h3><br>';
        echo '<label for="">';
        echo '<input style="width:100px" type="numeric" id="emaniat-get" name="emaniat-get" title="حاصل کردہ نمبر" value="' . $emaniat_get . '" required="" />';
        echo '<b>کل نمبر</b>';
        echo '<input style="width:100px" type="numeric" id="emaniat-total" name="emaniat-total" title="کل نمبر" value="' . $emaniat_total . '" required="" />';
        echo '<b>حاصل کردہ نمبر</b>';
        echo '</label>';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<h3 style="color:green">:احادیث ومسنون دعاھین</h3><br>';
        echo '<label for="">';
        echo '<input style="width:100px" type="numeric" id="hadees-get" name="hadees-get" title="حاصل کردہ نمبر" value="' . $hadees_get . '" required="" />';
        echo '<b>کل نمبر</b>';
        echo '<input style="width:100px" type="numeric" id="hadees-total" name="hadees-total" title="کل نمبر" value="' . $hadees_total . '" required="" />';
        echo '<b>حاصل کردہ نمبر</b>';
        echo '</label>';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<h3 style="color:green">:سیرت واخلاق وعبادات</h3><br>';
        echo '<label for="">';
        echo '<input style="width:100px" type="numeric" id="ikhlaq-get" name="ikhlaq-get" title="حاصل کردہ نمبر"  value="' . $ikhlaq_get . '" required="" />';
        echo '<b>کل نمبر</b>';
        echo '<input style="width:100px" type="numeric" id="ikhlaq-total" name="ikhlaq-total" title="کل نمبر" value="' . $ikhlaq_total . '" required="" />';
        echo '<b>حاصل کردہ نمبر</b>';
        echo '</label>';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<h3 style="color:green">:زبان (عربی، اردو)</h3><br>';
        echo '<label for="">';
        echo '<input style="width:100px" type="numeric" id="language-get" name="language-get" title="حاصل کردہ نمبر" value="' . $language_get . '" required="" />';
        echo '<b>کل نمبر</b>';
        echo '<input style="width:100px" type="numeric" id="language-total" name="language-total" title="کل نمبر" value="' . $language_total . '" required="" />';
        echo '<b>حاصل کردہ نمبر</b>';
        echo '</label>';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<h3 style="color:green">:نماز کی ڈاںری</h3><br>';
        echo '<label for="">';
        echo '<input style="width:100px" type="numeric" id="namaz-get" name="namaz-get" title="حاصل کردہ نمبر" value="' . $namaz_get . '" required="" />';
        echo '<b>کل نمبر</b>';
        echo '<input style="width:100px" type="numeric" id="namaz-total" name="namaz-total" title="کل نمبر"  value="' . $namaz_total . '" required="" />';
        echo '<b>حاصل کردہ نمبر</b>';
        echo '</label>';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<h3 style="color:green">:طالب علم طالبہ کی حاضری</h3><br>';
        echo '<label for="">';
        echo '<input style="width:100px; background-color:grey; color:white;" type="numeric" id="attend-get" name="attend-get" title="حاصل کردہ نمبر" value="' . $attend_get . '" readonly required="" />';
        echo '<b>کل نمبر</b>';
        echo '<input style="width:100px; background-color:grey; color:white;" type="numeric" id="attend-total" name="attend-total" title="کل نمبر" value="' . $attend_total . '" readonly  required="" />';
        echo '<b>حاصل کردہ نمبر</b>';
        echo '</label>';
        echo '</div>';
        echo '';
        echo '<input type="submit" id="inner-btn" name="admission-form-submit" class="update-form-data" value="ڈیٹا کو صیو کریں" title="ڈیٹا کو صیو کریں">';
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
                <input type="submit" name="print" value="پرینٹ کرو" class="btn btn-primary" id="print-info">
            </form>

            <input type="submit" name="delete" value="حزف کرو" class="btn btn-danger" id="delete-info">

            <input type="submit" name="update" value="ترمیم کرو" class="btn btn-success" id="update-info">
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
                if (confirm("کیا آپ واقع حزف کرنا چاہتے ہیں؟")) {
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