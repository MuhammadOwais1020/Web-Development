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
    </style>
    <style>
        .leave:checked:after {
            width: 15px;
            height: 15px;
            border-radius: 15px;
            top: -2px;
            left: -1px;
            position: relative;
            background-color: #ffa500;
            content: '';
            display: inline-block;
            visibility: visible;
            border: 2px solid white;
        }

        .absent:checked:after {
            width: 15px;
            height: 15px;
            border-radius: 15px;
            top: -2px;
            left: -1px;
            position: relative;
            background-color: #ff5349;
            content: '';
            display: inline-block;
            visibility: visible;
            border: 2px solid white;
        }

        .present:checked:after {
            width: 15px;
            height: 15px;
            border-radius: 15px;
            top: -2px;
            left: -1px;
            position: relative;
            background-color: #5cb85c;
            content: '';
            display: inline-block;
            visibility: visible;
            border: 2px solid white;
        }

        #error,
        #info,
        #info_,
        #success {
            display: none;
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
            <p>حاضری</p>
        </div>
        <div class="data-filter">
            <input type="text" class="short-input" id="class-type" name="class-type" placeholder="سیکشن">
            <input type="text" class="short-input" id="class-name" name="class-name" placeholder="مطلوبہ درجہ">
            <!-- <input type="text" class="short-input" id="timing" name="timing" placeholder=" تعلیم کا وقت"> -->
            <input type="date" class="short-input" id="date_" name="date_">
            <input type="submit" id="filter-data" name="filter-data" value="تفصیل" class="btn btn-success">
        </div>
        <hr>

        <div style="font-size: 16px; padding:10px;">
            <div id="error" class="alert alert-danger">
                <strong>معزرت</strong>! سیسٹم میں مسلئے کی وجہ سے حاضری نہیں لگی۔ دوباراں کوشیش کریں شکریہ۔
            </div>

            <div id="info" class="alert alert-info">
                <strong>معزرت</strong>! حاضری پہلے سے ہی لگی ہوئی ہے۔
            </div>

            <div id="info_" class="alert alert-info">
                <strong>معزرت</strong>! آپ نے مطلوبہ درجہ اور سیکشن نہیں بتایا۔ شکریہ
            </div>

            <div id="success" class="alert alert-success">
                <strong>کامیابی</strong>! حاضری لگ چوکی ہے۔
            </div>
        </div>

        <!-- <div class="details">
            there are ?? students, male, female
        </div> -->
        <!-- <hr> -->
        <div id="data-show" class="data-show">

        </div>
    </div>
    <!-- Container -->

    <!-- footer -->
    <?php
    include('C:\xampp\htdocs\pos\assets\footer.php');
    ?>

</body>
<script>
    $(document).ready(function() {
        var sql = "";
        $(document).on("click", "#btn", function() {
            $("#success").hide();
            $("#info").hide();
            $("#info_").hide();
            $("#error").hide();

            var total_stu = $('#total_stu').val();
            var count = [];
            var i = 0;
            while (i <= total_stu) {
                count[i] = $('input[name=attend' + i + ']:checked').val();
                i++;
                //alert(f);
            }
            var gr_no = $('input[name=gr-id]').val();
            var jsonString = JSON.stringify(count);
            var date_ = $('#date_').val() != null ? $('#date_').val() : "";
            if (date_ != "") {
                $.ajax({
                    url: "set-attend.php",
                    type: "POST",
                    data: {
                        count: jsonString,
                        query: sql,
                        gr: gr_no,
                        date_: date_
                    },
                    success: function(data) {
                        if (data == "Success") {
                            $("#success").show();
                        } else if (data == "Already") {
                            $("#info").show();
                        } else {
                            $("#error").show();
                        }
                    }
                });

            } else {
                alert("تاریخ والے سیکشن کو بھی فل کرو۔ شکریہ");
            }
        });
        $('#filter-data').click(function() {
            $("#success").hide();
            $("#info, #info_").hide();
            $("#error").hide();

            var classs = $('#class-name').val() != null ? $('#class-name').val() : "";
            var class_type = $('#class-type').val() != null ? $('#class-type').val() : "";
            var timing = $('#date_').val() != null ? $('#date_').val() : "";

            alert(classs);
            alert(class_type);
            alert(timing);

            if (classs != "" && timing != "" && class_type != "") {
                sql = "SELECT * FROM students WHERE class = '" + classs + "' AND class_type = '" + class_type + "'";
            } else {
                sql = "no";
            }
            alert(sql);
            $.ajax({
                url: "attend-filter.php",
                type: "POST",
                data: {
                    query: sql
                },
                success: function(data) {
                    if (data != "no") {
                        $('#data-show').html(data);
                    } else {
                        $("#info_").show();
                    }
                }
            });


        });
    });
</script>

</html>