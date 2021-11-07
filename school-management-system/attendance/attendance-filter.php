<?php
$sql = "";
if (isset($_POST['filter-data'])) {
    $gr_number = $_POST['gr-number'];
    $class = $_POST['class-name'];
    $department = $_POST['department'];

    if ($gr_number != "") {
        $sql = "SELECT GR_no, student_name, gender_g, father_name, class, department, contact_office FROM students WHERE GR_no = " . $gr_number;
    } elseif ($class != "" and $department == "") {
        $sql = "SELECT GR_no, student_name, gender_g, father_name, class, department, contact_office FROM students WHERE class = '" . $class . "'";
    } elseif ($class == "" and $department != "") {
        $sql = "SELECT GR_no, student_name, gender_g, father_name, class, department, contact_office FROM students WHERE department = '" . $department . "'";
    } else {
        $sql = "SELECT GR_no, student_name, gender_g, father_name, class, department, contact_office FROM students WHERE class = '" . $class . "' AND department = '" . $department . "'";
    }
} else {
    $sql = "SELECT * FROM students";
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
    <style>
        .text_width {
            width: 160px !important;
        }

        .date_div {
            text-align: center;
            background-image: linear-gradient(50deg, #11998e, #39c76e);
            height: 50px;
            padding: 8px;
            border-radius: 5px;
            color: white;
        }

        .date_input {
            color: black;
            border: none;
            border-radius: 3px;
            width: 218px !important;
        }

        .apply-btn {
            border: none;
            padding: 7px 12px;
            margin-right: 20px;
            border-radius: 4px;
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
            <p>حاضری رجسٹر</p>
        </div>
        <div class="data-filter">
            <form action="" method="post">
                <input type="numeric" class="short-input text_width" name="gr-number" placeholder="مسلسل رجسٹرنمبر">
                <input type="text" class="short-input text_width" name="class-name" placeholder="مطلوبہ درجہ">
                <input type="text" class="short-input text_width" name="department" placeholder="شعبہ">
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
            <div class="date_div">
                <form action="attendance-details.php" method="post">
                    <input type="submit" name="apply-btn" class="btn-info apply-btn" value="Apply">
                    <input type="date" class="date_input" name="to" required>
                    <label style="margin-right:20px">اس تاریخ تک</label>
                    <input type="date" class="date_input" name="from" required>
                    <label style="margin-right:20px">اس تاریخ سے</label>
                    <input type="numeric" style="color:black" class="date_input" name="gr-id" placeholder="مسلسل رجسٹرنمبر" required>
                    <label style="margin-right:20px">مسلسل رجسٹر نمبر</label>
                </form>
            </div>
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
                    echo '<td class="head">مطلوبہ درجہ</td>';
                    echo '<td class="head">ولدیت</td>';
                    echo '<td class="head">نام طالب علم</td>';
                    echo '<td class="head">مسلسل رجسٹرنمبر</td>';
                    echo '<td class="head">شمار</td>';
                    echo '</tr>';
                    $i = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo '<form action="attendance-details.php" method="post">';
                        echo '<tr>';
                        echo '<td style="display:none;"><input type="text" name="gr-id" value="' . $row['GR_no'] . '" style="display:none;"></td>';
                        echo '<td style="display:none;"><input type="text" name="student_name" value="' . $row['student_name'] . '" style="display:none;"></td>';
                        echo '<td style="display:none;"><input type="text" name="father_name" value="' . $row['father_name'] . '" style="display:none;"></td>';

                        echo '<td class="data"><button class="btn btn-info">تفصیل</button></td>';
                        echo '<td class="data">' . $row['department'] . '</td>';
                        echo '<td class="data">' . $row['class'] . '</td>';
                        echo '<td class="data">' . $row['father_name'] . '</td>';
                        echo '<td class="data">' . $row['student_name'] . '</td>';
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