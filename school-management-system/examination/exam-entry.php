<!DOCTYPE html>
<html lang="en">

<head>
    <title>امتحان داخلہ فارم</title>
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
    <style>
        .readonly {
            background-color: #e4e3e3;
            border: none;
            border-radius: 4px;
        }
    </style>

    <?php
    include('C:\xampp\htdocs\pos\assets\nav-bar.php');
    ?>

    <div class="container-box">
        <div class="heading">
            <p>امتحان داخلہ فارم</p>
        </div>

        <form action="exam-form.php" method="post" enctype="multipart/form-data" target="blank_">

            <div class="right">
                <div class="text-align-center">

                    <div id="error-alert" style="text-align:center; background-color:#f8d7da; color: #721c24; border-color: #f5c6cb; border-radius:4px; display:none">
                        <h1>معزرت! شاگرد موجود نہیں ہے۔</h1>
                    </div>

                    <div id="ok-alert" style="text-align:center; color: #155724; background-color: #d4edda; border-color: #c3e6cb; border-radius:4px; display:none">
                        <h1>شاگرد موجود ہے۔</h1>
                    </div>

                    <div class="input-feiled">
                        <label for="">
                            <b>*اس تاریخ سے</b><br>
                            <input type="date" id="from-date" title="اس تاریخ سے" required="" />
                        </label>
                    </div>

                    <div class="input-feiled">
                        <label for="">
                            <b>*اس تاریخ تک</b><br>
                            <input type="date" id="to-date" title="اس تاریخ تک" required="" />
                        </label>
                    </div>

                    <div class="input-feiled">
                        <label for="">
                            <b> * مسلسل رجسٹر نمبر</b><br />
                            <input type="numeric" name="gr-number" id="gr-number" title="مسلسل رجسٹر نمبر" required>
                        </label>
                    </div>

                    <div class="input-feiled">
                        <label for="">
                            <b>* امتھان رول نمبر</b><br />
                            <input type="numeric" name="exam-number" id="exam-roll-number" title="امتھان رول نمبر" readonly required>
                        </label>
                    </div>

                    <div class="input-feiled">
                        <label for="">
                            <b>* تاریخ</b><br>
                            <input type="date" id="date-of-exam" name="date-of-exam" title="تاریخ" required="" />
                        </label>
                    </div>

                    <div class="input-feiled">
                        <label for="">
                            <b>* نام معلم / معلمہ</b><br>
                            <!-- <input type="text" name="teacher-name" title="نام معالم/ معلمہ" required="" /> -->
                            <select name="teacher-name" class="selection" id="" title="نام معالم/ معلمہ" required="">
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
                                    $sql = "SELECT teacher_name FROM teachers";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows >= 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<option value="' . $row['teacher_name'] . '">' . $row['teacher_name'] . '</option>';
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </label>
                    </div>

                    <div class="input-feiled">
                        <label for="">
                            <b>* عملی کیفیت</b><br>
                            <select name="performance" class="selection" id="" title="عملی کیفیت" required="" required>
                                <option value="بہتر">بہتر</option>
                                <option value="مناسب">مناسب</option>
                                <option value="قابل توجہ">قابل توجہ</option>
                            </select>
                        </label>
                    </div>

                    <div class="input-feiled">
                        <label for="">
                            <b>* کل ایام تعلیم</b><br>
                            <input class="readonly" readonly type="numeric" name="total-class" id="total-class" title="کل ایام تعلیم" required="" />
                        </label>
                    </div>

                    <div class="input-feiled">
                        <label for="">
                            <b>* کل حاضریاں</b><br>
                            <input class="readonly" readonly type="numeric" name="student-present" id="student-present" title="کل حاضریاں" required="" />
                        </label>
                    </div>

                    <div class="input-feiled" style="display:none">
                        <label for="">
                            <b>* کل غیر حاضریاں</b><br>
                            <input type="numeric" name="student-absent" id="student-absent" title="کل غیر حاضریاں" required="" />
                        </label>
                    </div>

                    <div class="input-feiled" style="display:none">
                        <label for="">
                            <b>* فیصد</b><br>
                            <input type="numeric" name="percent" id="percent" title="فیصد" required="" />
                        </label>
                    </div>

                </div>
                <input type="submit" id="outter-btn" name="exam-form-submit" value="محفوظ" title="ڈیٹا کو صیو کریں">
            </div>

            <div class="left">
                <div class="text-align-center">

                    <h1 style="text-align:center; background-color:grey; border-radius:4px; color:white">مضامین</h1>

                    <div class="input-feiled">
                        <h3 style="color:green">:قرآن کریم/ نورانی قاعدہ</h3><br>
                        <label for="">
                            <input style="width:100px" type="numeric" name="quran-get" title="حاصل کردہ نمبر" required="" />
                            <b>کل نمبر</b>
                            <input style="width:100px" type="numeric" name="quran-total" value="100" title="کل نمبر" required="" />
                            <b>حاصل کردہ نمبر</b>
                        </label>
                    </div>

                    <div class="input-feiled">
                        <h3 style="color:green">:ایمانیات وعبادات</h3><br>
                        <label for="">
                            <input style="width:100px" type="numeric" name="emaniat-get" title="حاصل کردہ نمبر" required="" />
                            <b>کل نمبر</b>
                            <input style="width:100px" type="numeric" name="emaniat-total" value="20" title="کل نمبر" required="" />
                            <b>حاصل کردہ نمبر</b>
                        </label>
                    </div>

                    <div class="input-feiled">
                        <h3 style="color:green">:احادیث ومسنون دعائیں</h3><br>
                        <label for="">
                            <input style="width:100px" type="numeric" name="hadees-get" title="حاصل کردہ نمبر" required="" />
                            <b>کل نمبر</b>
                            <input style="width:100px" type="numeric" name="hadees-total" value="20" title="کل نمبر" required="" />
                            <b>حاصل کردہ نمبر</b>
                        </label>
                    </div>

                    <div class="input-feiled">
                        <h3 style="color:green">:سیرت واخلاق وعبادات</h3><br>
                        <label for="">
                            <input style="width:100px" type="numeric" name="ikhlaq-get" title="حاصل کردہ نمبر" required="" />
                            <b>کل نمبر</b>
                            <input style="width:100px" type="numeric" name="ikhlaq-total" value="20" title="کل نمبر" required="" />
                            <b>حاصل کردہ نمبر</b>
                        </label>
                    </div>

                    <div class="input-feiled">
                        <h3 style="color:green">:زبان (عربی، اردو)</h3><br>
                        <label for="">
                            <input style="width:100px" type="numeric" name="language-get" title="حاصل کردہ نمبر" required="" />
                            <b>کل نمبر</b>
                            <input style="width:100px" type="numeric" name="language-total" value="20" title="کل نمبر" required="" />
                            <b>حاصل کردہ نمبر</b>
                        </label>
                    </div>

                    <div class="input-feiled">
                        <h3 style="color:green">:نماز کی ڈائری</h3><br>
                        <label for="">
                            <input style="width:100px" type="numeric" name="namaz-get" title="حاصل کردہ نمبر" required="" />
                            <b>کل نمبر</b>
                            <input style="width:100px" type="numeric" name="namaz-total" value="10" title="کل نمبر" required="" />
                            <b>حاصل کردہ نمبر</b>
                        </label>
                    </div>

                    <!-- <div class="input-feiled">
                        <h3 style="color:green">:طالب علم طالبہ کی حاضری</h3><br>
                        <label for="">
                            <input style="width:100px" type="numeric" name="attend-get" title="حاصل کردہ نمبر" required="" />
                            <b>کل نمبر</b>
                            <input style="width:100px" type="numeric" name="attend-total" title="کل نمبر" required="" />
                            <b>حاصل کردہ نمبر</b>
                        </label>
                    </div> -->

                    <div style="display:none" class="input-feiled">
                        <h3 style="color:green">:کل میزان</h3><br>
                        <label for="">
                            <input style="width:100px" type="numeric" name="hasil" title="حاصل کردہ نمبر" required="" />
                            <b>کل نمبر</b>
                            <input style="width:100px" type="numeric" name="kul_num" title="کل نمبر" required="" />
                            <b>حاصل کردہ نمبر</b>
                        </label>
                    </div>

                    <div style="display:none" class="input-feiled">
                        <label for="">
                            <b>* درجۃ کامیابی</b><br>
                            <input type="text" name="grade" id="grade" title="درجۃ کامیابی" required="" />
                        </label>
                    </div>

                    <input type="submit" id="inner-btn" name="exam-form-submit" value="محفوظ" title="ڈیٹا کو صیو کریں">
                </div>
            </div>
        </form>

    </div>

    <?php
    include('C:\xampp\htdocs\pos\assets\footer.php');
    ?>

    <script scr="js/jquery.js"></script>

    <script>
        $(document).ready(function() {
            Date.prototype.toDateInputValue = (function() {
                var local = new Date(this);
                local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
                return local.toJSON().slice(0, 10);
            });
            $('#from-date').val(new Date().toDateInputValue());
            $('#to-date').val(new Date().toDateInputValue());
            $('#date-of-exam').val(new Date().toDateInputValue());

            $("#gr-number").focusout(function() {
                var i = $('#gr-number').val();
                var from_date = $('#from-date').val();
                var to_date = $('#to-date').val();
                $.ajax({
                    url: "std_confirm.php",
                    type: "POST",
                    data: {
                        gr_no: i,
                    },
                    success: function(data) {
                        var token = data.split("*");
                        var a = $('#gr-number').val();
                        var b = token[0];
                        $("#exam-roll-number").val(token[1]);
                        var inta = parseInt(a);
                        var intb = parseInt(b);
                        if (inta != intb) {
                            $("#error-alert").fadeIn("slow");
                            $('#gr-number').val("");

                        }
                    }
                });
                $.ajax({
                    url: "get_total_class.php",
                    type: "POST",
                    data: {
                        gr_no: i,
                        from_date: from_date,
                        to_date: to_date
                    },
                    success: function(data) {
                        var present = data;
                        var intpresent = parseInt(present);
                        $('#total-class').val(intpresent);
                    }
                });
                $.ajax({
                    url: "get_total_present.php",
                    type: "POST",
                    data: {
                        gr_no: i,
                        from_date: from_date,
                        to_date: to_date
                    },
                    success: function(data) {
                        var present = data;
                        var intpresent = parseInt(present);
                        $('#student-present').val(intpresent);
                    }
                });

            });
            $("#gr-number").keyup(function() {
                $("#error-alert").hide();
                $("#ok-alert").hide();
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#inner-btn,#outter-btn').click(function() {



                var student_present = $('#student-present').val();
                var total_class = $('#total-class').val();
                var percentage = student_present * 100 / total_class;
                $('#student-absent').val(total_class - student_present);
                var quran_total = $('[name="quran-total"]').val();
                var emaniat_total = $('[name="emaniat-total"]').val();
                var hadees_total = $('[name="hadees-total"]').val();
                var ikhlaq_total = $('[name="ikhlaq-total"]').val();
                var language_total = $('[name="language-total"]').val();
                var namaz_total = $('[name="namaz-total"]').val();
                var attend_total = 10;
                var quran_get = $('[name="quran-get"]').val();
                var emaniat_get = $('[name="emaniat-get"]').val();
                var hadees_get = $('[name="hadees-get"]').val();
                var ikhlaq_get = $('[name="ikhlaq-get"]').val();
                var language_get = $('[name="language-get"]').val();
                var namaz_get = $('[name="namaz-get"]').val();
                // var attend_get = $('[name="attend-get"]').val();
                var percentage = student_present * 100 / total_class;
                if (percentage == 100) {
                    attend_get = 10;
                } else if (percentage > 89) {
                    attend_get = 8;
                } else if (percentage > 79) {
                    attend_get = 6;
                } else if (percentage > 69) {
                    attend_get = 4;
                } else if (percentage > 59) {
                    attend_get = 2;
                } else {
                    attend_get = 0;
                }
                var kul_num = parseInt(quran_total) + parseInt(emaniat_total) + parseInt(hadees_total) + parseInt(ikhlaq_total) + parseInt(language_total) + parseInt(namaz_total) + parseInt(attend_total);
                var hasil = parseInt(quran_get) + parseInt(emaniat_get) + parseInt(hadees_get) + parseInt(ikhlaq_get) + parseInt(language_get) + parseInt(namaz_get) + parseInt(attend_get);
                $('[name="kul_num"]').val(kul_num);
                $('[name="hasil"]').val(hasil);
                var per = hasil * 100 / kul_num;
                $('#percent').val(per.toFixed(2));
                if (per > 79) {
                    $('[name="grade"]').val("ممتاز");
                } else if (per > 69) {
                    $('[name="grade"]').val("جیدجدا");
                } else if (per > 59) {
                    $('[name="grade"]').val("جید");
                } else if (per > 49) {
                    $('[name="grade"]').val("مقبول");
                } else {
                    $('[name="grade"]').val("راسب");
                }
            });
        });
    </script>

    <!-- Script -->
    <!-- <script>
        const inputFile = document.getElementById("inputFile");
        const imagePreview = document.getElementById("imageP");
        const src_image = imagePreview.querySelector(".image-preview__image");

        // Evnet listner
        inputFile.addEventListener("change", function() {
            const file = this.files[0];

            if (file) {
                const reader = new FileReader();

                reader.addEventListener("load", function() {
                    src_image.setAttribute("src", this.result);
                });

                reader.readAsDataURL(file);
            } else {
                src_image.setAttribute("src", "http://localhost/pos/img/profile/default.jpg");
            }
            // console.log(file);
        });
    </script> -->
</body>

</html>