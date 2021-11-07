<?php
$heading = $_POST['heading'];
$where = $_POST['where'];
$sql = $_POST['sql'];
$date_from = $_POST['date_from'];
$date_to = $_POST['date_to'];

//Database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "madrassa";
$dr_total = 0;
$cr_total = 0;
$closing_balance = 0;
include("C:/xampp/htdocs/pos/library/tcpdf.php");
// require_once('library/tcpdf.php');

$pdf = new TCPDF('p', 'mm', 'A4', true, 'UTF-8', false);

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
// $fontname = $pdf->addTTFfont('C:\xampp\htdocs\pdf\library\mere\Jameel Noori Kasheeda.ttf', 'TrueTypeUnicode', '', 32);

$pdf->AddPage();
$pdf->Cell(189, 40);

$pdf->Image('http://localhost/pos/img/logo/banner.jpg', 10, 10, 189);

$pdf->Ln();
$pdf->setFont('freeserif', '', 16);
$urdu = 'آمدن آخراجات';

$pdf->WriteHTMLCell(195, 0, '', '', '<h1 style="background-color:#007348; color:white; border: solid 1px #007338; text-align:center; border-radius: 24px;">' . $urdu . '</h1>', 0, 1);

$pdf->setFont('freeserif', '', 14);
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    $error_message = "Connection failed: " . $conn->connect_error;
    $error = True;
} else {
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // $pdf->WriteHTMLCell(190, 5, '', '', '<p style="text-align:right; font-weight:bold;"> ' . $date_to . ' سے ' . $date_from . '</p>', 0, 1);
        // $pdf->ln(5);

        $pdf->WriteHTMLCell(30, 5, '', '', '<p style="text-align:right; font-weight:bold;">آخراجات</p>', 1, 0);
        $pdf->WriteHTMLCell(30, 5, '', '', '<p style="text-align:right; font-weight:bold;">آمدن</p>', 1, 0);
        $pdf->WriteHTMLCell(70, 5, '', '', '<p style="text-align:right; font-weight:bold;">تفصیل</p>', 1, 0);
        $pdf->WriteHTMLCell(30, 5, '', '', '<p style="text-align:right; font-weight:bold;">تاریخ</p>', 1, 0);
        $pdf->WriteHTMLCell(30, 5, '', '', '<p style="text-align:right; font-weight:bold;">ٹرانزیکشن</p>', 1, 1);
        // $pdf->ln(2);

        while ($row = $result->fetch_assoc()) {
            $pdf->WriteHTMLCell(30, 5, '', '', '<p style="text-align:right;">' . $row['CR'] . '</p>', 1, 0);
            $pdf->WriteHTMLCell(30, 5, '', '', '<p style="text-align:right;">' . $row['DR'] . '</p>', 1, 0);
            $pdf->WriteHTMLCell(70, 5, '', '', '<p style="text-align:right;">' . $row['details'] . '</p>', 1, 0);
            $pdf->WriteHTMLCell(30, 5, '', '', '<p style="text-align:right;">' . $row['date_'] . '</p>', 1, 0);
            $pdf->WriteHTMLCell(30, 5, '', '', '<p style="text-align:right;">' . $row['id'] . '</p>', 1, 1);
        }
        $sql = "SELECT SUM(DR) as dr, SUM(CR) as cr FROM finance " . $where;
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            $error_message = "Connection failed: " . $conn->connect_error;
            $error = True;
        } else {
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $dr_total = $row['dr'];
                    $cr_total = $row['cr'];
                    $closing_balance = floatval($dr_total) + floatval($cr_total);
                }
            }
        }
        $pdf->ln(5);
        $pdf->WriteHTMLCell(30, 5, '', '', '<p style="text-align:right;">' . $cr_total . '</p>', 1, 0);
        $pdf->WriteHTMLCell(30, 5, '', '', '<p style="text-align:right;">' . $dr_total . '</p>', 1, 0);
        $pdf->WriteHTMLCell(130, 5, '', '', '<p style="text-align:right;">میزان آمدن آخراجات</p>', 0, 1);

        $pdf->WriteHTMLCell(60, 5, '', '', '<p style="text-align:right;">' . $closing_balance . '</p>', 1, 0);
        $pdf->WriteHTMLCell(130, 5, '', '', '<p style="text-align:right;">میزان بچت</p>', 0, 1);
    }
}
$conn->close();

$pdf->Output();
