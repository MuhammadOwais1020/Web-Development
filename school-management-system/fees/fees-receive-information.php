<?php

include("fee-update-after-month.php");
$gr = "";
$month = "";
$year = "";
$p_u_a = "";
$sql = "";

$month = date("m");
$year = date("Y");
$sql = 'SELECT * FROM fees WHERE (fee_month = ' . $month . ' and fee_year = ' . $year . ')';
if (isset($_POST['filter-search'])) {
    $gr = $_POST['gr-number'];
    $year = $_POST['year'];
    $month = $_POST['month'] != "nul" ? $_POST['month'] : "";
    $p_u_a = $_POST['paid'] != "nul" ? $_POST['paid'] : "";


    // echo $gr . " " . $month . " " . $year . " " . $p_u_a;

    if ($gr != "") {
        $sql = "SELECT * FROM fees WHERE GR_no = " . $gr;
    } elseif ($p_u_a == "All Records") {
        $sql = "SELECT * from fees order by fee_id DESC";
    } elseif ($month != "" && $year == "" && $p_u_a == "") {
        $sql = "SELECT * FROM fees WHERE fee_month = '" . $month . "' order by fee_id DESC";
    } elseif ($month == "" && $year != "" && $p_u_a == "") {
        $sql = "SELECT * FROM fees WHERE fee_year = '" . $year . "' order by fee_id DESC";
    } elseif ($month == "" && $year == "" && $p_u_a != "") {
        $sql = "SELECT * FROM fees WHERE status_ = '" . $p_u_a . "' order by fee_id DESC";
    } elseif ($month != "" && $year != "" && $p_u_a == "") {
        $sql = "SELECT * FROM fees WHERE fee_month = '" . $month . "' and fee_year = '" . $year . "' order by fee_id DESC";
    } elseif ($month != "" && $year == "" && $p_u_a != "") {
        $sql = "SELECT * FROM fees WHERE fee_month = '" . $month . "' and status_ = '" . $p_u_a . "' order by fee_id DESC";
    } elseif ($month == "" && $year != "" && $p_u_a != "") {
        $sql = "SELECT * FROM fees WHERE fee_year = '" . $year . "' and status_ = '" . $p_u_a . "' order by fee_id DESC";
    } elseif ($month != "" && $year != "" && $p_u_a != "") {
        $sql = "SELECT * FROM fees WHERE fee_month = '" . $month . "' and fee_year = '" . $year . "' and status_ = '" . $p_u_a . "' order by fee_id DESC";
    } else {
        $sql = "SELECT * from fees order by fee_id DESC";
    }
    // echo " " . $sql;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>فیس وصولی معلومات</title>
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

<body style="background-color: rgba(233, 229, 229, 0.938);">
    <!-- NAV bar start-->
    <?php
    include('C:\xampp\htdocs\pos\assets\nav-bar.php');
    ?>
    <!-- NAV bar end -->

    <!-- Container -->
    <div class="outer-container">
        <div class="heading">
            <p>فیس کی تفصیل</p>
        </div>
        <div class="data-filter">
            <input type="submit" id="filter-data" name="filter-data" value="&nbsp; Filter &nbsp;" class="btn btn-success">
        </div>
        <br>
        <hr>

        <!-- <hr> -->
        <?php
        echo '<div class="data-show">';

        $remaining = 0;
        $status = "";
        $mezan = 0;
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
                echo '<td class="head">کیفیت</td>';
                echo '<td class="head">بقایا</td>';
                echo '<td class="head">وصول</td>';
                echo '<td class="head">کل واجب الاداٗ</td>';
                echo '<td class="head">رعایت</td>';
                echo '<td class="head">میزان</td>';
                echo '<td class="head">سابقہ بقایاجات</td>';
                echo '<td class="head">سالانہ فیس</td>';
                echo '<td class="head">فیس</td>';
                echo '<td class="head">مہینہ</td>';
                echo '<td class="head">مسلسل رجسٹرنمبر</td>';
                echo '<td class="head">شمار</td>';
                echo '</tr>';
                $i = 1;
                while ($row = $result->fetch_assoc()) {
                    $mezan = (int)$row['monthly_fees'] + (int)$row['yearly_fees'] + (int)$row['challan'] + (int)$row['remianing'];
                    $remaining = floatval($row['total']) - floatval($row['recieved']);
                    $status = $row['status_'];

                    if ($status == 'paid') {
                        echo '<form action="fee-recipt.php" id="myForm" method="post" target="_blank">';
                        echo '<tr class= "ro" data-id="' . $row['fee_id'] . '*' . $row['transaction_id'] . '">';
                        echo '<td style="display:none;"><input type="numeric" name="fee-id" value="' . $row['fee_id'] . '" style="display:none;"></td>';
                        echo '<td class="data"><button name="print"  class="btn btn-success"> &nbsp; Paid &nbsp;</button></td>';
                        if ($remaining > 0)
                            echo '<td class="data" style="color:red;">' . $remaining . '</td>';
                        else
                            echo '<td class="data">' . $remaining . '</td>';

                        echo '<td class="data">' . $row['recieved'] . '</td>';
                        echo '<td class="data">' . $row['total'] . '</td>';
                        echo '<td class="data">' . $row['discount'] . '</td>';
                        echo '<td class="data">' . $mezan . '</td>';
                        echo '<td class="data">' . $row['remianing'] . '</td>';
                        echo '<td class="data">' . $row['yearly_fees'] . '</td>';
                        echo '<td class="data">' . $row['monthly_fees'] . '</td>';
                        echo '<td class="data">' . $row['fee_month'] . ' / ' . $row['fee_year'] . '</td>';
                        echo '<td class="data">' . $row['GR_no'] . '</td>';
                        echo '<td class="data">' . $i . '</td>';
                        echo '</tr>';
                        echo '</form>';
                    } else {
                        echo '<form action="pay-fees.php" method="post">';
                        echo '<tr>';
                        echo '<td style="display:none;"><input type="text" name="fee-id" value="' . $row['fee_id'] . '" style="display:none;"></td>';
                        echo '<td class="data"><button name="unpaid" id="' . $row['fee_id'] . '" class="btn btn-danger">Unpaid</button></td>';
                        if ($remaining > 0)
                            echo '<td class="data" style="color:red;">' . $remaining . '</td>';
                        else
                            echo '<td class="data">' . $remaining . '</td>';

                        echo '<td class="data">' . $row['recieved'] . '</td>';
                        echo '<td class="data">' . $row['total'] . '</td>';
                        echo '<td class="data">' . $row['discount'] . '</td>';
                        echo '<td class="data">' . $mezan . '</td>';
                        echo '<td class="data">' . $row['remianing'] . '</td>';
                        echo '<td class="data">' . $row['yearly_fees'] . '</td>';
                        echo '<td class="data">' . $row['monthly_fees'] . '</td>';
                        echo '<td class="data">' . $row['fee_month'] . ' / ' . $row['fee_year'] . '</td>';
                        echo '<td class="data">' . $row['GR_no'] . '</td>';
                        echo '<td class="data">' . $i . '</td>';
                        echo '</tr>';
                        echo '</form>';
                    }

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
        echo '</div>';
        ?>


    </div>
    <!-- Container -->
    <!-- Model box start -->
    <div id="modal">
        <div id="modal-form">
            <h2>Edit Form</h2>
            <!-- <table cellpadding="10px" width="100%">
            </table> -->
            <form action="" method="post" id="filter-function">

                <div class="input-feiled_">
                    <label for="">
                        <b> فیس بابت ماہ</b><br>
                        <select name="month" id="" class="selection" title="فیس بابت ماہ">
                            <option value="nul" selected>فیس بابت ماہ</option>
                            <option value="1">جنوری</option>
                            <option value="2">فروری</option>
                            <option value="3">مارچ</option>
                            <option value="4">اپریل</option>
                            <option value="5">مئ</option>
                            <option value="6">جون</option>
                            <option value="7">جولائ</option>
                            <option value="8">اگست</option>
                            <option value="9">ستمبر</option>
                            <option value="10">اکتوبر</option>
                            <option value="11">نومبر</option>
                            <option value="12">دسمبر</option>
                        </select>
                    </label>
                </div>

                <div class="input-feiled_">
                    <label for="">
                        <b> سال</b><br>
                        <input type="numeric" class="input-feild" id="year" name="year" value="" title="سال" placeholder="سال">
                    </label>
                </div>

                <div class="input-feiled_">
                    <label for="">
                        <b>مسلسل رجسٹر نمبر</b><br>
                        <input type="numeric" class="input-feild" id="gr-number" name="gr-number" value="" title="مسلسل رجسٹر نمبر" placeholder="مسلسل رجسٹر نمبر">
                    </label>
                </div>

                <div class="input-feiled_">
                    <label for="">
                        <b> Paid/Unpaid</b><br>
                        <select name="paid" id="" class="selection" title="paid/unpaid">
                            <option value="nul" selected>paid/unpaid</option>
                            <option value="paid">Paid</option>
                            <option value="unpaid">Unpaid</option>
                            <option value="All Records">All Records</option>
                        </select>
                    </label>
                </div>

                <br><br><br><br><br><br><br><br><br><br><br><br>
                <input type="submit" class="btn" id="filter-btn" name="filter-search" value="&nbsp; Filter &nbsp;">
            </form>
            <br><br>
            <div id="close-btn">X</div>
        </div>
    </div>
    <!-- Model box end -->

    <!-- Footer br start -->
    <?php
    include('C:\xampp\htdocs\pos\assets\footer.php');
    ?>
    <!-- Footer end -->

    <script>
        var sql = "";
        $(document).ready(function() {
            // Delete records
            $(document).on("dblclick", ".ro", function() {
                if (confirm("کیا آپ یقینن حزف کرنا چاہتے ہیں؟")) {
                    var data_contain = $(this).data("id");
                    var token = data_contain.split("*");
                    var studentId = token[0];
                    var transaction_id = token[1];

                    $.ajax({
                        url: "delete-fee.php",
                        type: "POST",
                        data: {
                            id: studentId,
                            transaction_id: transaction_id
                        },
                        success: function(data) {
                            if (data == 1) {
                                location.reload();
                            } else {
                                alert("رکارڈ حزف ہو چوکا ہے۔");
                            }
                        }
                    });

                }
            });
            // show model box
            $("#filter-data").on("click", function(e) {
                $("#modal").show();
                $("#month").val("");
                $("#year").val("");
                $("#gr-number").val("");
                $("#p-u-a").val("");
            });

            // Hide modal box
            $("#close-btn").on("click", function(e) {
                $("#modal").hide();
            });

            // filter data
            $("#filter-btn").on("click", function(e) {
                $("#filter-function").submit();
                // hide modal box
                $("#modal").hide();
            });
        });
    </script>
</body>

</html>