<?php
$roll_number = 0;
$GR_no = 0;
$student_name = "";
$class = "";
$class_section = "";
$sql = "";
if (isset($_POST['filter-data'])) {
    $class = $_POST['class'];
    $class_section = $_POST['class-type'];

    $sql = "SELECT r.GR_no, r.roll_no, s.student_name, s.class, s.class_type, s.department FROM students s JOIN roll_number r WHERE s.GR_no = r.GR_no AND (s.class = '" . $class . "' AND s.class_type = '" . $class_section . "') GROUP BY r.roll_no ASC";
} else {
    $sql = "SELECT r.GR_no, r.roll_no, s.student_name, s.class, s.class_type, s.department FROM students s JOIN roll_number r WHERE s.GR_no = r.GR_no GROUP BY r.roll_no ASC";
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
            <p>رول نمبر طلباءکرام</p>
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
                <input type="submit" name="filter-data" value=" تلاش کرو" class="btn btn-success">
                <input type="submit" name="refresh" value="تازہ " class="btn btn-success">
            </form>
        </div>
        <hr>
        <!-- <div class="details">
            there are ?? students, male, female
        </div> -->
        <!-- <hr> -->
        <div class="data-show">
            <?php
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
                    echo '<td class="head">شعبہ</td>';
                    echo '<td class="head">سیکشن</td>';
                    echo '<td class="head">مطلوبہ درجہ</td>';
                    echo '<td class="head">نام طالب علم</td>';
                    echo '<td class="head">مسلسل رجسٹرنمبر</td>';
                    echo '<td class="head">رول نمبر</td>';
                    echo '</tr>';
                    $i = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo '<form action="student-profile.php" method="post">';
                        echo '<tr>';
                        echo '<td style="display:none;"><input type="text" name="gr-id" value="' . $row['GR_no'] . '" style="display:none;"></td>';
                        echo '<td class="data"><button class="btn btn-info">تفصیل</button></td>';
                        echo '<td class="data">' . $row['department'] . '</td>';
                        echo '<td class="data">' . $row['class_type'] . '</td>';
                        echo '<td class="data">' . $row['class'] . '</td>';
                        echo '<td class="data">' . $row['student_name'] . '</td>';
                        echo '<td class="data">' . $row['GR_no'] . '</td>';
                        echo '<td class="data">' . $row['roll_no'] . '</td>';
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
                    echo '<strong>معاف کیجیےگا</strong>! اس طرح کا دیٹا مجود نہیں ہے۔ شکریہ۔';
                    echo '</div>';
                    echo '</div>';
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