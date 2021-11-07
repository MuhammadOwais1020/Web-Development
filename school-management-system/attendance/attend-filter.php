<?php
if ($_POST['query'] != "no") {
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
        $sql = $_POST['query'];
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            //    Table start
            echo '<table class="all-students">';
            echo '<tr>';
            echo '<td class="head">غیر حاضر</td>';
            echo '<td class="head">رخصت</td>';
            echo '<td class="head">حاضر</td>';
            echo '<td class="head">شعبہ</td>';
            echo '<td class="head">سیکشن</td>';
            echo '<td class="head">مطلوبہ درجہ</td>';
            echo '<td class="head">ولدیت</td>';
            echo '<td class="head">نام طالب علم</td>';
            echo '<td class="head">مسلسل رجسٹرنمبر</td>';
            echo '<td class="head">شمار</td>';
            echo '</tr>';
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                echo '<form action="student-profile.php" method="post">';
                echo '<tr>';
                echo '<td style="display:none;"><input type="text" name="gr-id" id="gr-id' . $i . '" value="' . $row['GR_no'] . '" style="display:none;"></td>';
                echo '<td class="data"><input class="absent" type="radio" name="attend' . $i . '" value="غیر حاضر"></td>';
                echo '<td class="data"><input class="leave" type="radio" name="attend' . $i . '" value="رخصت"></td>';
                echo '<td class="data"><input class="present" type="radio" name="attend' . $i . '" value="حاضر" checked></td>';
                echo '<td class="data">' . $row['department'] . '</td>';
                echo '<td class="data">' . $row['class_type'] . '</td>';
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
            echo '<input style="display:none" type="text" id="total_stu" name="total_stu" value="' . --$i . '">';
            echo '<input type="submit" style="float:left" class="btn btn-success" id="btn" name="btn" value="ڈیٹا کو صیو کریں" title="ڈیٹا کو صیو کریں">';
            $conn->close();
        } else {
            echo '<div class="alert-message">';
            echo '<div class="alert alert-info" style="text-align: center; font-size:20px;">';
            echo '<strong>معاف کیجیےگا</strong>! اس طرح کا دیٹا موجود نہیں ہے۔ شکریہ۔';
            echo '</div>';
            echo '</div>';
        }
    }
} else {
    echo "no";
}
