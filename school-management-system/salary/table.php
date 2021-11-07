<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "madrassa";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    $sql = "CREATE TABLE fees (
      fee_id INT(10) AUTO_INCREMENT PRIMARY KEY,
      GR_no INT(10) NOT NULL,
      date_of_submit date NOT NULL,
      fee_month INT NOT NULL,
      fee_year INT NOT NULL,
      monthly_fees INT NOT NULL,
      yearly_fees INT,
      remianing INT,
      challan INT,
      total INT,
      discount INT,
      recieved INT,
      status_ VARCHAR(10),
      FOREIGN KEY (GR_no) REFERENCES students(GR_no)
    --   reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP  
    )";
    if ($conn->query($sql) === TRUE) {
        echo "Table created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }

    $conn->close();
}
