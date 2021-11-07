<?php

$error_message = "";

if (isset($_POST['delete'])) {
    //Database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "madrassa";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        $error_message = "Connection failed: " . $conn->connect_error;
        echo '<div class="alert alert-danger" style="text-align: center; font-size:20px;">';
        echo '<strong>غلطی</strong>! مہربانی کر کہ دوباراہ کوشیش کریں۔ شکریہ ';
        echo '<br> ' . $error_message;
        echo '</div>';
    } else {
        $sql = "DELETE FROM students WHERE GR_no = " . $_POST['gr-id'];
        if (mysqli_query($conn, $sql)) {
            echo '<div class="alert alert-success">';
            echo '<strong>کامیابی</strong>! ڈیٹا ڈلیٹ ہو گیا ہے۔ شکریہ';
            echo '</div>';
        } else {
            $error_message = $conn->error;
            echo '<div class="alert alert-danger" style="text-align: center; font-size:20px;">';
            echo '<strong>غلطی</strong>! مہربانی کر کہ دوباراہ کوشیش کریں۔ شکریہ ';
            echo '<br> ' . $error_message;
            echo '</div>';
        }
        $conn->close();
    }
}
