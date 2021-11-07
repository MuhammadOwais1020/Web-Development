<?php

// Database Starts
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "covid";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else{

    //sql to create table
       $sql = "CREATE TABLE VirusData (
        id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        date_tim datetime,
        loca_tion varchar(30) NOT NULL,
        age int NOT NULL,
        gender varchar(6) NOT NULL,
        smoke int DEFAULT 0,
        
        diabetes int DEFAULT 0,
        hypertension int DEFAULT 0,
        ischemic_heart_disease int DEFAULT 0,
        chronic_lung_disease int DEFAULT 0,
        chronic_kidney_disease int DEFAULT 0,
        cancer int DEFAULT 0,
        asthma int DEFAULT 0,
        none_of_these int DEFAULT 0,
        
        travel int DEFAULT 0,
        temperature int,
    
        dry_cough int DEFAULT 0,
        shortness_of_breath int DEFAULT 0,
        diarrhea int DEFAULT 0,
        muscle_ache int DEFAULT 0,
        fatigue int DEFAULT 0,
        runny_nose_or_nasal_congestion int DEFAULT 0,
        sore_throat int DEFAULT 0,
        loss_of_smell_taste int DEFAULT 0,
        hot_fever int DEFAULT 0,
        headache int DEFAULT 0,
        nausea_and_or_vomiting int DEFAULT 0,
        none_of_them int DEFAULT 0,
    
        i_am_currently varchar(20),
        have_contact int DEFAULT 0
        )";
        
        if ($conn->query($sql) === TRUE) {
            echo "Table VirusData created successfully";
        } else {
            echo "Error creating table: " . $conn->error;
        }
        $conn->close();
}
?>