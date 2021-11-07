<?php
$class = "";
$class_section = "";
$exam_date = "";

$sql = "";

if (isset($_POST['filter-data'])) {
    $class = $_POST['class'];
    $class_section = $_POST['class-type'];
    $exam_date = $_POST['exam-date'];

    $sql = "SELECT * FROM examination e JOIN students s WHERE (e.GR_no = s.GR_no AND e.date_of_exam = '" . $exam_date . "') AND (s.class = '" . $class . "' AND s.class_type = '" . $class_section . "') GROUP BY e.percent DESC";
}

?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>مدرسہ نفائس القرآن الکریم</title>
    <?php
    include('C:\xampp\htdocs\pos\assets\header.php');
    ?>
    <style>
        @font-face {
            font-family: urdu;
            src: url(JameelNooriNastaleeq.ttf);
        }

        body,
        p {
            font-family: urdu !important;
        }

        .selection,
        #exam-date {
            width: 300px;
        }

        form {
            display: inline;
        }
    </style>
</head>

<body style="background-color: rgba(233, 229, 229, 0.938);" window.load()>
    <!-- navigation -->
    <?php
    include('C:\xampp\htdocs\pos\assets\nav-bar.php');
    ?>
    <!-- //navigation -->

    <!-- Container -->
    <div class="outer-container">
        <div class="heading">
            <p>نتیجہ امتحان پرینٹ</p>
        </div>
        <div class="data-filter">
            <form action="" method="post">
                <select name="class-type" class="selection" id="" title="سیکشن" required="" required>
                    <option value="الف">الف</option>
                    <option value="ب">ب</option>
                    <option value="ج">ج</option>
                    <option value="د">د</option>
                </select>
                <select name="class" class="selection" id="" title="مطلوبہ درجہ" required="" required>
                    <option value="ابتدائیہ">ابتدائیہ</option>
                    <option value="اول">اول</option>
                    <option value="دوم">دوم</option>
                    <option value="سوم">سوم</option>
                    <option value="چہارم">چہارم</option>
                    <option value="پنجم">پنجم</option>
                </select>
                <input type="date" name="exam-date" id="exam-date" title="امتحان تاریخ" require>
                <input type="submit" name="filter-data" value="تلاش کرو" class="btn btn-success">
                <input type="submit" name="refresh" value="تازہ" class="btn btn-success">
            </form>
            <?php
            if ($sql != "") {
                echo '<form action="print-exam-sheet.php" method="post" target="blank_">';
                echo '<input type="text" name="sql-query" value="' . $sql . '" style="display:none;">';
                echo '<input type="submit" name="print-kro" id="print-kro" value="پرینٹ" class="btn btn-info">';
                echo '</form>';
            }
            ?>
        </div>
        <hr>
        <!-- <div class="details">
            there are ?? students, male, female
        </div> -->
        <!-- <hr> -->
        <div class="data-show">
            <?php
            if ($sql != "") {
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
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        //    Table start
                        echo '<table class="all-students">';
                        echo '<tr>';
                        echo '<td class="head">پروفائل</td>';
                        echo '<td class="head">عملی کیفیت</td>';
                        echo '<td class="head">درجہ کامیابی</td>';
                        echo '<td class="head">فیصد</td>';
                        echo '<td class="head">نام طالب علم</td>';
                        echo '<td class="head">امتھان رول نمبر</td>';
                        echo '<td class="head">مسلسل رجسٹرنمبر</td>';
                        echo '<td class="head">شمار</td>';
                        echo '</tr>';
                        $i = 1;
                        while ($row = $result->fetch_assoc()) {
                            $per = $row['percent'];
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
                            echo '<form action="exam-profile.php" method="post">';
                            echo '<tr>';
                            echo '<td style="display:none;"><input type="text" name="exam-id" value="' . $row['id'] . '" style="display:none;"></td>';
                            echo '<td class="data"><button class="btn btn-info">تفصیل</button></td>';
                            echo '<td class="data">' . $row['performance'] . '</td>';
                            echo '<td class="data">' . $grade . '</td>';
                            echo '<td class="data">' . $row['percent'] . "%" . '</td>';
                            echo '<td class="data">' . $row['student_name'] . '</td>';
                            echo '<td class="data">' . $row['exam_number'] . '</td>';
                            echo '<td class="data">' . $row['GR_no'] . '</td>';
                            echo '<td class="data">' . $i . '</td>';
                            echo '</tr>';
                            echo '</form>';

                            $i++;
                        }
                        echo '</table>';
                        // Table end
                        echo '<br>';
                        $conn->close();
                    } else {
                        echo '<div class="alert-message">';
                        echo '<div class="alert alert-info" style="text-align: center; font-size:20px;">';
                        echo '<strong>معاف کیجیےگا</strong>! اس طرح کا دیٹا موجود نہیں ہے۔ شکریہ۔';
                        echo '</div>';
                        echo '</div>';
                    }
                }
            }
            ?>

        </div>
    </div>
    <!-- Container -->

    <!-- footer -->
    <?php
    include('C:\xampp\htdocs\pos\assets\footer.php');
    ?>

</body>

</html>