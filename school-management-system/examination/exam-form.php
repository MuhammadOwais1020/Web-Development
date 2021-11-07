<?php
//Error variabls
$data_insertion = False;
$data_access = False;
$error = False;
$error_message = "";
//Data variabls

$image_name = "";
$gr_number = 0;
$exam_numer = 0;
$student_name = "";
$father_name = "";
$department = "";
$date_of_exam  = "";
$exam_teacher_name = "";
$performance = "";
$quran_total = 0;
$quran_get = 0;
$emaniat_total = 0;
$emaniat_get = 0;
$hadees_total = 0;
$hadees_get = 0;
$ikhlaq_total = 0;
$ikhlaq_get = 0;
$language_total = 0;
$language_get = 0;
$namaz_total = 0;
$namaz_get = 0;
$attend_total = 10;
$attend_get = 0;
$total_class = 0;
$student_percent = 0;
$student_absent = 0;
$percent = 0;
$class = "";
$grade = "";
$class_type = "";

// Data Insertion
if (isset($_POST['exam-form-submit'])) {
    $gr_number = $_POST['gr-number'];
    $exam_number = $_POST['exam-number'];
    $date_of_exam = $_POST['date-of-exam'];
    $exam_teacher_name  = $_POST['teacher-name'];
    $performance = $_POST['performance'];
    $quran_total = $_POST['quran-total'];
    $quran_get = $_POST['quran-get'];
    $emaniat_total = $_POST['emaniat-total'];
    $emaniat_get = $_POST['emaniat-get'];
    $hadees_total = $_POST['hadees-total'];
    $hadees_get = $_POST['hadees-get'];
    $ikhlaq_total = $_POST['ikhlaq-total'];
    $ikhlaq_get = $_POST['ikhlaq-get'];
    $language_total = $_POST['language-total'];
    $language_get = $_POST['language-get'];
    $namaz_total = $_POST['namaz-total'];
    $namaz_get = $_POST['namaz-get'];
    //$attend_total = $_POST['attend-total'];
    //$attend_get = $_POST['attend-get'];
    //$attend_get = 0;
    //$attend_total = 100;
    $total_class = $_POST['total-class'];
    $student_percent = $_POST['student-present'];
    $student_absent = $_POST['student-absent'];
    $grade = $_POST['grade'];
    $kul_num = $_POST['kul_num'];
    $hasil = $_POST['hasil'];
    $percent = $_POST['percent'];

    $id = 1;

    $percentage = $student_percent * 100 / $total_class;
    if ($percentage == 100) {
        $attend_get = 10;
    } elseif ($percentage > 89) {
        $attend_get = 8;
    } elseif ($percentage > 79) {
        $attend_get = 6;
    } elseif ($percentage > 69) {
        $attend_get = 4;
    } elseif ($percentage > 59) {
        $attend_get = 2;
    } else {
        $attend_get = 0;
    }

    //Database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "madrassa";
    $gr = 0;

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        $error_message = "Connection failed: " . $conn->connect_error;
        $error = True;
    } else {
        $sqlz = "select * from students where gr_no = " . $gr_number;
        $result = $conn->query($sqlz);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $gr = $row['GR_no'];
                // echo "Data has been saved!";      
            }
        } else {
            $error_message = "Error: " . $conn->error;
            $error = True;
        }
    }

    if ($gr == $gr_number) {
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            $error_message = "Connection failed: " . $conn->connect_error;
            $error = True;
        } else {
            //Insertion query
            $sql = "INSERT INTO examination(GR_no, exam_number, date_of_exam, teacher_name, performance, quran_total, quran_get, emaniat_total, emaniat_get, hadees_total, hadees_get, ikhlaq_total, ikhlaq_get, lang_total, lang_get, namaz_total, namaz_get, attend_total, attend_get, total_class, student_percent, student_absent, percent) VALUES ('$gr_number','$exam_number','$date_of_exam','$exam_teacher_name','$performance','$quran_total','$quran_get','$emaniat_total','$emaniat_get','$hadees_total','$hadees_get','$ikhlaq_total','$ikhlaq_get','$language_total','$language_get','$namaz_total','$namaz_get','$attend_total','$attend_get','$total_class','$student_percent','$student_absent','$percent');";

            if ($conn->query($sql) === TRUE) {
                $data_insertion = True;
                // echo "Data has been saved!"; 
            } else {
                $error_message = "Error: " . $conn->error;
                $error = True;
            }
        }
    } else {
        echo '<script>alert("شاگرد موجود نہیں ہیں");</script>';
    }
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "madrassa";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        $error_message = "Connection failed: " . $conn->connect_error;
        $error = True;
    } else {
        $sqlz = "select * from students where GR_no = " . $gr_number;
        $result = $conn->query($sqlz);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $class = $row['class'];
                $student_name = $row['student_name'];
                $father_name = $row['father_name'];
                $department = $row['department'];
                // echo "Data has been saved!";      
            }
        } else {
            $error_message = "Error: " . $conn->error;
            $error = True;
        }
        //$a++;
    }
}

// Data Access
if (isset($_POST['print'])) {
    //Database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "madrassa";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        $error_message = "Connection failed: " . $conn->connect_error;
        echo '<div class="alert-message">';
        echo '<div class="alert alert-danger" style="text-align: center; font-size:20px;">';
        echo '<strong>معزرت</strong>! مہربانی کر کہ دوباراہ کوشیش کریں۔ شکریہ ';
        echo '<br> ' . $error_message;
        echo '</div>';
        echo '</div>';
    } else {
        $sql = "SELECT * FROM examination INNER JOIN students ON examination.GR_no = students.GR_no WHERE examination.id = " . $_POST['id'];
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $student_name = $row['student_name'];
                $father_name = $row['father_name'];
                $class = $row['class'];
                $gr_number = $row['GR_no'];
                $exam_number = $row['exam_number'];
                $department = $row['department'];
                $date_of_exam = $row['date_of_exam'];
                $exam_teacher_name  = $row['teacher_name'];
                $performance = $row['performance'];
                $quran_total = $row['quran_total'];
                $quran_get = $row['quran_get'];
                $emaniat_total = $row['emaniat_total'];
                $emaniat_get = $row['emaniat_get'];
                $hadees_total = $row['hadees_total'];
                $hadees_get = $row['hadees_get'];
                $ikhlaq_total = $row['ikhlaq_total'];
                $ikhlaq_get = $row['ikhlaq_get'];
                $language_total = $row['lang_total'];
                $language_get = $row['lang_get'];
                $namaz_total = $row['namaz_total'];
                $namaz_get = $row['namaz_get'];
                $attend_total = $row['attend_total'];
                $attend_get = $row['attend_get'];
                //$attend_total = 10;
                //$attend_get = 0;
                $total_class = $row['total_class'];
                $student_percent = $row['student_percent'];
                $student_absent = $row['student_absent'];
                $percent = $row['percent'];
                $image_name = $row['image_name'];
                $class_type = $row['class_type'];
            }
            $data_access = True;
        }
    }
}

$hasil = intval($quran_total) + intval($emaniat_total) + intval($hadees_total) + intval($ikhlaq_total) + intval($language_total) + intval($namaz_total) + intval($attend_total);
$kul_num = intval($quran_get) + intval($emaniat_get) + intval($hadees_get) + intval($ikhlaq_get) + intval($language_get) + intval($namaz_get) + intval($attend_get);
$per = $kul_num * 100 / $hasil;
if ($per > 79) {
    $grade = "ممتاز";
} else if ($per > 69) {
    $grade = "جیدجدا";
} else if ($per > 59) {
    $grade = "جید";
} else if ($per > 49) {
    $grade = "مقبول";
} else {
    $grade = "راسب";
}

if ($data_access == True or $data_insertion == True) {
    include("C:/xampp/htdocs/pos/library/tcpdf.php");
    // require_once('library/tcpdf.php');

    $pdf = new TCPDF('p', 'mm', 'A4', true, 'UTF-8', false);

    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    // $fontname = $pdf->addTTFfont('C:\xampp\htdocs\pdf\library\mere\Jameel Noori Kasheeda.ttf', 'TrueTypeUnicode', '', 32);

    $pdf->AddPage();
    $pdf->Cell(189, 40);

    $pdf->Image('http://localhost/pos/img/logo/banner.jpg', 10, 10, 189);

    $pdf->Ln();
    $pdf->setFont('freeserif', '', 16);
    $urdu = "نتیجہ کارڈ براےٗ امتحان سالانہ";

    $pdf->WriteHTMLCell(195, 0, '', '', '<h1 style="background-color:#007348; color:white; border: solid 1px #007338; text-align:center; border-radius: 24px;">' . $urdu . '</h1>', 0, 1);

    $pdf->setFont('freeserif', '', 14);

    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">' . $exam_number . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">امتھان رول نمبر : </p>', 0, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">' . $gr_number . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">مسلسل رجسٹر نمبر : </p>', 0, 1);
    $pdf->ln(2);

    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">' . $father_name . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">ولدیت :</p>', 0, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">' . $student_name . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">نام طالب علم/ طالبہ :</p>', 0, 1);
    $pdf->ln(2);

    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">' . $department . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">شعبہ : </p>', 0, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">' . $date_of_exam . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">امتحان تاریخ : </p>', 0, 1);
    $pdf->ln(2);

    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">' . $exam_teacher_name . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">نام معالم/ معلمہ : </p>', 0, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">' . $class . ' - ' . $class_type . '</p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">تربیتی نصاب حصہ :  </p>', 0, 1);
    $pdf->ln(10);

    $pdf->WriteHTMLCell(50, 7, '', '', '<p style="text-align:center; font-weight:bold; color:green">حاصل کردہ نمبر</p>', 1, 0,);
    $pdf->WriteHTMLCell(50, 7, '', '', '<p style="text-align:center; font-weight:bold; color:green">کل نمبر</p>', 1, 0,);
    $pdf->WriteHTMLCell(90, 7, '', '', '<p style="text-align:center; font-weight:bold; color:green">مضامین</p>', 1, 1,);

    $pdf->WriteHTMLCell(50, 7, '', '', '<p style="text-align:right; font-weight:bold;"> ' . $quran_get . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(50, 7, '', '', '<p style="text-align:right; font-weight:bold;"> ' . $quran_total . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(90, 7, '', '', '<p style="text-align:right; font-weight:bold;">قرآن کریم/ نورانی قاعدہ :</p>', 1, 1);

    $pdf->WriteHTMLCell(50, 7, '', '', '<p style="text-align:right; font-weight:bold;">' . $emaniat_get . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(50, 7, '', '', '<p style="text-align:right; font-weight:bold;">' . $emaniat_total . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(90, 7, '', '', '<p style="text-align:right; font-weight:bold;">ایمانیات وعبادات :</p>', 1, 1);

    $pdf->WriteHTMLCell(50, 7, '', '', '<p style="text-align:right; font-weight:bold;">' . $hadees_get . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(50, 7, '', '', '<p style="text-align:right; font-weight:bold;">' . $hadees_total . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(90, 7, '', '', '<p style="text-align:right; font-weight:bold;">احادیث ومسنون دعاھین :</p>', 1, 1);

    $pdf->WriteHTMLCell(50, 7, '', '', '<p style="text-align:right; font-weight:bold;">' . $ikhlaq_get . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(50, 7, '', '', '<p style="text-align:right; font-weight:bold;">' . $ikhlaq_total . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(90, 7, '', '', '<p style="text-align:right; font-weight:bold;">سیرت واخلاق وعبادات :</p>', 1, 1);

    $pdf->WriteHTMLCell(50, 7, '', '', '<p style="text-align:right; font-weight:bold;">' . $language_get . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(50, 7, '', '', '<p style="text-align:right; font-weight:bold;">' . $language_total . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(90, 7, '', '', '<p style="text-align:right; font-weight:bold;">زبان (عربی، اردو) :</p>', 1, 1);

    $pdf->WriteHTMLCell(50, 7, '', '', '<p style="text-align:right; font-weight:bold;">' . $namaz_get . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(50, 7, '', '', '<p style="text-align:right; font-weight:bold;">' . $namaz_total . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(90, 7, '', '', '<p style="text-align:right; font-weight:bold;">نماز کی ڈاںری :</p>', 1, 1);

    $pdf->WriteHTMLCell(50, 7, '', '', '<p style="text-align:right; font-weight:bold;">' . $attend_get . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(50, 7, '', '', '<p style="text-align:right; font-weight:bold;">' . $attend_total . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(90, 7, '', '', '<p style="text-align:right; font-weight:bold;">طالب علم طالبہ کی حاضری :</p>', 1, 1);

    $pdf->WriteHTMLCell(50, 7, '', '', '<p style="text-align:right; font-weight:bold; color: green">' . $kul_num . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(50, 7, '', '', '<p style="text-align:right; font-weight:bold; color: green">' . $hasil . ' </p>', 1, 0);
    $pdf->WriteHTMLCell(90, 7, '', '', '<p style="text-align:right; font-weight:bold; color: green">کل میزان :</p>', 1, 1);
    $pdf->ln(10);

    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">' . $student_percent . '</p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">کل حاضریاں :  </p>', 0, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">' . $total_class . '</p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">کل ایام تعلیم :  </p>', 0, 1);
    $pdf->ln(2);

    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">' . $grade . '</p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">درجہ کامیابی : </p>', 0, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">' . $student_absent . '</p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">کل غیر حاضریاں : </p>', 0, 1);
    $pdf->ln(2);

    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;"> ' . $performance . '</p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">عملی کیفیت :</p>', 0, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">' . $percent . '%</p>', 1, 0);
    $pdf->WriteHTMLCell(47.5, 5, '', '', '<p style="text-align:right;">فیصد :  </p>', 0, 1);


    $pdf->Line(200, 230, 150, 230);
    $pdf->Line(80, 230, 130, 230);
    $pdf->Line(10, 230, 60, 230);

    $pdf->Cell(5, 28, "", 0, 1);
    $pdf->WriteHTMLCell(50, 7, '', '', '<p style="text-align:center; font-weight:bold;">دستخط سرپرست</p>', 0, 0);
    $pdf->WriteHTMLCell(90, 7, '', '', '<p style="text-align:center; font-weight:bold;">دستخط مقامی معاون</p>', 0, 0);
    $pdf->WriteHTMLCell(50, 7, '', '', '<p style="text-align:center; font-weight:bold;">دستخط معلم/ معلمہ</p>', 0, 1);
    // $pdf->WriteHTMLCell(140, 5, '', '', '<p style="text-align:center; font-weight:bold;"></p>', 1, 1);
    $file = "Marksheet Gr-no: " . $gr_number . " " . date("l\-jS\-F\-Y") . ".pdf";
    $pdf->Output($file);
} else {
    echo '<div class="alert-message">';
    echo '<div class="alert alert-danger" style="text-align: center; font-size:20px;">';
    echo '<strong>معزرت</strong>! مہربانی کر کہ دوباراہ کوشیش کریں۔ شکریہ ';
    echo '<br> ' . $error_message;
    echo '</div>';
    echo '</div>';
}
