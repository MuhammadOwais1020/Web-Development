<?php
$image_name = "";
$gr_number = 0;
$student_name = "";
$gender = "";
$disability = "";
$father_name = "";
$cast = "";
$date_of_birth = "";
$date_of_admission  = "";
$monthly_fees = "";
$address = "";
$cnic = 0;
$office_mobile_number = 0;
$mobile_number_home = 0;
$qualification = "";
$last_school_name = "";
$last_school_address = "";
$reason_to_leave_school = "";
$class = "";
$class_type = "";
$department = "";
$occupation = "";
$time_of_class = "";
$monthly_discount = 0;

$remaining_account_balance = 0;
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
    $sql = "SELECT * FROM students WHERE GR_no = " . $_POST['gr-id'];
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $gr_number = $row['GR_no'];
            $student_name = $row['student_name'];
            $gender = $row['gender_g'];
            $disability = $row['disability'];
            $father_name = $row['father_name'];
            $cast = $row['sir_name'];
            $date_of_birth = $row['date_of_birth'];
            $date_of_admission  = $row['date_of_admission'];
            $monthly_fees = $row['monthly_fees'];
            $address = $row['complete_address'];
            $cnic = $row['CNIC'];
            $office_mobile_number = $row['contact_office'];
            $mobile_number_home = $row['contact_home'];
            $qualification = $row['qualification'];
            $last_school_name = $row['last_school_name'];
            $last_school_address = $row['last_school_address'];
            $reason_to_leave_school = $row['reason_for_leave_school'];
            $class = $row['class'];
            $class_type = $row['class_type'];
            $department = $row['department'];
            $occupation = $row['occupation'];
            $time_of_class = $row['time_for_study'];
            $image_name = $row['image_name'];
            $monthly_discount = $row['discount'];
        }

        //retrieve remaining account balance 

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            $error_message = "Connection failed: " . $conn->connect_error;
            $error = True;
        } else {
            $sql = "SELECT remaning_balance FROM remaining WHERE GR_no = " . $_POST['gr-id'];
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $remaining_account_balance = $row['remaning_balance'];
                }
            } else {
                $remaining_account_balance = 0;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>طالب علم پروفائل</title>
    <?php
    include('C:\xampp\htdocs\pos\assets\header.php');
    ?>
    <style>
        .container-pro-box {
            height: 1300px;
        }

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
    <div class="container-pro-box">
        <div class="heading">
            <p>طالب علم / طالبہ</p>
        </div>
        <div style="font-size: 16px; padding:10px;">
            <br>
            <div class="alert-message" id="success-message">
                <div class="alert alert-success">
                    <strong>کامیابی</strong>! ڈیٹا حزف ہو گیا ہے۔ شکریہ
                </div>
            </div>
            <div class="alert-message" id="error-message">
                <div class="alert alert-danger">
                    <strong>معزرت</strong>! مہربانی کر کہ دوباراہ کوشیش کریں۔ شکریہ
                </div>
            </div>
        </div>

        <?php
        if ($gr_number != 0) {
            echo '<input type="text" name="" id="class-hide" value="' . $class . '" style="display: none;">';
            echo '<input type="text" name="" id="class-type-hide" value="' . $class_type . '" style="display: none;">';
            echo '<div id="data-to-show">';
            echo '<div class="right">';
            echo '<p> مسلسل رجسٹر نمبر: ' . $gr_number . '</p>';
            echo '<p>طالب علم / طالبہ: ' . $student_name . '</p>';
            echo '<p>جنس: ' . $gender . '</p>';
            echo '<p>معزوری: ' . $disability . '</p>';
            echo '<p>ولدیت: ' . $father_name . '</p>';
            echo '<p>قوم: ' . $cast . '</p>';
            echo '<p>تاریخ پیدائش: ' . $date_of_birth . '</p>';
            echo '<p>تاریخ داخلہ: ' . $date_of_admission . '</p>';
            echo '<p>ماہانہ فیس: ' . $monthly_fees . '</p>';
            echo '<p>رعایت: ' . $monthly_discount . '</p>';
            echo '<p>مکمل رہائشی پتہ: ' . $address . '</p>';
            echo '<p>قومی شناختی کارڈ نمبر: ' . $cnic . '</p>';

            echo '</div>';
            echo '<div class="left">';

            echo '<div class="image" id="imageP">';
            echo '<img src="http://localhost/pos/img/profile/' . $image_name . '" alt="فوٹو" class="image-preview__image">';
            echo '</div>';
            echo '<p>موبائل نمبر دفتر: ' . $office_mobile_number . '</p>';
            echo '<p>موبائل نمبر گھر: ' . $mobile_number_home . '</p>';
            echo '<p>تعلیمی قابلیت: ' . $qualification . '</p>';
            echo '<p>سابقہ مکتب کانام: ' . $last_school_name . '</p>';
            echo '<p>سابقہ مکتب کا پتہ: ' . $last_school_address . '</p>';
            echo '<p>سابقہ مکتب جھوڑنے کی وجہ: ' . $reason_to_leave_school . '</p>';
            echo '<p>مطلوبہ درجہ: ' . $class . '</p>';
            echo '<p>سیکشن: ' . $class_type . '</p>';
            echo '<p>شعبہ: ' . $department . '</p>';
            echo '<p>پیشہ: ' . $occupation . '</p>';
            echo '<p>تعلیم کا وقت: ' . $time_of_class . '</p>';
            if ((float)$remaining_account_balance > 0) {
                echo '<p style="color:red">بقایاجات : ' . $remaining_account_balance . '</p>';
            } else {
                echo '<p>بقایاجات : ' . $remaining_account_balance . '</p>';
            }
            echo '</div>';
            echo '</div>';
        } else {
            echo '<div class="alert alert-danger">';
            echo '<strong>غلطی</strong>! یہ ڈیٹا ڈلیٹ ہو چوکا ہے۔ شکریہ';
            echo '</div>';
        }

        echo '<div id="data-updated">';
        echo '';
        echo '<form id="submit_update">';
        echo '<div class="right">';
        echo '<div class="text-align-center">';
        echo '';
        echo '<div class="image" id="imageP">';
        echo '<img src="http://localhost/pos/img/profile/' . $image_name . '" alt="فوٹو" class="image-preview__image">';
        echo '</div>';
        echo '';
        echo '<br class="b-r"><br class="b-r"><br class="b-r"><br class="b-r"><br class="b-r"><br class="b-r"><br class="b-r"><br class="b-r"><br class="b-r"><br class="b-r"><br class="b-r"> <br>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* تصویر</b><br>';
        echo '<input type="file" name="image" accept="image/*" id="inputFile" title="تصویر">';
        echo '</label>';
        echo '</div>';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b> * مسلسل رجسٹرنمبر</b><br />';
        echo '<input type="numeric" name="gr" id="gr-number" title="مسلسل رجسٹرنمبر" value="' . $gr_number . '" readonly>';
        echo '</label>';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* نام طالب علم/ طالبہ</b><br>';
        echo '<input type="text" id="name-of-student" name="s_name" title="نام طالب علم/ طالبہ" value="' . $student_name . '" required="" />';
        echo '</label>';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* جنس</b><br>';
        echo '<select id="gender" class="selection" name="gender" id="" title="جنس" required="" required>';
        echo '<option value="' . $gender . '" selected>' . $gender . '</option>';
        echo '<option value="لڑکا">لڑکا</option>';
        echo '<option value="لڑکی">لڑکی</option>';
        echo '<option value="غیر">غیر</option>';
        echo '</select>';
        echo '</label>';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* معزوری</b><br>';
        echo '<input type="text" id="disability" name="disability" title="معزوری" value="' . $disability . '" required="">';
        echo '</label>';
        echo '';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* ولدیت</b><br>';
        echo '<input type="text" id="father-name" name="father_name" title="ولدیت" value="' . $father_name . '" required="" />';
        echo '</label>';
        echo '';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* قوم</b><br>';
        echo '<input type="text" id="sir-name" name="cast" title="قوم" value="' . $cast . '" required="" />';
        echo '</label>';
        echo '';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* تاریخ پیدائش</b><br>';
        echo '<input type="date" id="date-of-birth" name="date_of_birth" title="تاریخ پیدائش" value="' . $date_of_birth . '" required="" />';
        echo '</label>';
        echo '';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* تاریخ داخلہ</b><br>';
        echo '<input type="date" id="date-of-admission" name="date_of_admission" title="تاریخ داخلہ" value="' . $date_of_admission . '" required="" />';
        echo '</label>';
        echo '';
        echo '</div>';
        echo '';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* ماہانہ فیس</b><br>';
        echo '<input type="numeric" id="fees" title="ماہانہ فیس" name="monthly_fees" value="' . $monthly_fees . '" required="" />';
        echo '</label>';
        echo '</div>';
        echo '</div>';
        echo '<input type="submit" id="outter-btn" class="update-form-data" id="admission-form-submit" value="ڈیٹا کو صیو کریں" title="ڈیٹا کو صیو کریں">';
        echo '</div>';
        echo '';
        echo '<div class="left">';
        echo '<div class="text-align-center">';

        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* رعایت</b><br>';
        echo '<input type="numeric" id="monthly-discount" name="monthly_discount" title="رعایت" value="' . $monthly_discount . '" required="" />';
        echo '</label>';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* مکمل رہائشی پتہ</b><br>';
        echo '<input type="text" id="address" name="address" title="مکمل رہائشی پتہ" value="' . $address . '" required="" />';
        echo '</label>';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* قومی شناختی کارڈ نمبر</b><br>';
        echo '<input type="numeric" id="CNIC" name="cnic" title="قومی شناختی کارڈ نمبر" value="' . $cnic . '" required="">';
        echo '</label>';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* موبائل نمبر دفتر</b><br>';
        echo '<input type="numeric" id="mobile-number-office" name="mobile_number_office" title="موبائل نمبر دفتر" value="' . $office_mobile_number . '" required="">';
        echo '</label>';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>موبائل نمبر گھر</b><br>';
        echo '<input type="numeric" id="mobile-number-home" name="mobile_number_home" title="موبائل نمبر گھر" value="' . $mobile_number_home . '">';
        echo '</label>';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* تعلیمی قابلیت</b><br>';
        echo '<input type="text" id="qualification" name="qualification" title="تعلیمی قابلیت" required="" value="' . $qualification . '">';
        echo '</label>';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>سابقہ مکتب کانام</b><br>';
        echo '<input type="text" id="last-school-name" name="last_school_name" value="' . $last_school_name . '" title="سابقہ مکتبکا نام">';
        echo '</label>';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>سابقہ مکتب کا پتہ</b><br>';
        echo '<input type="text" id="last-school-address" name="last_school_address" value="' . $last_school_address . '" title="سابقہ مکتب کا پتہ">';
        echo '</label>';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>سابقہ مکتب چھوڑنے کی وجہ</b><br>';
        echo '<input type="text" id="reason-to-leave-last-school" name="reason_to_leave_last_school" value="' . $reason_to_leave_school . '" title="سابقہ مکتب چھوڑنے کی وجہ">';
        echo '</label>';
        echo '</div>';

        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* مطلوبہ درجہ</b><br>';
        echo '<select name="class_" class="selection" id="class-section" title="مطلوبہ درجہ" required="" >';
        echo '<option value="ابتدائیہ">ابتدائیہ</option>';
        echo '<option value="اول">اول</option>';
        echo '<option value="دوم">دوم</option>';
        echo '<option value="سوم">سوم</option>';
        echo '<option value="چہارم">چہارم</option>';
        echo '<option value="پنجم">پنجم</option>';
        echo '</select>';
        echo '</label>';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* سیکشن</b><br>';
        echo '<select name="class-type" class="selection" id="class-type-section" title="سیکشن" required="" required>';
        echo '<option value="الف">الف</option>';
        echo '<option value="ب">ب</option>';
        echo '<option value="ج">ج</option>';
        echo '<option value="د">د</option>';
        echo '</select>';
        echo '</label>';
        echo '</div>';

        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* شعبہ</b><br>';
        echo '<input type="text" id="department" title="شعبہ" name="department" value="' . $department . '" required="">';
        echo '</label>';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* پیشہ</b><br>';
        echo '<input type="text" id="occupation" title="پیشہ" name="occupation" value="' . $occupation . '" required="">';
        echo '</label>';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* تعلیم کا وقت</b><br>';
        echo '<select id="time-of-class" class="selection" id="" name="time_of_class" title="تعلیم کا وقت" value="' . $time_of_class . '" required="" required>';
        echo '<option value="' . $time_of_class . '" selected>' . $time_of_class . '</option>';
        echo '<option value="بعد از فجر">بعد از فجر</option>';
        echo '<option value="بعد از ظہر">بعد از ظہر</option>';
        echo '<option value="بعد از عصر">بعد از عصر</option>';
        echo '<option value="بعد از مغرب">بعد از مغرب</option>';
        echo '<option value="بعد از عشاء">بعد از عشاء</option>';
        echo '<option value="کل وقت">کل وقت</option>';
        echo '</select>';
        echo '</label>';
        echo '</div>';
        echo '';
        echo '<input type="submit" id="inner-btn" name="admission-form-submit" class="update-form-data" value="ڈیٹا کو صیو کریں" title="ڈیٹا کو صیو کریں">';
        echo '</div>';
        echo '</div>';
        echo '</form>';
        echo '</div>';
        ?>


        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <br>
        <div class="data-modification">
            <form action="student-admission-form.php" method="post" target="_blank">
                <?php
                echo '<input type="text" name="gr-id" id="gr-no" value="' . $gr_number . '" style="display:none;">';
                ?>
                <input type="submit" name="print" value="پرینٹ کرو" class="btn btn-primary" id="print-info">
            </form>

            <input type="submit" name="delete" value="حزف کرو" class="btn btn-danger" id="delete-info">

            <input type="submit" name="update" value="ترمیم کرو" class="btn btn-success" id="update-info">
        </div>
    </div>

    <?php
    include('C:\xampp\htdocs\pos\assets\footer.php');
    ?>

    <script>
        $(document).ready(function() {
            // change image
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

            // delete record
            function delete_record(gr) {
                if (confirm("کیا آپ واقع حزف کرنا چاہتے ہیں؟")) {

                    $.ajax({
                        url: "student-delete.php",
                        type: "POST",
                        data: {
                            id: gr
                        },
                        success: function(data) {
                            if (data == 1) {
                                $("#update-info, #delete-info, #print-info, .left, .right").fadeOut();
                                $("#success-message").fadeIn();
                                $("#error-message").fadeOut();
                            } else {
                                $("#error-message").fadeIn();
                                $("#message-message").fadeOut();
                            }
                        }
                    });
                }
            }
            // Delete record
            $("#delete-info").on("click", function(e) {
                var gr = $("#gr-no").val();

                $.ajax({
                    url: "remaining_check.php",
                    type: "POST",
                    data: {
                        id: gr
                    },
                    success: function(data) {
                        if (data == 0) {
                            delete_record(gr);
                        } else if (data > 0) {
                            alert(data + " شاگرد کی طرف فیس ریہتی ہے۔ شکریہ ");
                            delete_record(gr);
                        } else if (data < 0) {
                            alert(data + " آپ کی طرف شاگرد کے پیسے ریہتے ہیں۔ شکریہ ");
                            delete_record(gr);
                        } else {
                            alert("معزرت سیسٹم میں مسلے کی وجہ سے ریکارڈ ڈلیٹ نہیں ہوا۔ دوباراں کوشیش کریں۔ شکریہ");
                        }
                    }
                });

            });

            // Show form 
            $("#update-info").on("click", function(e) {
                var class_hide = $("#class-hide").val() != "" ? $("#class-hide").val() : "";
                var class_type_hide = $("#class-type-hide").val() != "" ? $("#class-type-hide").val() : "";

                $("#class-section").val(class_hide);
                $("#class-type-section").val(class_type_hide);

                $("#data-updated").show();
                $("#data-to-show").hide();
                $(".data-modification").hide();
                $(".container-pro-box").css("height", "1200px");

            });
            // Hide form
            $("#submit_update").on("submit", function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "update.php",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if (data == 1) {
                            $("#data-updated").hide();
                            $("#data-to-show").show();
                            $(".data-modification").show();
                            $(".container-pro-box").css("height", "700px");

                            loadData(); //Load data
                        } else {
                            alert(data);
                        }
                    }
                });
            });

            // Load data fucntion 
            function loadData() {
                var gr = $("#gr-no").val();
                $.ajax({
                    url: "load-student-data.php",
                    type: "POST",
                    data: {
                        id: gr
                    },
                    success: function(data) {
                        $("#data-to-show").html(data);
                    }
                });
            }
        });
    </script>
</body>

</html>