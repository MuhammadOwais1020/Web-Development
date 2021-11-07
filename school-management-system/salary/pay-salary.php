<?php

// include("fee-update-after-month.php");

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
    $sql = "SELECT fee_id from salary ORDER BY fee_id DESC LIMIT 1";
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
            <p>مشاہرہ واؤچر</p>
        </div>

        <form action="salary-recipt.php" method="post" enctype="multipart/form-data" target="blank_">

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
            echo '<b>* بابت ماہ</b><br>';
            echo '<select name="month" class="selection" id="month" title="فیس بابت ماہ" required="" required>';
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
            echo '<input type="numeric" name="year"  id="year"  value="' . $current_year . '" title="سال " placeholder="" required>';
            echo '</label>';
            echo '</div>';
            echo '';
            echo '<div class="input-feiled">';
            echo '<label for="">';
            echo '<b>* نام</b><br>';
            echo '<input type="text" id="teacher-name" name="teacher-name" value="" title="نام" readonly required placeholder="">';
            echo '</label>';
            echo '</div>';
            echo '';
            echo '<div class="input-feiled">';
            echo '<label for="">';
            echo '<b>* عہدہ</b><br>';
            echo '<input type="text" id="designation" name="designation" value="" title="عہدہ" readonly placeholder="" required>';
            echo '</label>';
            echo '</div>';
            echo '';
            echo '<div class="input-feiled">';
            echo '<label for="">';
            echo '<b>* مقررہ مشاہرہ</b><br>';
            echo '<input type="numeric" id="monthly-salary" name="monthly-salary" value="0" title="مقررہ مشاہرہ" placeholder="" readonly required>';
            echo '</label>';
            echo '</div>';

            echo '<input type="submit" id="outter-btn" name="salary-submit" value="رقم ادا کرو" title="رقم ادا کرو">';
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
            echo '<b>* سابقہ بقایاجات</b><br>';
            echo '<input type="numeric" id="remaining-salary" name="remaining-salary" value="0" title="سابقہ بقایاجات" placeholder="" readonly required>';
            echo '</label>';
            echo '</div>';
            echo '';
            echo '<div class="input-feiled">';
            echo '<label for="">';
            echo '<b>* اضافی (انعام وغیرہ)</b><br>';
            echo '<input type="numeric" id="bonus" name="bonus" value="0" title="اضافی (انعام وغیرہ)" placeholder="" readonly readonly required>';
            echo '</label>';
            echo '</div>';
            echo '';
            echo '<div class="input-feiled">';
            echo '<label for="">';
            echo '<b>* پیشگی وصول شدہ رقم</b><br>';
            echo '<input type="numeric" id="already-paid" name="already-paid" value="0" title="پیشگی وصول شدہ رقم" readonly placeholder="" required>';
            echo '</label>';
            echo '</div>';
            echo '';
            echo '<div class="input-feiled">';
            echo '<label for="">';
            echo '<b>* کل ایام کار</b><br>';
            echo '<input type="numeric" id="present" name="present" value="0" title="کل ایام کار" placeholder="" readonly required>';
            echo '</label>';
            echo '</div>';
            echo '';
            echo '<div class="input-feiled">';
            echo '<label for="">';
            echo '<b>* کٹوتی</b><br>';
            echo '<input type="numeric" id="cut" name="cut" value="0" title="کٹوتی" placeholder="" readonly required>';
            echo '</label>';
            echo '</div>';
            echo '';
            echo '';
            echo '<div class="input-feiled">';
            echo '<label for="">';
            echo '<b>* واجب الاداء</b><br>';
            echo '<input type="numeric" name="total" id="total" value="0" title="واجب الاداء" placeholder="" readonly required>';
            echo '</label>';
            echo '</div>';

            echo '<div class="input-feiled">';
            echo '<label for="">';
            echo '<b>* اداشدہ مشاہرہ</b><br>';
            echo '<input type="numeric" name="pay" value="" title="اداشدہ مشاہرہ" placeholder="" required>';
            echo '</label>';
            echo '</div>';
            echo '<input type="submit" id="inner-btn" name="salary-submit" value="فیس وصول کرو" title="فیس وصول کرو">';
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
                    <b>* اضافی (انعام وغیرہ)</b><br>
                    <input type="numeric" id="bonus_" name="bonus" value="0" title="اضافی (انعام وغیرہ)" placeholder="" required>
                </label>
            </div>

            <div class="input-feiled_">
                <label for="">
                    <b>* پیشگی وصول شدہ رقم</b><br>
                    <input type="numeric" id="already-paid_" name="already-paid" value="0" title="پیشگی وصول شدہ رقم" placeholder="" required>
                </label>
            </div>

            <div class="input-feiled_">
                <label for="">
                    <b>* کل ایام کار</b><br>
                    <input type="numeric" id="present_" name="present" value="0" title="کل ایام کار" placeholder="" required>
                </label>
            </div>

            <br><br><br><br><br><br><br><br><br><br>
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
        var monthly_salary = 0;
        var days_in_month = 5;
        var salary_per_day = 0;
        var salary_total_days = 0;
        var cut = 0;
        var salary_after_cut = 0;
        var present = 0;

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
                            $("#teacher-name").val(token[0]);
                            $("#designation").val(token[1]);
                            $("#monthly-salary").val(token[2]);
                            monthly_salary = parseFloat(token[2]);
                            $("#fees-id").val(token[3]);
                            $("#remaining-salary").val(token[4]);
                            $("#total").val(token[5]);
                            total = token[5];
                        }
                    });
                }
            });

            //Show Modal Box
            $("#bonus, #already-paid, #present, #cut").on("click", function(e) {
                $("#modal").show();

                var bonus = $("#bonus").val() != "" ? parseFloat($("#bonus").val()) : 0;
                var already_paid = $("#already-paid").val() != "" ? parseFloat($("#already-paid").val()) : 0;

                total = parseFloat($("#remaining-salary").val()) + parseFloat($("#monthly-salary").val());

                $("#bonus_").val($("#bonus").val());
                $("#already-paid_").val($("#already-paid").val());
                $("#present_").val($("#present").val());
                // $("#cut_").val($("#cut").val());

            });
            //Hide Modal Box
            $("#close-btn").on("click", function() {
                $("#modal").hide();
            });

            $("#update-btn").on("click", function(e) {

                var bonus = $("#bonus_").val() != "" ? parseFloat($("#bonus_").val()) : 0;
                var already_paid = $("#already-paid_").val() != "" ? parseFloat($("#already-paid_").val()) : 0;
                present = $("#present_").val() != "" ? parseInt($("#present_").val()) : 0;
                // var cut = $("#cut_").val() != "" ? parseFloat($("#cut_").val()) : 0;
                // var total = parseFloat($("#total").val());

                total = (total + bonus) - already_paid; //subtract already paid
                monthly_salary = parseFloat($("#monthly-salary").val());
                salary_per_day = (monthly_salary / 30); //calculate salary per day

                var month = ($("#month").val());
                var year = ($("#year").val());

                $.ajax({
                    url: "check-days-in-month.php",
                    type: "POST",
                    data: {
                        month_: month,
                        year_: year
                    },
                    success: function(data) {
                        days_in_month = parseInt(data);
                        days_in_month -= 2;
                        if (present < days_in_month) {
                            salary_after_cut = salary_per_day * (present + 2);
                            cut = monthly_salary - salary_after_cut;
                        }

                        total = total - cut; //salary cut from total

                        total = Math.round(total);
                        cut = Math.round(cut);

                        $("#bonus").val(bonus);
                        $("#already-paid").val(already_paid);
                        $("#present").val(present);
                        $("#cut").val(cut);
                        $("#total").val(total);

                        $("#modal").hide();
                    }
                });
                // check leaves


                // cut = monthly_salary - salary_total_days; //salary cut according to leaves
            });

        });
    </script>
</body>

</html>