<?php
$sql = "CREATE TABLE remaining(
    ID INT AUTO_INCREMENT PRIMARY KEY,
    GR_no INT NOT NULL,
    remaning_balance INT(10) NOT NULL,
    FOREIGN KEY (GR_no) REFERENCES students(GR_no)
    )";
