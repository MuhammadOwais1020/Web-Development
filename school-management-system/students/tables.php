<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "madrassa";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    $sql = "CREATE TABLE students (
      GR_no INT(10) AUTO_INCREMENT PRIMARY KEY,
      student_name VARCHAR(50) NOT NULL,
      gender_g VARCHAR(10) NOT NULL,
      disability VARCHAR(50) NOT NULL,
      father_name VARCHAR(50) NOT NULL,
      sir_name VARCHAR(30) NOT NULL,
      date_of_birth DATE NOT NULL,
      date_of_admission DATE NOT NULL,
      monthly_fees INT NOT NULL,
      complete_address VARCHAR(50) NOT NULL,
      CNIC VARCHAR(13) NOT NULL,
      contact_office VARCHAR(11) NOT NULL,
      contact_home VARCHAR(11),
      qualification VARCHAR(50) NOT NULL,
      last_school_name VARCHAR(50),
      last_school_address VARCHAR(50),
      reason_for_leave_school VARCHAR(50),
      class VARCHAR(20) NOT NULL,
      department VARCHAR(20) NOT NULL,
      occupation VARCHAR(30) NOT NULL,
      time_for_study VARCHAR(30) NOT NULL,
      image_name VARCHAR(100) NOT NULL
    --   reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP  
    )";
    if ($conn->query($sql) === TRUE) {
        echo "Table created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }

    $conn->close();
}
