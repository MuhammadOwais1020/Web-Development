<?php
$message = "";
if(isset($_POST['submit'])){
    $gender = "NULL";
    $smoke = 0;
    $smoke_bit = 0;
    $travel_bit = 0;
    $contact_with_person_bit = 0;
    $chk="";
    $date_time = "";
    $do_you_have[] = 0;
    $CS[] = 0;
    $sql = "";
    $currently_bit = "NoChange";
    $dat_tim = date("Y-m-d h:m:s");
    //echo $dat_tim;
    $location = $_POST['Location'];
    $age = $_POST['age'];
    if(isset($_POST['gender']))
        $gender = $_POST['gender'];
    if(isset($_POST['smoking']))
        $smoke = $_POST['smoking'];
    if($smoke == "Yes")
        $smoke_bit = 1;

    if(isset($_POST['travel'])){
        
        $travel = $_POST['travel'];
    if($travel == "Yes")
        $travel_bit = 1;
    }
    
    $temperature = $_POST['temperature'];

    if(isset($_POST['currently'])){
        $currently = $_POST['currently'];
        // if($currently == "InIsolation")
        //     $currently_bit = "InIsolation";
        // if($currently == "SelfQuarantine")
        //     $currently_bit = "SelfQuarantine";
        // if($currently == "SocialDistance")
        //     $currently_bit = "SocialDistance";
        // if($currently == "NoChange")
        //     $currently_bit = "NoChange";
    }
    
    if(isset($_POST['ContactWithPerson'])){

        $contact_with_person = $_POST['ContactWithPerson'];
    if($contact_with_person == "Yes")
        $contact_with_person_bit = 1;
    }

    // Do you Have Bit Variables
    $diabetes_bit = 0;
    $Hypertension_bit = 0;
    $Ischemic_heart_disease_bit = 0;
    $Chronic_Lung_Disease_bit = 0;
    $Chronic_Kidney_Disease_bit = 0;
    $Cancer_bit = 0;
    $Asthma_bit = 0;
    $None_of_These_bit = 0;

    // Current Status Bit Variable
    $Dry_cough_bit = 0;
    $Shortness_of_breath_bit = 0;
    $Diarrhea_bit = 0;
    $Muscle_ache_bit = 0;
    $Fatigue_bit = 0;
    $Runny_nose_or_nasal_congestion_bit = 0;
    $Sore_throat_bit = 0;
    $Loss_of_smell_taste_bit = 0;
    $Hot_Fever_bit = 0;
    $Headache_bit = 0;
    $Nausea_and_or_vomiting_bit = 0;
    $None_of_them_status_bit = 0;

    if(!empty($_POST['Do'])){
        $do_you_have = $_POST['Do'];
        if(count($do_you_have) == 1){
            if($do_you_have == "diabetes")
                $diabetes_bit = 1;
            if($do_you_have == "hypertension")
                $Hypertension_bit = 1;
            if($do_you_have == "ischemic heart disease")
                $Ischemic_heart_disease_bit = 1;
            if($do_you_have == "chronic lung disease")
                $Chronic_Lung_Disease_bit = 1;
            if($do_you_have == "chronic kidney disease")
                $Chronic_Kidney_Disease_bit = 1;
            if($do_you_have == "cancer")
                $Cancer_bit = 1;
            if($do_you_have == "asthma")
                $Asthma_bit = 1;
            if($do_you_have == "none of these")
                $None_of_These_bit = 1;
        }
        if(count($do_you_have) == 2){
            for($i = 0; $i < 2; $i++){
                if($do_you_have[$i] == "diabetes")
                $diabetes_bit = 1;
            if($do_you_have[$i] == "hypertension")
                $Hypertension_bit = 1;
            if($do_you_have[$i] == "ischemic heart disease")
                $Ischemic_heart_disease_bit = 1;
            if($do_you_have[$i] == "chronic lung disease")
                $Chronic_Lung_Disease_bit = 1;
            if($do_you_have[$i] == "chronic kidney disease")
                $Chronic_Kidney_Disease_bit = 1;
            if($do_you_have[$i] == "cancer")
                $Cancer_bit = 1;
            if($do_you_have[$i] == "asthma")
                $Asthma_bit = 1;
            if($do_you_have[$i] == "none of these")
                $None_of_These_bit = 1;
            }
        }
        if(count($do_you_have) == 3){
            for($i = 0; $i < 3; $i++){
                if($do_you_have[$i] == "diabetes")
                $diabetes_bit = 1;
            if($do_you_have[$i] == "hypertension")
                $Hypertension_bit = 1;
            if($do_you_have[$i] == "ischemic heart disease")
                $Ischemic_heart_disease_bit = 1;
            if($do_you_have[$i] == "chronic lung disease")
                $Chronic_Lung_Disease_bit = 1;
            if($do_you_have[$i] == "chronic kidney disease")
                $Chronic_Kidney_Disease_bit = 1;
            if($do_you_have[$i] == "cancer")
                $Cancer_bit = 1;
            if($do_you_have[$i] == "asthma")
                $Asthma_bit = 1;
            if($do_you_have[$i] == "none of these")
                $None_of_These_bit = 1;
            }
        }
        if(count($do_you_have) == 4){
            for($i = 0; $i < 4; $i++){
                if($do_you_have[$i] == "diabetes")
                $diabetes_bit = 1;
            if($do_you_have[$i] == "hypertension")
                $Hypertension_bit = 1;
            if($do_you_have[$i] == "ischemic heart disease")
                $Ischemic_heart_disease_bit = 1;
            if($do_you_have[$i] == "chronic lung disease")
                $Chronic_Lung_Disease_bit = 1;
            if($do_you_have[$i] == "chronic kidney disease")
                $Chronic_Kidney_Disease_bit = 1;
            if($do_you_have[$i] == "cancer")
                $Cancer_bit = 1;
            if($do_you_have[$i] == "asthma")
                $Asthma_bit = 1;
            if($do_you_have[$i] == "none of these")
                $None_of_These_bit = 1;
            }
        }
        if(count($do_you_have) == 5){
            for($i = 0; $i < 5; $i++){
                if($do_you_have[$i] == "diabetes")
                $diabetes_bit = 1;
            if($do_you_have[$i] == "hypertension")
                $Hypertension_bit = 1;
            if($do_you_have[$i] == "ischemic heart disease")
                $Ischemic_heart_disease_bit = 1;
            if($do_you_have[$i] == "chronic lung disease")
                $Chronic_Lung_Disease_bit = 1;
            if($do_you_have[$i] == "chronic kidney disease")
                $Chronic_Kidney_Disease_bit = 1;
            if($do_you_have[$i] == "cancer")
                $Cancer_bit = 1;
            if($do_you_have[$i] == "asthma")
                $Asthma_bit = 1;
            if($do_you_have[$i] == "none of these")
                $None_of_These_bit = 1;
            }
        }
        if(count($do_you_have) == 6){
            for($i = 0; $i < 6; $i++){
                if($do_you_have[$i] == "diabetes")
                $diabetes_bit = 1;
            if($do_you_have[$i] == "hypertension")
                $Hypertension_bit = 1;
            if($do_you_have[$i] == "ischemic heart disease")
                $Ischemic_heart_disease_bit = 1;
            if($do_you_have[$i] == "chronic lung disease")
                $Chronic_Lung_Disease_bit = 1;
            if($do_you_have[$i] == "chronic kidney disease")
                $Chronic_Kidney_Disease_bit = 1;
            if($do_you_have[$i] == "cancer")
                $Cancer_bit = 1;
            if($do_you_have[$i] == "asthma")
                $Asthma_bit = 1;
            if($do_you_have[$i] == "none of these")
                $None_of_These_bit = 1;
            }
        }
        if(count($do_you_have) == 7){
            for($i = 0; $i < 7; $i++){
                if($do_you_have[$i] == "diabetes")
                $diabetes_bit = 1;
            if($do_you_have[$i] == "hypertension")
                $Hypertension_bit = 1;
            if($do_you_have[$i] == "ischemic heart disease")
                $Ischemic_heart_disease_bit = 1;
            if($do_you_have[$i] == "chronic lung disease")
                $Chronic_Lung_Disease_bit = 1;
            if($do_you_have[$i] == "chronic kidney disease")
                $Chronic_Kidney_Disease_bit = 1;
            if($do_you_have[$i] == "cancer")
                $Cancer_bit = 1;
            if($do_you_have[$i] == "asthma")
                $Asthma_bit = 1;
            if($do_you_have[$i] == "none of these")
                $None_of_These_bit = 1;
            }
        }
        if(count($do_you_have) == 8){
            for($i = 0; $i < 8; $i++){
                if($do_you_have[$i] == "diabetes")
                $diabetes_bit = 1;
            if($do_you_have[$i] == "hypertension")
                $Hypertension_bit = 1;
            if($do_you_have[$i] == "ischemic heart disease")
                $Ischemic_heart_disease_bit = 1;
            if($do_you_have[$i] == "chronic lung disease")
                $Chronic_Lung_Disease_bit = 1;
            if($do_you_have[$i] == "chronic kidney disease")
                $Chronic_Kidney_Disease_bit = 1;
            if($do_you_have[$i] == "cancer")
                $Cancer_bit = 1;
            if($do_you_have[$i] == "asthma")
                $Asthma_bit = 1;
            if($do_you_have[$i] == "none of these")
                $None_of_These_bit = 1;
            }
        }
    }

    // Current status bit
    if(!empty($_POST['Cst'])){
        $CS = $_POST['Cst'];
        if(count($CS) == 1){
            if($CS == "Dry cough")
                $Dry_cough_bit = 1;
            if($CS == "Shortness of breath")
                $Shortness_of_breath_bit = 1;
            if($CS == "Diarrhea")
                $Diarrhea_bit = 1;
            if($CS == "Muscle ache")
                $Muscle_ache_bit = 1;
            if($CS == "Fatigue")
                $Fatigue_bit = 1;
            if($CS == "Runny nose or nasal congestion")
                $Runny_nose_or_nasal_congestion_bit = 1;
            if($CS == "Sore throat")
                $Sore_throat_bit = 1;
            if($CS == "Loss of smell/taste")
                $Loss_of_smell_taste_bit = 1;
            if($CS == "Hot Fever")
                $Hot_Fever_bit = 1;
            if($CS == "Headache")
                $Headache_bit = 1;
            if($CS == "Nausea and/or vomiting")
                $Nausea_and_or_vomiting_bit = 1;
            if($CS == "None")
                $None_of_them_status_bit = 1;
        }
        if(count($CS) == 2){
            for($j = 0; $j < 2; $j++){
            if($CS[$j] == "Dry cough")
                $Dry_cough_bit = 1;
            if($CS[$j] == "Shortness of breath")
                $Shortness_of_breath_bit = 1;
            if($CS[$j] == "Diarrhea")
                $Diarrhea_bit = 1;
            if($CS[$j] == "Muscle ache")
                $Muscle_ache_bit = 1;
            if($CS[$j] == "Fatigue")
                $Fatigue_bit = 1;
            if($CS[$j] == "Runny nose or nasal congestion")
                $Runny_nose_or_nasal_congestion_bit = 1;
            if($CS[$j] == "Sore throat")
                $Sore_throat_bit = 1;
            if($CS[$j] == "Loss of smell/taste")
                $Loss_of_smell_taste_bit = 1;
            if($CS[$j] == "Hot Fever")
                $Hot_Fever_bit = 1;
            if($CS[$j] == "Headache")
                $Headache_bit = 1;
            if($CS[$j] == "Nausea and/or vomiting")
                $Nausea_and_or_vomiting_bit = 1;
            if($CS[$j] == "None")
                $None_of_them_status_bit = 1;
            }
        }
        if(count($CS) == 3){
            for($j = 0; $j < 3; $j++){
                if($CS[$j] == "Dry cough")
                    $Dry_cough_bit = 1;
                if($CS[$j] == "Shortness of breath")
                    $Shortness_of_breath_bit = 1;
                if($CS[$j] == "Diarrhea")
                    $Diarrhea_bit = 1;
                if($CS[$j] == "Muscle ache")
                    $Muscle_ache_bit = 1;
                if($CS[$j] == "Fatigue")
                    $Fatigue_bit = 1;
                if($CS[$j] == "Runny nose or nasal congestion")
                    $Runny_nose_or_nasal_congestion_bit = 1;
                if($CS[$j] == "Sore throat")
                    $Sore_throat_bit = 1;
                if($CS[$j] == "Loss of smell/taste")
                    $Loss_of_smell_taste_bit = 1;
                if($CS[$j] == "Hot Fever")
                    $Hot_Fever_bit = 1;
                if($CS[$j] == "Headache")
                    $Headache_bit = 1;
                if($CS[$j] == "Nausea and/or vomiting")
                    $Nausea_and_or_vomiting_bit = 1;
                if($CS[$j] == "None")
                    $None_of_them_status_bit = 1;
                }
        }
        if(count($CS) == 4){
            for($j = 0; $j < 4; $j++){
                if($CS[$j] == "Dry cough")
                    $Dry_cough_bit = 1;
                if($CS[$j] == "Shortness of breath")
                    $Shortness_of_breath_bit = 1;
                if($CS[$j] == "Diarrhea")
                    $Diarrhea_bit = 1;
                if($CS[$j] == "Muscle ache")
                    $Muscle_ache_bit = 1;
                if($CS[$j] == "Fatigue")
                    $Fatigue_bit = 1;
                if($CS[$j] == "Runny nose or nasal congestion")
                    $Runny_nose_or_nasal_congestion_bit = 1;
                if($CS[$j] == "Sore throat")
                    $Sore_throat_bit = 1;
                if($CS[$j] == "Loss of smell/taste")
                    $Loss_of_smell_taste_bit = 1;
                if($CS[$j] == "Hot Fever")
                    $Hot_Fever_bit = 1;
                if($CS[$j] == "Headache")
                    $Headache_bit = 1;
                if($CS[$j] == "Nausea and/or vomiting")
                    $Nausea_and_or_vomiting_bit = 1;
                if($CS[$j] == "None")
                    $None_of_them_status_bit = 1;
                }
        }
        if(count($CS) == 5){
            for($j = 0; $j < 5; $j++){
                if($CS[$j] == "Dry cough")
                    $Dry_cough_bit = 1;
                if($CS[$j] == "Shortness of breath")
                    $Shortness_of_breath_bit = 1;
                if($CS[$j] == "Diarrhea")
                    $Diarrhea_bit = 1;
                if($CS[$j] == "Muscle ache")
                    $Muscle_ache_bit = 1;
                if($CS[$j] == "Fatigue")
                    $Fatigue_bit = 1;
                if($CS[$j] == "Runny nose or nasal congestion")
                    $Runny_nose_or_nasal_congestion_bit = 1;
                if($CS[$j] == "Sore throat")
                    $Sore_throat_bit = 1;
                if($CS[$j] == "Loss of smell/taste")
                    $Loss_of_smell_taste_bit = 1;
                if($CS[$j] == "Hot Fever")
                    $Hot_Fever_bit = 1;
                if($CS[$j] == "Headache")
                    $Headache_bit = 1;
                if($CS[$j] == "Nausea and/or vomiting")
                    $Nausea_and_or_vomiting_bit = 1;
                if($CS[$j] == "None")
                    $None_of_them_status_bit = 1;
                }
        }
        if(count($CS) == 6){
            for($j = 0; $j < 6; $j++){
                if($CS[$j] == "Dry cough")
                    $Dry_cough_bit = 1;
                if($CS[$j] == "Shortness of breath")
                    $Shortness_of_breath_bit = 1;
                if($CS[$j] == "Diarrhea")
                    $Diarrhea_bit = 1;
                if($CS[$j] == "Muscle ache")
                    $Muscle_ache_bit = 1;
                if($CS[$j] == "Fatigue")
                    $Fatigue_bit = 1;
                if($CS[$j] == "Runny nose or nasal congestion")
                    $Runny_nose_or_nasal_congestion_bit = 1;
                if($CS[$j] == "Sore throat")
                    $Sore_throat_bit = 1;
                if($CS[$j] == "Loss of smell/taste")
                    $Loss_of_smell_taste_bit = 1;
                if($CS[$j] == "Hot Fever")
                    $Hot_Fever_bit = 1;
                if($CS[$j] == "Headache")
                    $Headache_bit = 1;
                if($CS[$j] == "Nausea and/or vomiting")
                    $Nausea_and_or_vomiting_bit = 1;
                if($CS[$j] == "None")
                    $None_of_them_status_bit = 1;
                }
        }
        if(count($CS) == 7){
            for($j = 0; $j < 7; $j++){
                if($CS[$j] == "Dry cough")
                    $Dry_cough_bit = 1;
                if($CS[$j] == "Shortness of breath")
                    $Shortness_of_breath_bit = 1;
                if($CS[$j] == "Diarrhea")
                    $Diarrhea_bit = 1;
                if($CS[$j] == "Muscle ache")
                    $Muscle_ache_bit = 1;
                if($CS[$j] == "Fatigue")
                    $Fatigue_bit = 1;
                if($CS[$j] == "Runny nose or nasal congestion")
                    $Runny_nose_or_nasal_congestion_bit = 1;
                if($CS[$j] == "Sore throat")
                    $Sore_throat_bit = 1;
                if($CS[$j] == "Loss of smell/taste")
                    $Loss_of_smell_taste_bit = 1;
                if($CS[$j] == "Hot Fever")
                    $Hot_Fever_bit = 1;
                if($CS[$j] == "Headache")
                    $Headache_bit = 1;
                if($CS[$j] == "Nausea and/or vomiting")
                    $Nausea_and_or_vomiting_bit = 1;
                if($CS[$j] == "None")
                    $None_of_them_status_bit = 1;
                }
        }
        if(count($CS) == 8){
            for($j = 0; $j < 8; $j++){
                if($CS[$j] == "Dry cough")
                    $Dry_cough_bit = 1;
                if($CS[$j] == "Shortness of breath")
                    $Shortness_of_breath_bit = 1;
                if($CS[$j] == "Diarrhea")
                    $Diarrhea_bit = 1;
                if($CS[$j] == "Muscle ache")
                    $Muscle_ache_bit = 1;
                if($CS[$j] == "Fatigue")
                    $Fatigue_bit = 1;
                if($CS[$j] == "Runny nose or nasal congestion")
                    $Runny_nose_or_nasal_congestion_bit = 1;
                if($CS[$j] == "Sore throat")
                    $Sore_throat_bit = 1;
                if($CS[$j] == "Loss of smell/taste")
                    $Loss_of_smell_taste_bit = 1;
                if($CS[$j] == "Hot Fever")
                    $Hot_Fever_bit = 1;
                if($CS[$j] == "Headache")
                    $Headache_bit = 1;
                if($CS[$j] == "Nausea and/or vomiting")
                    $Nausea_and_or_vomiting_bit = 1;
                if($CS[$j] == "None")
                    $None_of_them_status_bit = 1;
                }
        }
        if(count($CS) == 9){
            for($j = 0; $j < 9; $j++){
                if($CS[$j] == "Dry cough")
                    $Dry_cough_bit = 1;
                if($CS[$j] == "Shortness of breath")
                    $Shortness_of_breath_bit = 1;
                if($CS[$j] == "Diarrhea")
                    $Diarrhea_bit = 1;
                if($CS[$j] == "Muscle ache")
                    $Muscle_ache_bit = 1;
                if($CS[$j] == "Fatigue")
                    $Fatigue_bit = 1;
                if($CS[$j] == "Runny nose or nasal congestion")
                    $Runny_nose_or_nasal_congestion_bit = 1;
                if($CS[$j] == "Sore throat")
                    $Sore_throat_bit = 1;
                if($CS[$j] == "Loss of smell/taste")
                    $Loss_of_smell_taste_bit = 1;
                if($CS[$j] == "Hot Fever")
                    $Hot_Fever_bit = 1;
                if($CS[$j] == "Headache")
                    $Headache_bit = 1;
                if($CS[$j] == "Nausea and/or vomiting")
                    $Nausea_and_or_vomiting_bit = 1;
                if($CS[$j] == "None")
                    $None_of_them_status_bit = 1;
                }
        }
        if(count($CS) == 10){
            for($j = 0; $j < 10; $j++){
                if($CS[$j] == "Dry cough")
                    $Dry_cough_bit = 1;
                if($CS[$j] == "Shortness of breath")
                    $Shortness_of_breath_bit = 1;
                if($CS[$j] == "Diarrhea")
                    $Diarrhea_bit = 1;
                if($CS[$j] == "Muscle ache")
                    $Muscle_ache_bit = 1;
                if($CS[$j] == "Fatigue")
                    $Fatigue_bit = 1;
                if($CS[$j] == "Runny nose or nasal congestion")
                    $Runny_nose_or_nasal_congestion_bit = 1;
                if($CS[$j] == "Sore throat")
                    $Sore_throat_bit = 1;
                if($CS[$j] == "Loss of smell/taste")
                    $Loss_of_smell_taste_bit = 1;
                if($CS[$j] == "Hot Fever")
                    $Hot_Fever_bit = 1;
                if($CS[$j] == "Headache")
                    $Headache_bit = 1;
                if($CS[$j] == "Nausea and/or vomiting")
                    $Nausea_and_or_vomiting_bit = 1;
                if($CS[$j] == "None")
                    $None_of_them_status_bit = 1;
                }
        }
        if(count($CS) == 11){
            for($j = 0; $j < 11; $j++){
                if($CS[$j] == "Dry cough")
                    $Dry_cough_bit = 1;
                if($CS[$j] == "Shortness of breath")
                    $Shortness_of_breath_bit = 1;
                if($CS[$j] == "Diarrhea")
                    $Diarrhea_bit = 1;
                if($CS[$j] == "Muscle ache")
                    $Muscle_ache_bit = 1;
                if($CS[$j] == "Fatigue")
                    $Fatigue_bit = 1;
                if($CS[$j] == "Runny nose or nasal congestion")
                    $Runny_nose_or_nasal_congestion_bit = 1;
                if($CS[$j] == "Sore throat")
                    $Sore_throat_bit = 1;
                if($CS[$j] == "Loss of smell/taste")
                    $Loss_of_smell_taste_bit = 1;
                if($CS[$j] == "Hot Fever")
                    $Hot_Fever_bit = 1;
                if($CS[$j] == "Headache")
                    $Headache_bit = 1;
                if($CS[$j] == "Nausea and/or vomiting")
                    $Nausea_and_or_vomiting_bit = 1;
                if($CS[$j] == "None")
                    $None_of_them_status_bit = 1;
                }
        }
        if(count($CS) == 12){
            for($j = 0; $j < 12; $j++){
                if($CS[$j] == "Dry cough")
                    $Dry_cough_bit = 1;
                if($CS[$j] == "Shortness of breath")
                    $Shortness_of_breath_bit = 1;
                if($CS[$j] == "Diarrhea")
                    $Diarrhea_bit = 1;
                if($CS[$j] == "Muscle ache")
                    $Muscle_ache_bit = 1;
                if($CS[$j] == "Fatigue")
                    $Fatigue_bit = 1;
                if($CS[$j] == "Runny nose or nasal congestion")
                    $Runny_nose_or_nasal_congestion_bit = 1;
                if($CS[$j] == "Sore throat")
                    $Sore_throat_bit = 1;
                if($CS[$j] == "Loss of smell/taste")
                    $Loss_of_smell_taste_bit = 1;
                if($CS[$j] == "Hot Fever")
                    $Hot_Fever_bit = 1;
                if($CS[$j] == "Headache")
                    $Headache_bit = 1;
                if($CS[$j] == "Nausea and/or vomiting")
                    $Nausea_and_or_vomiting_bit = 1;
                if($CS[$j] == "None")
                    $None_of_them_status_bit = 1;
                }
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
    $sql = "INSERT INTO virusdata (date_tim, loca_tion, age, gender, smoke, diabetes, hypertension, ischemic_heart_disease, chronic_lung_disease, chronic_kidney_disease, cancer, asthma, none_of_these, travel, temperature, dry_cough, shortness_of_breath, diarrhea, muscle_ache, fatigue, runny_nose_or_nasal_congestion, sore_throat, loss_of_smell_taste, hot_fever, headache, nausea_and_or_vomiting, none_of_them, i_am_currently, have_contact)";
    $sql .= " VALUES('$dat_tim','$location',$age,'$gender','$smoke_bit',$diabetes_bit,$Hypertension_bit,$Ischemic_heart_disease_bit,$Chronic_Lung_Disease_bit,$Chronic_Kidney_Disease_bit,$Cancer_bit,$Asthma_bit,$None_of_These_bit,$travel_bit,$temperature,$Dry_cough_bit,$Shortness_of_breath_bit,$Diarrhea_bit,$Muscle_ache_bit,$Fatigue_bit,$Runny_nose_or_nasal_congestion_bit,$Sore_throat_bit,$Loss_of_smell_taste_bit,$Hot_Fever_bit,$Headache_bit,$Nausea_and_or_vomiting_bit,$None_of_them_status_bit,'$currently',$contact_with_person_bit)";
    if ($conn->query($sql) === TRUE) {
        $message = "success";
    } else {
        $message = "error";
    }

$conn->close();
}

// Database Ends
    
}
else{
    $message = "error";
    //echo "Error!, Sorry for that we are looking for correcting";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-FFG49GMSJJ"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'G-FFG49GMSJJ');
    </script>
    
    <!-- Google Adsense-->
<script data-ad-client="ca-pub-2368693954490426" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Logic.css">
    <title>Thank You | COVID-19 Survey | QUEST Nawabshah, Pakistan</title>
</head>
<body>
    <?php
    if($message == "success"){
        echo '<div class="thank-box">';
        echo '<div class="photo">';
        echo '<img src="images/success.png" alt="Success Logo">';
        echo '</div>';
        echo '<div class="text">';
        echo '<h3>Thank You!</h3>';
        echo '<p>Thank you for filling out the form. Your response has been recorded. Please come back tomorrow to fill out the survey again. Thank you.</p>'; 
        echo '<p>Team: Prof. Dr. Adnan Manzoor, and The SemiColonZ team</p>';
        echo '<p>Research & Development LAB IT Dept. Quaid-e-Awam University of Engineering Science & Technology Nawabshah, Pakistan.</p>';       
        echo '<p>Please share this widely and Go Back: <a href="">www.thesemicolonz.com</a></p>';
        echo '</div>';
        echo '</div>';
    }
    else{
        echo '<div class="thank-box">';
        echo '<div class="photo">';
        echo '<img src="images/error.png" alt="Success Logo">';
        echo '</div>';
        echo '<div class="text">';
        echo '<h3>Error!</h3>';
        echo '<p>“Something went terribly wrong. Please try again! Thank You!.”</p></div>';
        echo '<p>Team: Prof. Dr. Adnan Manzoor, and The SemiColonZ team</p>';
        echo '<p>Research & Development LAB IT Dept. Quaid-e-Awam University of Engineering Science & Technology Nawabshah, Pakistan.</p>';       
        echo '<p>Please share this widely and Go Back: <a href="">www.thesemicolonz.com</a></p>';
        echo '</div>';
        echo '</div>';
    }
    ?>
    
</body>
</html>