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
    $sql = "SELECT GR_no from teachers ORDER BY GR_no DESC LIMIT 1";
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
    <title>ناظمہ / ناظم تقرر فارم</title>
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
            <p>معلمین و ملازمین</p>
        </div>
        <form action="teacher-admission-form.php" method="post" enctype="multipart/form-data" target="blank_">

            <div class="right">
                <div class="text-align-center">

                    <div class="image" id="imageP">
                        <img src="http://localhost/pos/img/profile-teacher/default.jpg" alt="فوٹو" class="image-preview__image">
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
                            echo '<input type="numeric" name="gr-number" value="' . $gr_no . '" title="مسلسل رجسٹرنمبر" readonly required>';
                            ?>
                        </label>
                    </div>

                    <div class="input-feiled">
                        <label for="">
                            <b>* نام ناظم / ناظمہ</b><br>
                            <input type="text" name="name-of-teacher" title="نام معلمین و ملازمین" required="" />
                        </label>
                    </div>

                    <div class="input-feiled">
                        <label for="">
                            <b>* جنس</b><br>
                            <select name="gender" class="selection" id="" title="جنس" required="" required>
                                <option value="" disabled selected>جنس</option>
                                <option value="مرد">مرد</option>
                                <option value="عورت">عورت</option>
                            </select>
                        </label>
                    </div>

                    <div class="input-feiled">
                        <label for="">
                            <b>* ولدیت</b><br>
                            <input type="text" name="father-name" title="ولدیت" required="" />
                        </label>
                    </div>

                </div>
                <input type="submit" id="outter-btn" class="btn" name="admission-form-submit" value="محفوظ" title="ڈیٹا کو صیو کریں">
            </div>

            <div class="left">
                <div class="text-align-center">

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

                    <div class="input-feiled">
                        <label for="">
                            <b>* مقررہ مشاہرہ</b><br>
                            <input type="numeric" name="monthly-salary" title="مقررہ مشاہرہ" required="" />
                        </label>
                    </div>

                    <div class="input-feiled">
                        <label for="">
                            <b>* عہدہ</b><br>
                            <input type="text" name="designation" title="عہدہ" required="">
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
                            <b>* موبائل نمبر</b><br>
                            <input type="numeric" name="mobile-number" title="موبائل نمبر" required="">
                        </label>
                    </div>

                    <div class="input-feiled">
                        <label for="">
                            <b> * تعلیمی قابلیت</b><br>
                            <input type="text" name="qualification" title="تعلیمی قابلیت" require>
                        </label>
                    </div>

                    <input type="submit" id="inner-btn" class="btn" name="admission-form-submit" value="محفوظ" title="ڈیٹا کو صیو کریں">
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
                src_image.setAttribute("src", "img/profile/default.jpg");
            }
            // console.log(file);
        });
    </script>
</body>

</html>