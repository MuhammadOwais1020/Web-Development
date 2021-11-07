<?php

if(isset($_POST['submit'])){
    $gender = "NULL";
    $smoke = "NULL";
    $smoke_bit = 0;
    $travel_bit = 0;
    $chk="";
    $date_time = "";
    $do_you_have[] = 0;
    $CS[] = 0;
    $sql = "";

    $dat_tim = date("Y-m-d h:i:sa");
    $location = $_POST['Location'];
    $age = $_POST['age'];
    if(isset($_POST['gender']))
        $gender = $_POST['gender'];
    if(isset($_POST['smoking']))
        $smoke = $_POST['smoking'];
    if($smoke == "Yes")
        $smoke_bit = 1;

    if(isset($_POST['travel']))
        $travel = $_POST['travel'];
    if($travel == "Yes")
        $travel_bit = 1;
    
    $temperature = $_POST['temperature'];

    if(isset($_POST['crrently']))
        $currently = $_POST['currently'];
    if(isset($_POST['ContactWithPerson']))
        $contact_with_person = $_POST['ContactWithPerson'];
    
//    $sql = "INSERT INTO virusdata (date_tim, loca_tion, age, gender, smoke, diabetes, travel, temperature, dry_cough, i_am_currently, have_contact)";
//    $sql .+ " VALUES(`$dat_tim`,`$location`,`$age`,`$gender`,`$smoke_bit`,,`$travel_bit`,`$temperature`,,`$currently`,'$contact_with_person_bit')";
   
    $CS = $_POST['Cst'];
    // Do you have?
    $do_you_have = $_POST['Do'];
    // Current Status
   // $hello = $_POST['Cst'];
    // // Current Status
    // $CS = $_POST['Cs'];
    // First
    if(count($do_you_have) == 1){
        $do_you_have1 = $do_you_have;

        if(count($CS) == 1){
            $CS1 = $CS[0];

            $sql = "INSERT INTO virusdata (date_tim, loca_tion, age, gender, smoke, diabetes, travel, temperature, dry_cough, i_am_currently, have_contact)";
            $sql .+ " VALUES(`$dat_tim`,`$location`,`$age`,`$gender`,`$smoke_bit`,`$do_you_have1`,`$travel_bit`,`$temperature`,`$CS1`,`$currently`,'$contact_with_person_bit')";
        }
        elseif(count($CS) == 2){
            for($j = 0; $j < 2; $j++)
                $CS2[$j] = $CS[$j];

            $sql = "INSERT INTO virusdata (date_tim, loca_tion, age, gender, smoke, diabetes, travel, temperature, dry_cough, shortness_of_breath, i_am_currently, have_contact)";
            $sql .+ " VALUES(`$dat_tim`,`$location`,`$age`,`$gender`,`$smoke_bit`,`$do_you_have1`,`$travel_bit`,`$temperature`,`$CS1`,`$CS2`,`$currently`,'$contact_with_person_bit')";
        }
        elseif(count($CS) == 3){
            for($j = 0; $j < 3; $j++)
                $CS3[$j] = $CS[$j];

            $sql = "INSERT INTO virusdata (date_tim, loca_tion, age, gender, smoke, diabetes, travel, temperature, dry_cough, shortness_of_breath, diarrhea, i_am_currently, have_contact)";
            $sql .+ " VALUES(`$dat_tim`,`$location`,`$age`,`$gender`,`$smoke_bit`,`$do_you_have1`,`$travel_bit`,`$temperature`,`$CS1`,`$CS2`,`$CS3`,`$currently`,'$contact_with_person_bit')";
        }
        elseif(count($CS) == 4){
            for($j = 0; $j < 4; $j++)
                $CS4[$j] = $CS[$j];

                $sql = "INSERT INTO virusdata (date_tim, loca_tion, age, gender, smoke, diabetes, travel, temperature, dry_cough, shortness_of_breath, diarrhea, muscle_ache, i_am_currently, have_contact)";
                $sql .+ " VALUES(`$dat_tim`,`$location`,`$age`,`$gender`,`$smoke_bit`,`$do_you_have1`,`$travel_bit`,`$temperature`,`$CS1`,`$CS2`,`$CS3`,`$CS4`,`$currently`,'$contact_with_person_bit')";
        }
        elseif(count($CS) == 5){
            for($j = 0; $j < 5; $j++)
                $CS5[$j] = $CS[$j];

                $sql = "INSERT INTO virusdata (date_tim, loca_tion, age, gender, smoke, diabetes, travel, temperature, dry_cough, shortness_of_breath, diarrhea, muscle_ache, fatigue, i_am_currently, have_contact)";
                $sql .+ " VALUES(`$dat_tim`,`$location`,`$age`,`$gender`,`$smoke_bit`,`$do_you_have1`,`$travel_bit`,`$temperature`,`$CS1`,`$CS2`,`$CS3`,`$CS4`,`$CS5`,`$currently`,'$contact_with_person_bit')";
        }
        elseif(count($CS) == 6){
            for($j = 0; $j < 6; $j++)
                $CS6[$j] = $CS[$j];

                $sql = "INSERT INTO virusdata (date_tim, loca_tion, age, gender, smoke, diabetes, travel, temperature, dry_cough, shortness_of_breath, diarrhea, muscle_ache, fatigue, runny_nose_or_nasal_congestion, i_am_currently, have_contact)";
                $sql .+ " VALUES(`$dat_tim`,`$location`,`$age`,`$gender`,`$smoke_bit`,`$do_you_have1`,`$travel_bit`,`$temperature`,`$CS1`,`$CS2`,`$CS3`,`$CS4`,`$CS5`,`$CS6`,`$currently`,'$contact_with_person_bit')";
        }
        elseif(count($CS) == 7){
            for($j = 0; $j < 7; $j++)
                $CS7[$j] = $CS[$j];
        }
        elseif(count($CS) == 8){
            for($j = 0; $j < 8; $j++)
                $CS8[$j] = $CS[$j];
        }
        elseif(count($CS) == 9){
            for($j = 0; $j < 9; $j++)
                $CS9[$j] = $CS[$j];
        }
        elseif(count($CS) == 10){
            for($j = 0; $j < 10; $j++)
                $CS10[$j] = $CS[$j];
        }
        elseif(count($CS) == 11){
            for($j = 0; $j < 11; $j++)
                $CS11[$j] = $CS[$j];
        }
        elseif(count($CS) == 12){
            for($j = 0; $j < 12; $j++)
                $CS12[$j] = $CS[$j];
        }
}
// Second
    elseif(count($do_you_have) == 2){
        for($i = 0; $i < 2; $i++)
            $do_you_have2[$i] = $do_you_have[$i];
            // Current Status
        //$CS22 = $_POST['Cs'];

        if(count($CS) == 1){
            $CS1 = $CS;
        }
        elseif(count($CS) == 2){
            for($j = 0; $j < 2; $j++)
                $CS2[$j] = $CS[$j];
        }
        elseif(count($CS) == 3){
            for($j = 0; $j < 3; $j++)
                $CS3[$j] = $CS[$j];
        }
        elseif(count($CS) == 4){
            for($j = 0; $j < 4; $j++)
                $CS4[$j] = $CS[$j];
        }
        elseif(count($CS) == 5){
            for($j = 0; $j < 5; $j++)
                $CS5[$j] = $CS[$j];
        }
        elseif(count($CS) == 6){
            for($j = 0; $j < 6; $j++)
                $CS6[$j] = $CS[$j];
        }
        elseif(count($CS) == 7){
            for($j = 0; $j < 7; $j++)
                $CS7[$j] = $CS[$j];
        }
        elseif(count($CS) == 8){
            for($j = 0; $j < 8; $j++)
                $CS8[$j] = $CS[$j];
        }
        elseif(count($CS) == 9){
            for($j = 0; $j < 9; $j++)
                $CS9[$j] = $CS[$j];
        }
        elseif(count($CS) == 10){
            for($j = 0; $j < 10; $j++)
                $CS10[$j] = $CS[$j];
        }
        elseif(count($CS) == 11){
            for($j = 0; $j < 11; $j++)
                $CS11[$j] = $CS[$j];
        }
        elseif(count($CS) == 12){
            for($j = 0; $j < 12; $j++)
                $CS12[$j] = $CS[$j];
        }
        
        
}
// Third
    elseif(count($do_you_have) == 3){
        for($i = 0; $i < 3; $i++)
            $do_you_have3[$i] = $do_you_have[$i];

       // Current Status
        //$CS33 = $_POST['Cs'];

        if(count($CS) == 1){
            $CS1 = $CS;
        }
        elseif(count($CS) == 2){
            for($j = 0; $j < 2; $j++)
                $CS2[$j] = $CS[$j];
        }
        elseif(count($CS) == 3){
            for($j = 0; $j < 3; $j++)
                $CS3[$j] = $CS[$j];
        }
        elseif(count($CS) == 4){
            for($j = 0; $j < 4; $j++)
                $CS4[$j] = $CS[$j];
        }
        elseif(count($CS) == 5){
            for($j = 0; $j < 5; $j++)
                $CS5[$j] = $CS[$j];
        }
        elseif(count($CS) == 6){
            for($j = 0; $j < 6; $j++)
                $CS6[$j] = $CS[$j];
        }
        elseif(count($CS) == 7){
            for($j = 0; $j < 7; $j++)
                $CS7[$j] = $CS[$j];
        }
        elseif(count($CS) == 8){
            for($j = 0; $j < 8; $j++)
                $CS8[$j] = $CS[$j];
        }
        elseif(count($CS) == 9){
            for($j = 0; $j < 9; $j++)
                $CS9[$j] = $CS[$j];
        }
        elseif(count($CS) == 10){
            for($j = 0; $j < 10; $j++)
                $CS10[$j] = $CS[$j];
        }
        elseif(count($CS) == 11){
            for($j = 0; $j < 11; $j++)
                $CS11[$j] = $CS[$j];
        }
        elseif(count($CS) == 12){
            for($j = 0; $j < 12; $j++)
                $CS12[$j] = $CS[$j];
        }
}
// Fourth
    elseif(count($do_you_have) == 4){
        for($i = 0; $i < 4; $i++)
            $do_you_have4[$i] = $do_you_have[$i];

                        // Current Status
        //$CS = $_POST['CurrentStatus'];

        if(count($CS) == 1){
            $CS1 = $CS;
        }
        elseif(count($CS) == 2){
            for($j = 0; $j < 2; $j++)
                $CS2[$j] = $CS[$j];
        }
        elseif(count($CS) == 3){
            for($j = 0; $j < 3; $j++)
                $CS3[$j] = $CS[$j];
        }
        elseif(count($CS) == 4){
            for($j = 0; $j < 4; $j++)
                $CS4[$j] = $CS[$j];
        }
        elseif(count($CS) == 5){
            for($j = 0; $j < 5; $j++)
                $CS5[$j] = $CS[$j];
        }
        elseif(count($CS) == 6){
            for($j = 0; $j < 6; $j++)
                $CS6[$j] = $CS[$j];
        }
        elseif(count($CS) == 7){
            for($j = 0; $j < 7; $j++)
                $CS7[$j] = $CS[$j];
        }
        elseif(count($CS) == 8){
            for($j = 0; $j < 8; $j++)
                $CS8[$j] = $CS[$j];
        }
        elseif(count($CS) == 9){
            for($j = 0; $j < 9; $j++)
                $CS9[$j] = $CS[$j];
        }
        elseif(count($CS) == 10){
            for($j = 0; $j < 10; $j++)
                $CS10[$j] = $CS[$j];
        }
        elseif(count($CS) == 11){
            for($j = 0; $j < 11; $j++)
                $CS11[$j] = $CS[$j];
        }
        elseif(count($CS) == 12){
            for($j = 0; $j < 12; $j++)
                $CS12[$j] = $CS[$j];
        }
}
// Fifth
    elseif(count($do_you_have) == 5){
        for($i = 0; $i < 5; $i++)
            $do_you_have5[$i] = $do_you_have[$i];

                        // Current Status
//$CS = $_POST['CurrentStatus'];

        if(count($CS) == 1){
            $CS1 = $CS;
        }
        elseif(count($CS) == 2){
            for($j = 0; $j < 2; $j++)
                $CS2[$j] = $CS[$j];
        }
        elseif(count($CS) == 3){
            for($j = 0; $j < 3; $j++)
                $CS3[$j] = $CS[$j];
        }
        elseif(count($CS) == 4){
            for($j = 0; $j < 4; $j++)
                $CS4[$j] = $CS[$j];
        }
        elseif(count($CS) == 5){
            for($j = 0; $j < 5; $j++)
                $CS5[$j] = $CS[$j];
        }
        elseif(count($CS) == 6){
            for($j = 0; $j < 6; $j++)
                $CS6[$j] = $CS[$j];
        }
        elseif(count($CS) == 7){
            for($j = 0; $j < 7; $j++)
                $CS7[$j] = $CS[$j];
        }
        elseif(count($CS) == 8){
            for($j = 0; $j < 8; $j++)
                $CS8[$j] = $CS[$j];
        }
        elseif(count($CS) == 9){
            for($j = 0; $j < 9; $j++)
                $CS9[$j] = $CS[$j];
        }
        elseif(count($CS) == 10){
            for($j = 0; $j < 10; $j++)
                $CS10[$j] = $CS[$j];
        }
        elseif(count($CS) == 11){
            for($j = 0; $j < 11; $j++)
                $CS11[$j] = $CS[$j];
        }
        elseif(count($CS) == 12){
            for($j = 0; $j < 12; $j++)
                $CS12[$j] = $CS[$j];
        }
}
// Sixth
    elseif(count($do_you_have) == 6){
        for($i = 0; $i < 6; $i++)
            $do_you_have6[$i] = $do_you_have[$i];

                        // Current Status
//$CS = $_POST['CurrentStatus'];

        if(count($CS) == 1){
            $CS1 = $CS;
        }
        elseif(count($CS) == 2){
            for($j = 0; $j < 2; $j++)
                $CS2[$j] = $CS[$j];
        }
        elseif(count($CS) == 3){
            for($j = 0; $j < 3; $j++)
                $CS3[$j] = $CS[$j];
        }
        elseif(count($CS) == 4){
            for($j = 0; $j < 4; $j++)
                $CS4[$j] = $CS[$j];
        }
        elseif(count($CS) == 5){
            for($j = 0; $j < 5; $j++)
                $CS5[$j] = $CS[$j];
        }
        elseif(count($CS) == 6){
            for($j = 0; $j < 6; $j++)
                $CS6[$j] = $CS[$j];
        }
        elseif(count($CS) == 7){
            for($j = 0; $j < 7; $j++)
                $CS7[$j] = $CS[$j];
        }
        elseif(count($CS) == 8){
            for($j = 0; $j < 8; $j++)
                $CS8[$j] = $CS[$j];
        }
        elseif(count($CS) == 9){
            for($j = 0; $j < 9; $j++)
                $CS9[$j] = $CS[$j];
        }
        elseif(count($CS) == 10){
            for($j = 0; $j < 10; $j++)
                $CS10[$j] = $CS[$j];
        }
        elseif(count($CS) == 11){
            for($j = 0; $j < 11; $j++)
                $CS11[$j] = $CS[$j];
        }
        elseif(count($CS) == 12){
            for($j = 0; $j < 12; $j++)
                $CS12[$j] = $CS[$j];
        }
}
// Seventh
    elseif(count($do_you_have) == 7){
        for($i = 0; $i < 7; $i++)
            $do_you_have7[$i] = $do_you_have[$i];

                        // Current Status
        //$CS = $_POST['CurrentStatus'];

        if(count($CS) == 1){
            $CS1 = $CS;
        }
        elseif(count($CS) == 2){
            for($j = 0; $j < 2; $j++)
                $CS2[$j] = $CS[$j];
        }
        elseif(count($CS) == 3){
            for($j = 0; $j < 3; $j++)
                $CS3[$j] = $CS[$j];
        }
        elseif(count($CS) == 4){
            for($j = 0; $j < 4; $j++)
                $CS4[$j] = $CS[$j];
        }
        elseif(count($CS) == 5){
            for($j = 0; $j < 5; $j++)
                $CS5[$j] = $CS[$j];
        }
        elseif(count($CS) == 6){
            for($j = 0; $j < 6; $j++)
                $CS6[$j] = $CS[$j];
        }
        elseif(count($CS) == 7){
            for($j = 0; $j < 7; $j++)
                $CS7[$j] = $CS[$j];
        }
        elseif(count($CS) == 8){
            for($j = 0; $j < 8; $j++)
                $CS8[$j] = $CS[$j];
        }
        elseif(count($CS) == 9){
            for($j = 0; $j < 9; $j++)
                $CS9[$j] = $CS[$j];
        }
        elseif(count($CS) == 10){
            for($j = 0; $j < 10; $j++)
                $CS10[$j] = $CS[$j];
        }
        elseif(count($CS) == 11){
            for($j = 0; $j < 11; $j++)
                $CS11[$j] = $CS[$j];
        }
        elseif(count($CS) == 12){
            for($j = 0; $j < 12; $j++)
                $CS12[$j] = $CS[$j];
        }
}
// Eight
    elseif(count($do_you_have) == 8){
        for($i = 0; $i < 8; $i++)
            $do_you_have8[$i] = $do_you_have[$i];

                        // Current Status
        //$CS = $_POST['CurrentStatus'];

        if(count($CS) == 1){
            $CS1 = $CS;
        }
        elseif(count($CS) == 2){
            for($j = 0; $j < 2; $j++)
                $CS2[$j] = $CS[$j];
        }
        elseif(count($CS) == 3){
            for($j = 0; $j < 3; $j++)
                $CS3[$j] = $CS[$j];
        }
        elseif(count($CS) == 4){
            for($j = 0; $j < 4; $j++)
                $CS4[$j] = $CS[$j];
        }
        elseif(count($CS) == 5){
            for($j = 0; $j < 5; $j++)
                $CS5[$j] = $CS[$j];
        }
        elseif(count($CS) == 6){
            for($j = 0; $j < 6; $j++)
                $CS6[$j] = $CS[$j];
        }
        elseif(count($CS) == 7){
            for($j = 0; $j < 7; $j++)
                $CS7[$j] = $CS[$j];
        }
        elseif(count($CS) == 8){
            for($j = 0; $j < 8; $j++)
                $CS8[$j] = $CS[$j];
        }
        elseif(count($CS) == 9){
            for($j = 0; $j < 9; $j++)
                $CS9[$j] = $CS[$j];
        }
        elseif(count($CS) == 10){
            for($j = 0; $j < 10; $j++)
                $CS10[$j] = $CS[$j];
        }
        elseif(count($CS) == 11){
            for($j = 0; $j < 11; $j++)
                $CS11[$j] = $CS[$j];
        }
        elseif(count($CS) == 12){
            for($j = 0; $j < 12; $j++)
                $CS12[$j] = $CS[$j];
        }
}

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
// sql to create table
//    $sql = "CREATE TABLE VirusData (
//     id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//     date_tim datetime,
//     loca_tion varchar(30) NOT NULL,
//     age int NOT NULL,
//     gender varchar(6) NOT NULL,
//     smoke int DEFAULT 0,
    
//     diabetes int DEFAULT 0,
//     hypertension int DEFAULT 0,
//     ischemic_heart_disease int DEFAULT 0,
//     chronic_lung_disease int DEFAULT 0,
//     chronic_kidney_disease int DEFAULT 0,
//     cancer int DEFAULT 0,
//     asthma int DEFAULT 0,
//     none_of_these int DEFAULT 0,
    
//     travel int DEFAULT 0,
//     temperature int,

//     dry_cough int DEFAULT 0,
//     shortness_of_breath int DEFAULT 0,
//     diarrhea int DEFAULT 0,
//     muscle_ache int DEFAULT 0,
//     fatigue int DEFAULT 0,
//     runny_nose_or_nasal_congestion int DEFAULT 0,
//     sore_throat int DEFAULT 0,
//     loss_of_smell_taste int DEFAULT 0,
//     hot_fever int DEFAULT 0,
//     headache int DEFAULT 0,
//     nausea_and_or_vomiting int DEFAULT 0,
//     none_of_them int DEFAULT 0,

//     i_am_currently varchar(20),
//     have_contact int DEFAULT 0
//     )";
    
//     if ($conn->query($sql) === TRUE) {
//         echo "Table VirusData created successfully";
//     } else {
//         echo "Error creating table: " . $conn->error;
//     }
//     $conn->close();
//$sql = "ALTER TABLE virusdata ADD date_time datetime";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " ."<br>". $conn->error;
}

$conn->close();
}

// Database Ends
    
}
else{
    echo "Error!, Sorry for that we are looking for correcting";
}
?>