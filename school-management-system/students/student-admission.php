<?php

$gr_no = 0;

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
    $sql = "SELECT GR_no from students ORDER BY GR_no DESC LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $gr_no = $row['GR_no'];
        }
        $gr_no += 1;
    } else {
        $gr_no = 1;
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>طالب علم داخلہ فارم</title>
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

    <?php
    include('C:\xampp\htdocs\pos\assets\nav-bar.php');
    ?>

    <div class="container-box">
        <div class="heading">
            <p>طالب علم داخلہ فارم</p>
        </div>
        <form action="student-admission-form.php" method="post" enctype="multipart/form-data" target="_blank">

            <div class="right">
                <div class="text-align-center">

                    <div class="image" id="imageP">
                        <img src="http://localhost/pos/img/profile/default.jpg" alt="فوٹو" class="image-preview__image">
                    </div>

                    <br class="b-r"><br class="b-r"><br class="b-r"><br class="b-r"><br class="b-r"><br class="b-r"><br class="b-r"><br class="b-r"><br class="b-r"><br class="b-r"><br class="b-r"> <br>

                    <div class="input-feiled">
                        <label for="">
                            <b>* تصویر</b><br>
                            <input type="file" name="image" accept="image/*" id="inputFile" title="تصویر" required>
                        </label>
                    </div>

                    <div class="input-feiled">
                        <label for="">
                            <b> * مسلسل رجسٹرنمبر</b><br />
                            <?php
                            echo '<input type="numeric" name="gr-number" title="مسلسل رجسٹرنمبر" value="' . $gr_no . '" readonly required>';
                            ?>
                        </label>
                    </div>

                    <div class="input-feiled">
                        <label for="">
                            <b>* نام طالب علم/ طالبہ</b><br>
                            <input type="text" name="name-of-student" title="نام طالب علم/ طالبہ" required="" />
                        </label>
                    </div>

                    <div class="input-feiled">
                        <label for="">
                            <b>* جنس</b><br>
                            <select name="gender" class="selection" id="" title="جنس" required="" required>
                                <option value="" disabled selected>جنس</option>
                                <option value="لڑکا">لڑکا</option>
                                <option value="لڑکی">لڑکی</option>
                                <option value="مرد">مرد</option>
                                <option value="عورت">عورت</option>

                            </select>
                        </label>
                    </div>

                    <div class="input-feiled">
                        <label for="">
                            <b>* معزوری</b><br>
                            <input type="text" name="disability" title="معزوری" value="کوئی نہیں" required="">
                        </label>

                    </div>

                    <div class="input-feiled">
                        <label for="">
                            <b>* ولدیت</b><br>
                            <input type="text" name="father-name" title="ولدیت" required="" />
                        </label>

                    </div>

                    <div class="input-feiled">
                        <label for="">
                            <b>* قوم</b><br>
                            <input type="text" name="sir-name" title="قوم" required="" />
                        </label>

                    </div>

                    <div class="input-feiled">
                        <label for="">
                            <b>* تاریخ پیدائش</b><br>
                            <input type="date" name="date-of-birth" title="تاریخ پیدائش" required="" />
                        </label>

                    </div>

                    <div class="input-feiled">
                        <label for="">
                            <b>* تاریخ داخلہ</b><br>
                            <input type="date" name="date-of-admission" title="تاریخ داخلہ" required="" />
                        </label>

                    </div>

                </div>
                <input type="submit" id="outter-btn" name="admission-form-submit" value="محفوظ" title="ڈیٹا کو صیو کریں">
            </div>

            <div class="left">
                <div class="text-align-center">

                    <div class="input-feiled">
                        <label for="">
                            <b>* ماہانہ فیس</b><br>
                            <input type="numeric" name="monthly-fees" title="ماہانہ فیس" required="" />
                        </label>
                    </div>

                    <div class="input-feiled">
                        <label for="">
                            <b>* رعایت</b><br>
                            <input type="numeric" name="monthly-discount" title="رعایت" value="0" required="" />
                        </label>
                    </div>

                    <div class="input-feiled">
                        <label for="">
                            <b>* مکمل رہائشی پتہ</b><br>
                            <input type="text" name="address" title="مکمل رہائشی پتہ" required="" />
                        </label>
                    </div>

                    <div class="input-feiled">
                        <label for="">
                            <b>* قومی شناختی کارڈ نمبر</b><br>
                            <input type="numeric" name="CNIC" title="قومی شناختی کارڈ نمبر" required="">
                        </label>
                    </div>

                    <div class="input-feiled">
                        <label for="">
                            <b>* موبائل نمبر دفتر</b><br>
                            <input type="numeric" name="mobile-number-office" title="موبائل نمبر دفتر" required="">
                        </label>
                    </div>

                    <div class="input-feiled">
                        <label for="">
                            <b>موبائل نمبر گھر</b><br>
                            <input type="numeric" name="mobile-number-home" value="0" title="موبائل نمبر گھر">
                        </label>
                    </div>

                    <div class="input-feiled">
                        <label for="">
                            <b> تعلیمی قابلیت</b><br>
                            <input type="text" value="کوئی نہیں" name="qualification" title="تعلیمی قابلیت" required="">
                        </label>
                    </div>

                    <div class="input-feiled">
                        <label for="">
                            <b>سابقہ مکتب کانام</b><br>
                            <input type="text" name="last-school-name" value="کوئی نہیں" title="سابقہ مکتبکا نام">
                        </label>
                    </div>

                    <div class="input-feiled">
                        <label for="">
                            <b>سابقہ مکتب کا پتہ</b><br>
                            <input type="text" name="last-school-address" value="کوئی نہیں" title="سابقہ مکتب کا پتہ">
                        </label>
                    </div>

                    <div class="input-feiled">
                        <label for="">
                            <b>سابقہ مکتب چھوڑنے کی وجہ</b><br>
                            <input type="text" name="reason-to-leave-last-school" value="کوئی نہیں" title="سابقہ مکتب چھوڑنے کی وجہ">
                        </label>
                    </div>

                    <div class="input-feiled">
                        <label for="">
                            <b>* مطلوبہ درجہ</b><br>
                            <select name="class" class="selection" id="" title="مطلوبہ درجہ" required="" required>
                                <option value="ابتدائیہ">ابتدائیہ</option>
                                <option value="اول">اول</option>
                                <option value="دوم">دوم</option>
                                <option value="سوم">سوم</option>
                                <option value="چہارم">چہارم</option>
                                <option value="پنجم">پنجم</option>
                            </select>
                        </label>
                    </div>

                    <div class="input-feiled">
                        <label for="">
                            <b>* سیکشن</b><br>
                            <select name="class-type" class="selection" id="" title="سیکشن" required="" required>
                                <option value="الف">الف</option>
                                <option value="ب">ب</option>
                                <option value="ج">ج</option>
                                <option value="د">د</option>
                            </select>
                        </label>
                    </div>

                    <div class="input-feiled">
                        <label for="">
                            <b>* شعبہ</b><br>
                            <input type="text" name="department" title="شعبہ" required="">
                        </label>
                    </div>

                    <div class="input-feiled">
                        <label for="">
                            <b>* پیشہ</b><br>
                            <input type="text" name="occupation" title="پیشہ" required="">
                        </label>
                    </div>

                    <div class="input-feiled">
                        <label for="">
                            <b>* تعلیم کا وقت</b><br>
                            <select name="time-of-class" class="selection" id="" title="تعلیم کا وقت" required="" required>
                                <option value="" disabled selected>تعلیم کا وقت</option>
                                <option value="بعد از فجر">بعد از فجر</option>
                                <option value="بعد از ظہر">بعد از ظہر</option>
                                <option value="بعد از عصر">بعد از عصر</option>
                                <option value="بعد از مغرب">بعد از مغرب</option>
                                <option value="بعد از عشاء">بعد از عشاء</option>
                                <option value="کل وقت">کل وقت</option>
                            </select>
                        </label>
                    </div>

                    <input type="submit" id="inner-btn" name="admission-form-submit" value="محفوظ" title="ڈیٹا کو صیو کریں">
                </div>
            </div>
        </form>

    </div>

    <?php
    include('C:\xampp\htdocs\pos\assets\footer.php');
    ?>
    <!-- Script -->
    <script>
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
    </script>
</body>

</html>