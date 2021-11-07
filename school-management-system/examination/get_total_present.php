<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "madrassa";
    $gr = $_POST['gr_no'];

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        $error_message = "Connection failed: " . $conn->connect_error;
        $error = True;
    } 
    else {
        $from_date = $_POST['from_date'];
        $to_date = $_POST['to_date'];

        $sqlz = "select count(*) as counter from attendance where GR_no = '".$gr."' and attendance = 'حاضر' and date_ BETWEEN '".$from_date."' AND  '".$to_date."'";
        $result = $conn->query($sqlz);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $gr = $row['counter'];
                  // echo "Data has been saved!";      
        } 
    }
    else {
        $gr = 'a';
        $error_message = "Error: " . $conn->error;
        $error = True;
    }
}
echo $gr;
