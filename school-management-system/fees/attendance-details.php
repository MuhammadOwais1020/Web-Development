<!DOCTYPE html>
<html lang="en">

<head>
    <title>طالب علم پروفائل</title>
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
        .container-pro-box {
            height: 750px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .table_title {
            text-align: center;
            width: 400px;
            background-color: grey;
            color: white;
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
        <div style="text-align:center" class="data-show">
            <?php

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "madrassa";

            $gr_id = $_POST['gr-id'];
            $from_date = "";
            $to_date = "";

            $student_name = "";
            $father_name = "";

            // Select student name and father name 
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                $error_message = "Connection failed: " . $conn->connect_error;
                $error = True;
            } else {
                $sql = "SELECT student_name,father_name FROM students WHERE GR_no = " . $gr_id;
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $student_name = $row['student_name'];
                        $father_name = $row['father_name'];
                    }
                }
            }

            if (isset($_POST['apply-btn'])) {
                $from_date = $_POST['from'];
                $to_date = $_POST['to'];
            }
            $sql = "";
            if ($from_date != "" and $to_date != "") {
                $sql = "SELECT * FROM attendance WHERE GR_no = " . $gr_id . " AND date_ BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } else {
                $sql = "SELECT * FROM attendance WHERE GR_no = " . $gr_id;
            }

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                $error_message = "Connection failed: " . $conn->connect_error;
                $error = True;
            } else {
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    echo '<table style="font-size: 20px; border:2px; text-align:center">';
                    echo '<tr>';
                    echo '<th class="table_title">تاریخ</th>';
                    echo '<th class="table_title">حاضری</th>';
                    echo '<th class="table_title">ولدیت</th>';
                    echo '<th class="table_title">نام طالب علم</th>';
                    echo '<th class="table_title">مسلسل رجسٹر نمبر</th>';
                    echo '</tr>';
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row['date_'] . '</td>';
                        echo '<td>' . $row['attendance'] . '</td>';
                        echo '<td>' . $father_name . '</td>';
                        echo '<td>' . $student_name . '</td>';
                        echo '<td>' . $row['GR_no'] . '</td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                }
            }
            ?>
        </div>
    </div>


    <?php
    include('C:\xampp\htdocs\pos\assets\footer.php');
    ?>

</body>

</html>