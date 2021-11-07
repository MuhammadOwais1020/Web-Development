<?php
$sql = "";
include("C:/xampp/htdocs/pos/library/tcpdf.php");

$pdf = new TCPDF('p', 'mm', 'A4', true, 'UTF-8', false);

$pdf->setPrintHeader(false);

$pdf->AddPage();
$pdf->Cell(189, 40);

$pdf->Image('http://localhost/pos/img/logo/banner.jpg', 10, 10, 189);

$pdf->Ln();
$pdf->setFont('freeserif', '', 20);
$urdu = "نتیجہ امتحان";

$pdf->WriteHTMLCell(195, 0, '', '', '<h1 style="text-align:center; color:#007348;">' . $urdu . '</h1>', 0, 1);
$pdf->Ln(4);
$pdf->setFont('freeserif', '', 12);

if (isset($_POST['print-kro'])) {
    $sql = $_POST['sql-query'];

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

                $pdf->WriteHTMLCell(25, 5, '', '', '<p style="text-align:right; font-weight:bold;">عملی کیفیت</p>', 0, 0);
                $pdf->WriteHTMLCell(25, 5, '', '', '<p style="text-align:right; font-weight:bold;">درجہ کامیابی</p>', 0, 0);
                $pdf->WriteHTMLCell(25, 5, '', '', '<p style="text-align:right; font-weight:bold;">فیصد</p>', 0, 0);
                $pdf->WriteHTMLCell(25, 5, '', '', '<p style="text-align:right; font-weight:bold;">طلوبہ درجہ</p>', 0, 0);
                $pdf->WriteHTMLCell(25, 5, '', '', '<p style="text-align:right; font-weight:bold;">نام طالب علم</p>', 0, 0);
                $pdf->WriteHTMLCell(25, 5, '', '', '<p style="text-align:right; font-weight:bold;">رجسٹرنمبر</p>', 0, 0);
                $pdf->WriteHTMLCell(25, 5, '', '', '<p style="text-align:right; font-weight:bold;">رول نمبر</p>', 0, 1);
                $pdf->ln(10);
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

                    $pdf->WriteHTMLCell(25, 5, '', '', '<p style="text-align:right;">' . $row['performance'] . '</p>', 0, 0);
                    $pdf->WriteHTMLCell(25, 5, '', '', '<p style="text-align:right;">' . $grade . '</p>', 0, 0);
                    $pdf->WriteHTMLCell(25, 5, '', '', '<p style="text-align:right;">' . $row['percent'] . "%" . '</p>', 0, 0);
                    $pdf->WriteHTMLCell(25, 5, '', '', '<p style="text-align:right;">' . $row['class'] . '-' . $row['class_type'] . '</p>', 0, 0);
                    $pdf->WriteHTMLCell(25, 5, '', '', '<p style="text-align:right;">' . $row['student_name'] . '</p>', 0, 0);
                    $pdf->WriteHTMLCell(25, 5, '', '', '<p style="text-align:right;">' . $row['GR_no'] . '</p>', 0, 0);
                    $pdf->WriteHTMLCell(25, 5, '', '', '<p style="text-align:right;">' . $row['exam_number'] . '</p>', 0, 1);

                    // echo '<form action="exam-profile.php" method="post">';
                    // echo '<tr>';
                    // echo '<td style="display:none;"><input type="text" name="exam-id" value="' . $row['id'] . '" style="display:none;"></td>';
                    // echo '<td class="data"><button class="btn btn-info">تفصیل</button></td>';
                    // echo '<td class="data">' . $row['performance'] . '</td>';
                    // echo '<td class="data">' . $grade . '</td>';
                    // echo '<td class="data">' . $row['percent'] . "%" . '</td>';
                    // echo '<td class="data">' . $row['student_name'] . '</td>';
                    // echo '<td class="data">' . $row['exam_number'] . '</td>';
                    // echo '<td class="data">' . $row['GR_no'] . '</td>';
                    // echo '<td class="data">' . $i . '</td>';
                    // echo '</tr>';
                    // echo '</form>';

                    $i++;
                }
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

    // $pdf->WriteHTMLCell(25, 5, '', '', '<p style="text-align:right;">' . ' </p>', 1, 0);
    // $pdf->WriteHTMLCell(25, 5, '', '', '<p style="text-align:right;">ماہانہ فیس :</p>', 0, 0);
    // $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">' . ' </p>', 1, 0);
    // $pdf->WriteHTMLCell(42.5, 5, '', '', '<p style="text-align:right;">مسلسل رجسٹر نمبر : </p>', 0, 1);
    // $pdf->ln(2);


    $pdf->Output();
}
