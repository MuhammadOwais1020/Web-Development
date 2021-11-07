<?php
$sql = "";
if (isset($_POST['filter-data'])) {
    $gr_number = $_POST['gr-number'];
    $designation = $_POST['designation'];
    $teacher_name = $_POST['teacher-name'];

    if ($gr_number != "") {
        $sql = "SELECT GR_no, teacher_name, father_name, designation, qualification, contact FROM teachers WHERE GR_no = " . $gr_number;
    } elseif ($designation != "" and $teacher_name == "") {
        $sql = "SELECT GR_no, teacher_name, father_name, designation, qualification, contact FROM teachers WHERE designation = '" . $designation . "'";
    } elseif ($designation == "" and $teacher_name != "") {
        $sql = "SELECT GR_no, teacher_name, father_name, designation, qualification, contact FROM teachers WHERE teacher_name = '" . $teacher_name . "'";
    } else {
        $sql = "SELECT GR_no, teacher_name, father_name, designation, qualification, contact FROM teachers WHERE designation = '" . $designation . "' AND teacher_name = '" . $teacher_name . "'";
    }
} else {
    $sql = "SELECT GR_no, teacher_name, father_name, designation, qualification, contact FROM teachers";
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
            <p>فہرست معلمین و ملازمین</p>
        </div>
        <div class="data-filter">
            <form action="" method="post">
                <input type="numeric" class="short-input" name="gr-number" placeholder="مسلسل رجسٹرنمبر">
                <input type="text" class="short-input" name="teacher-name" placeholder="ناظم / ناظمہ نام">
                <input type="text" class="short-input" name="designation" placeholder="عہدہ">
                <input type="submit" name="filter-data" value="تلاش کرو" class="btn btn-success">
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
                    echo '<td class="head">موبائل نمبر</td>';
                    echo '<td class="head">تعلیمی قابلیت</td>';
                    echo '<td class="head">عہدہ</td>';
                    echo '<td class="head">ولدیت</td>';
                    echo '<td class="head">نام ناظم / ناظمہ</td>';
                    echo '<td class="head">مسلسل رجسٹرنمبر</td>';
                    echo '<td class="head">شمار</td>';
                    echo '</tr>';
                    $i = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo '<form action="teacher-profile.php" method="post" target="blank_">';
                        echo '<tr>';
                        echo '<td style="display:none;"><input type="text" name="gr-id" value="' . $row['GR_no'] . '" style="display:none;"></td>';
                        echo '<td class="data"><button class="btn btn-info">تفصیل</button></td>';
                        echo '<td class="data">' . $row['contact'] . '</td>';
                        echo '<td class="data">' . $row['qualification'] . '</td>';
                        echo '<td class="data">' . $row['designation'] . '</td>';
                        echo '<td class="data">' . $row['father_name'] . '</td>';
                        echo '<td class="data">' . $row['teacher_name'] . '</td>';
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