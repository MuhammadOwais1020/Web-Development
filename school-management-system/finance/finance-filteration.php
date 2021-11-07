<?php
$sql = "";
$heading = "";
$where = "";
$date_from = "";
$date_to = "";

$sql = "SELECT date(datetime_) as date_, id, DR, CR, maad, sadaqa, type, details FROM finance ORDER BY id DESC";
$heading = '<p> آمدن اور آخراجات</p>';

if (isset($_POST['apply-btn'])) {
    if ($_POST['from'] != "" && $_POST['to'] != "") {
        $date_from = $_POST['from'];
        $date_to = $_POST['to'];
        $sql = "SELECT date(datetime_) as date_, id, DR, CR, type, details, maad, sadaqa from finance WHERE datetime_ BETWEEN '$date_from' AND '$date_to'";
        $where = " WHERE datetime_ BETWEEN '{$date_from}' AND '{$date_to}'";
    }
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

        #tarikh,
        input[type="datetime-local"] {
            outline: none;
            width: 300px;
            text-align: right;
            font-weight: 400;
            font-size: 14px;
            line-height: 1.42857143;
            padding: 6px 12px;
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
            echo $heading;
            ?>
        </div>

        <section style="padding: 10px;">
            <div class="date_div">
                <form action="" method="POST">
                    <input type="submit" name="refresh" class="btn-info apply-btn" value="تازہ">
                    <input type="submit" name="apply-btn" class="btn-info apply-btn" value="تفصیل">
                    <input type="datetime-local" class="date_input" name="to">
                    <label style="margin-right:20px">To</label>
                    <input type="datetime-local" class="date_input" name="from">
                    <label style="margin-right:20px">From</label>
                </form>

            </div>
        </section>

        <div class="data-filter">
            <form action="report.php" method="post" target="blank_">
                <input type="submit" class="btn-success apply-btn" id="print-maro" value="پرینٹ کرو">
                <?php
                echo '<input type="text" name="heading" id="heading" value="' . $heading . '" style="display:none;">';
                echo '<input type="text" id="sql" name="sql" value="' . $sql . '" style="display:none;">';
                echo '<input type="text" id="where" name="where" value="' . $where . '" style="display:none;">';
                echo '<input type="datetime-local" id="date_from" name="date_from" value="' . $date_from . '" onchange="console.log(this.value.split("T")[0]);" style="display:none;">';
                echo '<input type="datetime-local" id="date_to" name="date_to" value="' . $date_to . '" onchange="console.log(this.value.split("T")[0]);" style="display:none;">';
                ?>
            </form>
        </div>
        <!-- <div class="details">
            there are ?? students, male, female
        </div> -->
        <!-- <hr> -->
        <div class="data-show">
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
                    echo '<td class="head">آخراجات</td>';
                    echo '<td class="head">آمدن</td>';
                    echo '<td class="head">تفصیل</td>';
                    echo '<td class="head">عطیات</td>';
                    echo '<td class="head">مد</td>';
                    echo '<td class="head">تاریخ اور وقت</td>';
                    echo '<td class="head">ٹرانزیکشن کی شناخت</td>';
                    echo '<td class="head">شمار</td>';
                    echo '</tr>';
                    $i = 1;
                    while ($row = $result->fetch_assoc()) {
                        if ($row['type'] != "SS" && $row['type'] != "FF") {
                            echo '<tr class= "row-delete-able" data-id="' . $row['id'] . '">';
                            echo '<td class="data">' . $row['CR'] . '</td>';
                            echo '<td class="data">' . $row['DR'] . '</td>';
                            echo '<td class="data">' . $row['details'] . '</td>';
                            echo '<td class="data">' . $row['sadaqa'] . '</td>';
                            echo '<td class="data">' . $row['maad'] . '</td>';
                            echo '<td class="data">' . $row['date_'] . '</td>';
                            echo '<td class="data">' . $row['id'] . '</td>';
                            echo '<td class="data">' . $i . '</td>';
                            echo '</tr>';
                            $i++;
                        } else {
                            echo '<tr class= "row-not-delete-able">';
                            echo '<td class="data">' . $row['CR'] . '</td>';
                            echo '<td class="data">' . $row['DR'] . '</td>';
                            echo '<td class="data">' . $row['details'] . '</td>';
                            echo '<td class="data">' . $row['sadaqa'] . '</td>';
                            echo '<td class="data">' . $row['maad'] . '</td>';
                            echo '<td class="data">' . $row['date_'] . '</td>';
                            echo '<td class="data">' . $row['id'] . '</td>';
                            echo '<td class="data">' . $i . '</td>';
                            echo '</tr>';
                            $i++;
                        }
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
    <script>
        $(document).ready(function() {
            // Delete records
            $(document).on("dblclick", ".row-delete-able", function() {
                if (confirm("کیا آپ یقینن حزف کرنا چاہتے ہیں؟")) {
                    var transaction_id = $(this).data("id");

                    $.ajax({
                        url: "delete-finance.php",
                        type: "POST",
                        data: {
                            transaction_id: transaction_id
                        },
                        success: function(data) {
                            if (data == 1) {
                                location.reload(true);
                            } else {
                                alert("رکارڈ حزف ہو چوکا ہے۔");
                            }
                        }
                    });

                }
            });

            $(document).on("dblclick", ".row-not-delete-able", function() {
                alert('یہ ریکورڈ یہاں سے حزف نیں ہوگا۔ شکریہ');
            });


        });
    </script>
</body>

</html>