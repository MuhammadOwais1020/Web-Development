<?php

include("fee-update-after-month.php");

$fee_id = 0;

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
    $sql = "SELECT fee_id from fees ORDER BY fee_id DESC LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $fee_id = $row['fee_id'];
        }
        $fee_id += 1;
    } else {
        $fee_id = 1;
    }
}
$conn->close();

if (isset($_POST['unpaid'])) {
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>فیس وصولی</title>
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

<body style="background-color: rgba(233, 229, 229, 0.938);">
    <!-- NAV bar start-->
    <?php
    include('C:\xampp\htdocs\pos\assets\nav-bar.php');
    ?>
    <!-- NAV bar end -->

    <div class="container-box">
        <div class="heading">
            <p>فیس کی وصولی کی رسید</p>
        </div>

        <form action="fee-recipt.php" method="post" enctype="multipart/form-data" target="_blank">

            <?php
            echo '<div id="data-to-show">';
            echo '<div class="right">';
            echo '';
            echo '<div class="input-feiled">';
            echo '<label for="">';
            echo '<b>* مسلسل رجسٹر نمبر</b><br>';
            echo '<input type="numeric" name="gr-no" id="gr-number" value="" title="مسلسل رجسٹر نمبر" placeholder="" required>';
            echo '</label>';
            echo '</div>';
            echo '';
            echo '<div class="input-feiled">';
            echo '<label for="">';
            echo '<b>* تاریخ اجراٗ</b><br>';
            echo '<input type="date" name="date-of-submit" id="gfd" value="" title="" placeholder="" required>';
            echo '</label>';
            echo '</div>';
            echo '';
            echo '<div class="input-feiled">';
            echo '<label for="">';
            echo '<b>* فیس بابت ماہ</b><br>';
            echo '<select name="month" class="selection" id="" title="فیس بابت ماہ" required="" required>';
            echo '<option value="" disabled selected>فیس بابت ماہ</option>';
            echo '<option value="1">جنوری</option>';
            echo '<option value="2">فروری</option>';
            echo '<option value="3">مارچ</option>';
            echo '<option value="4">اپریل</option>';
            echo '<option value="5">مئ</option>';
            echo '<option value="6">جون</option>';
            echo '<option value="7">جولائ</option>';
            echo '<option value="8">اگست</option>';
            echo '<option value="9">ستمبر</option>';
            echo '<option value="10">اکتوبر</option>';
            echo '<option value="11">نومبر</option>';
            echo '<option value="12">دسمبر</option>';
            echo '</select>';
            echo '</label>';
            echo '</div>';
            echo '';
            echo '<div class="input-feiled">';
            echo '<label for="">';
            echo '<b>* سال</b><br>';
            $current_year = date('Y');
            echo '<input type="numeric" name="year"  id="gfd"  value="' . $current_year . '" title="سال " placeholder="" required>';
            echo '</label>';
            echo '</div>';
            echo '';
            echo '';
            echo '<div class="input-feiled">';
            echo '<label for="">';
            echo '<b>* نام طالب علم / طالبہ</b><br>';
            echo '<input type="text" id="student-name" name="student-name" value="" title="نام بالب علم / طالبہ" required placeholder="">';
            echo '</label>';
            echo '</div>';
            echo '';
            echo '<div class="input-feiled">';
            echo '<label for="">';
            echo '<b>* ولدیت</b><br>';
            echo '<input type="text" id="father-name" name="father-name" value="" title="ولدیت" placeholder="" required>';
            echo '</label>';
            echo '</div>';
            echo '';
            echo '<div class="input-feiled">';
            echo '<label for="">';
            echo '<b>* شعبہ</b><br>';
            echo '<input id="department" type="text" name="department" value="" title="شعبہ" placeholder="" required>';
            echo '</label>';
            echo '</div>';
            echo '';
            echo '<div class="input-feiled">';
            echo '<label for="">';
            echo '<b>* درسگاہ</b><br>';
            echo '<input type="text" id="class" name="class" value="" title="درسگاہ" placeholder="" required>';
            echo '</label>';
            echo '</div>';

            echo '<input type="submit" id="outter-btn" name="fees-submit" value="فیس وصول کرو" title="فیس وصول کرو">';
            echo '';
            echo '</div>';
            echo '';
            echo '<div class="left">';

            echo '<div class="input-feiled">';
            echo '<label for="">';
            echo '<b>* رسید نمبر</b><br>';
            echo '<input type="numeric" id="fees-id" name="fees-id" value="' . $fee_id . '" title="رسید نمبر" placeholder="" readonly required>';
            echo '</label>';
            echo '</div>';
            echo '';
            echo '<div class="input-feiled">';
            echo '<label for="">';
            echo '<b>* ماہانہ فیس</b><br>';
            echo '<input type="numeric" id="monthly-fees" name="monthly-fees" value="300" title="ماہانہ فیس" placeholder="" required>';
            echo '</label>';
            echo '</div>';
            echo '';
            echo '<div class="input-feiled">';
            echo '<label for="">';
            echo '<b>* سالانہ فیس</b><br>';
            echo '<input type="numeric" id="yearly-fees" name="yearly-fees" value="0" title="سالانہ فیس" readonly placeholder="" required>';
            echo '</label>';
            echo '</div>';
            echo '';
            echo '<div class="input-feiled">';
            echo '<label for="">';
            echo '<b>*  سابقہ بقایاجات</b><br>';
            echo '<input type="numeric" id="remaining" name="remaining" value="" title="سابقہ بقایاجات" placeholder="" readonly required>';
            echo '</label>';
            echo '</div>';
            echo '';
            echo '<div class="input-feiled">';
            echo '<label for="">';
            echo '<b>* جرمانہ</b><br>';
            echo '<input type="numeric" id="challan" name="challan" value="0" title="جرمانہ" placeholder="" readonly required>';
            echo '</label>';
            echo '</div>';

            echo '';
            echo '<div class="input-feiled">';
            echo '<label for="">';
            echo '<b>* رعایت</b><br>';
            echo '<input type="numeric" id="discount" name="discount" value="0" title="رعایت" placeholder="" required>';
            echo '</label>';
            echo '</div>';
            echo '';
            echo '';
            echo '<div class="input-feiled">';
            echo '<label for="">';
            echo '<b>* کل واجب الاداٗ</b><br>';
            echo '<input type="numeric" name="total" id="total" value="0" title="کل واجب الاداٗ" placeholder="" readonly required>';
            echo '</label>';
            echo '</div>';

            echo '<div class="input-feiled">';
            echo '<label for="">';
            echo '<b>* وصول</b><br>';
            echo '<input type="numeric" name="pay" value="" title="وصول" placeholder="" required>';
            echo '</label>';
            echo '</div>';
            echo '<input type="submit" id="inner-btn" name="fees-submit" value="فیس وصول کرو" title="فیس وصول کرو">';
            echo '</div>';
            echo '</div>';
            ?>
        </form>


    </div>
    <div id="modal">
        <div id="modal-form">
            <h2>Edit Form</h2>
            <!-- <table cellpadding="10px" width="100%">
            </table> -->
            <div class="input-feiled_">
                <label for="">
                    <b>* سالانہ فیس</b><br>
                    <input type="numeric" class="input-feild" id="yearly-fees_2" name="yearly-fees_2" value="" title="سالانہ فیس" placeholder="سالانہ فیس" required>
                </label>
            </div>

            <div class="input-feiled_">
                <label for="">
                    <b>* جرمانہ</b><br>
                    <input type="numeric" class="input-feild" id="challan_2" name="challan_2" value="" title="جرمانہ" placeholder="جرمانہ" required>
                </label>
            </div>

            <br><br><br><br><br><br><br>
            <input type="submit" class="btn" id="update-btn" value="شامل کرو">
            <br><br>
            <div id="close-btn">X</div>
        </div>
    </div>
    <!-- Footer br start -->
    <?php
    include('C:\xampp\htdocs\pos\assets\footer.php');
    ?>
    <!-- Footer end -->

    <!-- java script -->
    <script>
        var total = 0;

        $(document).ready(function() {
            $('#gr-number').keyup(function() {
                var gr = $("#gr-number").val();
                if (gr != "") {
                    $.ajax({
                        url: "data-search.php",
                        type: "POST",
                        data: {
                            id: gr
                        },
                        success: function(data) {
                            var token = data.split("*");
                            $("#student-name").val(token[0]);
                            $("#father-name").val(token[1]);
                            $("#class").val(token[2]);
                            $("#department").val(token[3]);
                            $("#monthly-fees").val(token[4]);
                            $("#discount").val(token[5]);
                            $("#fees-id").val(token[6]);
                            $("#remaining").val(token[7]);
                            $("#total").val(token[8]);
                            total = parseFloat(token[8]);
                        }
                    });
                }
            });

            //Show Modal Box
            $("#yearly-fees, #challan, #discount").on("click", function(e) {
                var yearly_fees = $("#yearly-fees").val() != "" ? parseFloat($("#yearly-fees").val()) : 0;
                var challan = $("#challan").val() != "" ? parseFloat($("#challan").val()) : 0;

                total -= yearly_fees;
                total -= challan;
                //var sum = floatval(yearly_fees) + floatval(challan);
                // total = total - sum;
                // alert(total);
                // $("#total").val(total);

                $("#modal").show();

                $("#yearly-fees_2").val($("#yearly-fees").val());
                $("#challan_2").val($("#challan").val());


            });
            //Hide Modal Box
            $("#close-btn").on("click", function() {
                $("#modal").hide();
            });

            $("#update-btn").on("click", function(e) {


                var yearly_fees_2 = $("#yearly-fees_2").val() != "" ? parseFloat($("#yearly-fees_2").val()) : 0;
                var challan_2 = $("#challan_2").val() != "" ? parseFloat($("#challan_2").val()) : 0;

                total = (total + yearly_fees_2 + challan_2);

                $("#yearly-fees").val(yearly_fees_2);
                $("#challan").val(challan_2);

                $("#total").val(total);

                $("#modal").hide();
            });

        });
    </script>
</body>

</html>