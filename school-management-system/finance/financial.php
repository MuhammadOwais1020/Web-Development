<?php
//Database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "madrassa";
$month = date("m");
$year = date("Y");
$heading = "";
$output = "";
$DR = 0;
$CR = 0;
$income = 0;
$maad = "";
$gr_number = 0;

$conn = mysqli_connect("localhost", "root", "", "madrassa") or die("Connection Failed");
$sql = "SELECT SUM(DR) as DR, SUM(CR) as CR from finance WHERE MONTH(datetime_) = " . $month;

$result = mysqli_query($conn, $sql) or die("SQL Query Failed.");

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $DR = floatval($row['DR']);
        $CR = floatval($row['CR']);
    }
    $heading = '<h1 class="h1_hudaar">آمدن اور اخرجات  ' . $month . '/' . $year . '</h1>';
}

if (isset($_POST['apply-btn'])) {
    if ($_POST['from'] != "" && $_POST['to'] != "") {
        $date_from = $_POST['from'];
        $date_to = $_POST['to'];
        $conn = mysqli_connect("localhost", "root", "", "madrassa") or die("Connection Failed");
        $sql = "SELECT SUM(DR) as DR, SUM(CR) as CR from finance WHERE datetime_ BETWEEN '$date_from' AND '$date_to'";
        $result = mysqli_query($conn, $sql) or die("SQL Query Failed.");

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $DR = floatval($row['DR']);
                $CR = floatval($row['CR']);
            }
            $heading = '<h1 class="h1_hudaar">آمدن اور اخرجات ' . $date_from . ' سے ' . $date_to . ' تک</h1>';
        }
    }
}
if ($DR == "") {
    $DR = 0;
}
if ($CR == "") {
    $CR = 0;
}
$income = $DR - $CR;

// udhar
$DR_len = 0;
$CR_len = 0;
$income_len = 0;

// len
$conn = mysqli_connect("localhost", "root", "", "madrassa") or die("Connection Failed");
$sql = "SELECT SUM(remaning_balance) as DR from remaining";

$result = mysqli_query($conn, $sql) or die("SQL Query Failed.");

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $DR_len += floatval($row['DR']);
        if ($DR_len < 0) {
            $CR_len += $DR_len;
            $CR_len = abs($CR_len);
            $DR_len = 0;
        }
    }
}
// den
$conn = mysqli_connect("localhost", "root", "", "madrassa") or die("Connection Failed");
$sql = "SELECT SUM(remaining_balance) as CR from remaining_salary";

$result = mysqli_query($conn, $sql) or die("SQL Query Failed.");

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $CR_len += floatval($row['CR']);
        if ($CR_len < 0) {
            $DR_len += $CR_len;
            $DR_len = abs($DR_len);
            $CR_len = 0;
        }
    }
}

// echo "DR: " . $DR_len . " CR: " . $CR_len;

if ($DR_len == "") {
    $DR_len = 0;
}
if ($CR_len == "") {
    $CR_len = 0;
}

$income_len =  ($income + $DR_len) - $CR_len;

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

        .outer-container {
            height: 1300px;
        }

        body,
        p {
            font-family: urdu !important;
        }

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

        .label-value {
            color: #252525;
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

        .text_div {
            /* width: 100%; */
            background-image: linear-gradient(50deg, #11998e, #39c76e);
            height: 90px;
            padding: 8px;
            border-radius: 5px;
            color: white;
            margin-top: 20px;
            margin-left: auto;
            margin-right: auto;
        }

        .text_div div {
            margin: 0 auto;
            width: 500px;
            text-align: right;
        }

        table {
            margin-left: auto;
            margin-right: auto;
        }

        table th {
            border: 5px;
        }

        th,
        td {
            text-align: center;
            padding-right: 100px;
        }

        .text_div label {
            font-size: 24px;
        }

        .h1_s {
            text-align: center !important;
            background-color: grey;
            border-radius: 4px;
            color: white;
            width: 100%;
            float: right;
            padding: 5px;
        }

        .h1_hudaar {
            text-align: center !important;
            background-color: white;
            color: grey;
        }

        .right_finance {
            margin: 0 auto !important;
            width: 30%;
            /* background-color: red; */
            text-align: right;

        }

        #tarikh {
            outline: none;
            width: 350px;
            text-align: right;
            font-weight: 400;
            font-size: 14px;
            line-height: 1.42857143;
            padding: 6px 12px;
        }

        #dr-cr-btn {
            /* float: right; */
            margin-bottom: 0;
            width: 350px;
            font-weight: 400;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            -ms-touch-action: manipulation;
            touch-action: manipulation;
            cursor: pointer;
            background-image: none;
            border: 1px solid transparent;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.42857143;
            border-radius: 4px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            color: #fff;
            background-color: #5cb85c;
            border-color: #4cae4c;
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
            <?php
            echo '<p> تفصیل آمدن و اخرجات </p>';
            ?>
        </div>
        <!-- <div class="details">
            there are ?? students, male, female
        </div> -->
        <!-- <hr> -->
        <div class="data-show">
            <div class="date_div">
                <form action="" method="POST">
                    <input type="submit" name="refresh" class="btn-info apply-btn" value="تازہ">
                    <input type="submit" name="apply-btn" class="btn-info apply-btn" value="تفصیل">
                    <input type="date" class="date_input" name="to">
                    <label style="margin-right:20px">To</label>
                    <input type="date" class="date_input" name="from">
                    <label style="margin-right:20px">From</label>
                </form>
            </div>
            <?php
            echo $heading;
            ?>
            <div class="text_div">
                <div>
                    <table>
                        <tr>
                            <th><label for="income">میزان آمدن</label></th>
                            <th><label for="expense">اخرجات</label></th>
                            <th><label for="revenue">آمدن</label></th>
                        </tr>
                        <tr>
                            <?php
                            echo '<td><label class="label-value" id="income" for="income">' . $income . '</label></td>';
                            echo '<td><label class="label-value" id="expense" for="expense">' . $CR . '</label></td>';
                            echo '<td><label class="label-value" id="revenue" for="revenue">' . $DR . '</label></td>';
                            ?>
                        </tr>
                    </table>
                </div>
            </div>
            <h1 class="h1_hudaar">لین دین</h1>
            <div class="text_div">
                <div style="margin:0 auto; width:60%;">
                    <table>
                        <tr>
                            <th><label for="income">بچت / خسارہ</label></th>
                            <th><label for="expense">دین</label></th>
                            <th><label for="revenue">لین</label></th>
                        </tr>
                        <tr>
                            <?php
                            echo '<td><label class="label-value" for="income">' . $income_len . '</label></td>';
                            echo '<td><label class="label-value" for="expense">' . $CR_len . '</label></td>';
                            echo '<td><label class="label-value" for="revenue">' . $DR_len . '</label></td>';
                            ?>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="right_finance">
                <div class="text-align-center">

                    <h1 class="h1_s">آمدن و اخرجات</h1>

                    <div class="input-feiled">
                        <label for="">
                            <b>* تاریخ</b><br>
                            <input type="datetime-local" id="tarikh" name="date" title="تاریخ" required="" />
                        </label>
                    </div>

                    <div class="input-feiled">
                        <label for="">
                            <b>* آمدن و آخراجات</b><br>
                            <select name="dr-cr" class="selection" id="dr-cr" title="آمدن و آخراجات" required="" required>
                                <option value="dr">آمدن</option>
                                <option value="cr">اخرجات</option>
                            </select>
                        </label>
                    </div>

                    <div class="input-feiled">
                        <label for="">
                            <b>* قسم</b><br>
                            <select name="kisam" class="selection" id="kisam" title="قسم" required="" required>
                                <option value="F">فیس</option>
                                <option value="S">تنخوا</option>
                                <option value="D">دیغر</option>
                            </select>
                        </label>
                    </div>

                    <div class="input-feiled" id="roll-number">
                        <label for="">
                            <b>* مسلسل رجسٹر نمبر</b><br>
                            <input type="numeric" id="gr-number" name="gr-number" title="مسلسل رجسٹر نمبر" required="" />
                        </label>
                    </div>
                    <div class="input-feiled" id="sadqa" style="display: none;">
                        <label for="">
                            <b>* عطیات</b><br>
                            <select name="sadaqa-kisam" class="selection" id="sadaqa-kisam" title="" required>
                                <option value="صدقہ‎">صدقہ‎</option>
                                <option value="زکوٰۃ">زکوٰۃ</option>
                                <option value="فطرة‎‎">فطرة‎‎</option>
                                <option value="چندا">چندا</option>
                            </select>
                        </label>
                    </div>
                    <div class="input-feiled">
                        <label for="">
                            <b>* رقم</b><br>
                            <input type="numeric" id="raqam" name="raqam" title="رقم" required="" />
                        </label>
                    </div>

                    <div class="input-feiled">
                        <label for="">
                            <b>* مد</b><br>
                            <input type="text" id="maad" name="maad" title="مد" value="" required="" />
                        </label>
                    </div>

                    <div class="input-feiled">
                        <label for="">
                            <b>* تفصیل</b><br>
                            <input type="text" id="tafseel" name="tafseel" title="تفصیل" value="" required="" />
                        </label>
                    </div>

                </div>
                <input type="submit" id="dr-cr-btn" name="admission-form-submit" value="محفوظ کرو" title="ڈیٹا کو صیو کریں">
            </div>


        </div>
    </div>
    <!-- Container -->

    <!-- footer -->
    <?php
    include('C:\xampp\htdocs\pos\assets\footer.php');
    ?>
    <script>
        $(document).ready(function() {

            function data_reload() {
                $.ajax({
                    url: "revenue_calculate.php",
                    type: "POST",
                    data: {
                        do: "do"
                    },
                    success: function(data) {
                        if (data != "") {}
                    }

                });
            }
            $("#kisam").on("change", function(e) {
                var val = $("#kisam").val() != "" ? $("#kisam").val() : "";

                if (val != "F" && val != "S") {
                    $("#roll-number").hide();
                    $("#sadqa").show();
                } else {
                    $("#roll-number").show();
                    $("#sadqa").hide();
                }
            });

            $("#dr-cr-btn").on("click", function(e) {
                var dr_cr = $("#dr-cr").val() != "" ? $("#dr-cr").val() : "";
                var tarikh = $("#tarikh").val() != "" ? $("#tarikh").val() : "";
                var kisam = $("#kisam").val() != "" ? $("#kisam").val() : "";
                var raqam = $("#raqam").val() != "" ? $("#raqam").val() : "";
                var tafseel = $("#tafseel").val() != "" ? $("#tafseel").val() : "";
                var gr_nunmber = $("#gr-number").val() != "" ? $("#gr-number").val() : "";
                var maad = $("#maad").val() != "" ? $("#maad").val() : "";
                var sadaqa_kisam = $("#sadaqa-kisam").val() != "" ? $("#sadaqa-kisam").val() : "";

                if (dr_cr == "" || tarikh == "" || kisam == "" || raqam == "" || tafseel == "") {
                    alert("برائے مہربانی کر کے سارے خانے پر کیجیے۔ شکریہ");
                } else {
                    $.ajax({
                        url: "dr-cr.php",
                        type: "POST",
                        data: {
                            dr_cr_: dr_cr,
                            tarikh_: tarikh,
                            kisam_: kisam,
                            raqam_: raqam,
                            tafseel_: tafseel,
                            gr_number_: gr_nunmber,
                            maad_: maad,
                            sadaqa_kisam_: sadaqa_kisam
                        },
                        success: function(data) {
                            if (data == 1) {
                                location.reload(true);
                            } else {
                                alert("سیسٹم میں مسلئے کی وجہ سے ڈیٹا سیو نہیں ہوا۔ شکریہ");
                                alert(data);
                            }
                        }

                    });
                }
            });

        });
    </script>
</body>

</html>