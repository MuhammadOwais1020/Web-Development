<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "madrassa";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    $sql = "CREATE TABLE teachers (
      GR_no INT(10) AUTO_INCREMENT PRIMARY KEY,
      teacher_name VARCHAR(50) NOT NULL,
      gender_g VARCHAR(10) NOT NULL,
      disability VARCHAR(50) NOT NULL,
      father_name VARCHAR(50) NOT NULL,
      sir_name VARCHAR(30) NOT NULL,
      date_of_birth DATE NOT NULL,
      date_of_admission DATE NOT NULL,
      monthly_salary INT NOT NULL,
      designation VARCHAR(50) NOT NULL,
      complete_address VARCHAR(50) NOT NULL,
      CNIC INT(13) NOT NULL,
      contact INT(11) NOT NULL,
      qualification VARCHAR(50) NOT NULL,
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
