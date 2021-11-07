<?php
$output = "";
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
        $output .= '<table class="all-students">';
        $output .= '<tr>';
        $output .= '<td class="head">Status</td>';
        $output .= '<td class="head">بقایاجات</td>';
        $output .= '<td class="head">کل واجب الاداٗ</td>';
        $output .= '<td class="head">میزان</td>';
        $output .= '<td class="head">سال</td>';
        $output .= '<td class="head">مہینہ</td>';
        $output .= '<td class="head">مسلسل رجسٹرنمبر</td>';
        $output .= '<td class="head">اعنوان</td>';
        $output .= '</tr>';
        $i = 1;
        while ($row = $result->fetch_assoc()) {
            $remaining = floatval($row['total']) - floatval($row['recieved']);
            $status = $row['status_'];

            if ($status == 'paid') {
                $output .= '<form id="myForm" action="fee-recipt.php" method="post">';
                $output .= '<tr>';
                $output .= '<td style="display:none;"><input type="text" name="fee-id" value="' . $row['fee_id'] . '" style="display:none;"></td>';
                $output .= '<td class="data"><button name="print" data-id="' . $row['fee_id'] . '"  class="btnn"> &nbsp; Paid &nbsp;</button></td>';
                if ($remaining > 0)
                    $output .= '<td class="data" style="color:red;">' . $remaining . '</td>';
                else
                    $output .= '<td class="data">' . $remaining . '</td>';

                $output .= '<td class="data">' . $row['recieved'] . '</td>';
                $output .= '<td class="data">' . $row['total'] . '</td>';
                $output .= '<td class="data">' . $row['fee_year'] . '</td>';
                $output .= '<td class="data">' . $row['fee_month'] . '</td>';
                $output .= '<td class="data">' . $row['fee_id'] . '</td>';
                $output .= '<td class="data">' . $i . '</td>';
                $output .= '</tr>';
                $output .= '</form>';
            } else {
                $output .= '<form action="pay-fees.php" method="post">';
                $output .= '<tr>';
                $output .= '<td style="display:none;"><input type="text" name="fee-id" value="' . $row['fee_id'] . '" style="display:none;"></td>';
                $output .= '<td class="data"><button name="unpaid" data-id="' . $row['fee_id'] . '"  class="btn-danger">Unpaid</button></td>';
                if ($remaining > 0)
                    $output .= '<td class="data" style="color:red;">' . $remaining . '</td>';
                else
                    $output .= '<td class="data">' . $remaining . '</td>';

                $output .= '<td class="data">' . $row['recieved'] . '</td>';
                $output .= '<td class="data">' . $row['total'] . '</td>';
                $output .= '<td class="data">' . $row['fee_year'] . '</td>';
                $output .= '<td class="data">' . $row['fee_month'] . '</td>';
                $output .= '<td class="data">' . $row['fee_id'] . '</td>';
                $output .= '<td class="data">' . $i . '</td>';
                $output .= '</tr>';
                $output .= '</form>';
            }

            $i++;
        }
        $output .= '</table>';
        // Table end
        $output .= '<br>';
        $conn->close();
    } else {
        $output .= '<div class="alert-message">';
        $output .= '<div class="alert alert-info" style="text-align: center; font-size:20px;">';
        $output .= '<strong>معزرت</strong>! اس طرح کا دیٹا مجود نہیں ہے۔ شکریہ۔';
        $output .= '</div>';
        $output .= '</div>';
    }
}


echo $output;
