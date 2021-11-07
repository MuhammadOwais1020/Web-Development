<?php
$sql = "";
if (isset($_POST['filter-data'])) {
    $gr_number = $_POST['gr-number'];
    $class = $_POST['class-name'];
    $department = $_POST['department'];

    if ($gr_number != "") {
        // $sql = "SELECT * FROM examination WHERE GR_no = " . $gr_number;
        $sql = "SELECT * FROM examination INNER JOIN students ON students.GR_no = examination.GR_no where examination.GR_no = " . $gr_number;
    } elseif ($class != "" and $department == "") {
        $sql = "SELECT * FROM examination INNER JOIN students ON students.GR_no = examination.GR_no WHERE students.class = '" . $class . "'";
    } elseif ($class == "" and $department != "") {
        $sql = "SELECT * FROM examination INNER JOIN students ON students.GR_no = examination.GR_no WHERE students.department = '" . $department . "'";
    } else {
        $sql = "SELECT * FROM examination INNER JOIN students ON students.GR_no = examination.GR_no WHERE students.class = '" . $class . "' AND students.department = '" . $department . "'";
    }
} else {
    $sql = "SELECT * FROM examination INNER JOIN students ON students.GR_no = examination.GR_no";
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

        body {
            font-family: urdu !important;
        }

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
            <p>طالب علم / طالبہ</p>
        </div>
        <div class="data-filter">
            <form action="" method="post">
                <input type="numeric" class="short-input" name="gr-number" placeholder="مسلسل رجسٹرنمبر">
                <input type="text" class="short-input" name="class-name" placeholder="مطلوبہ درجہ">
                <input type="text" class="short-input" name="department" placeholder="شعبہ">
                <input type="submit" name="filter-data" value="تفصیل" class="btn btn-success">
                <input type="submit" name="refresh" value="تازہ" class="btn btn-success">
            </form>
        </div>
        <hr>
        <!-- <div class="details">
            there are ?? students, male, female
        </div> -->
        <!-- <hr> -->
        <div class="data-show">
            <?php
            $per = 0;
            $grade = "";
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