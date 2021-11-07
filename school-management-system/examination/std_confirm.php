    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "madrassa";
    $gr = $_POST['gr_no'];
    $roll_number = 0;


    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        $error_message = "Connection failed: " . $conn->connect_error;
        $error = True;
    } else {
        $sqlz = "select * from students where GR_no = " . $gr;
        $result = $conn->query($sqlz);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $gr = $row['GR_no'];
                // echo "Data has been saved!";      
            }

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                $error_message = "Connection failed: " . $conn->connect_error;
                $error = True;
            } else {
                $sqlz = "SELECT roll_no FROM roll_number WHERE GR_no = " . $gr;
                $result = $conn->query($sqlz);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $roll_number = $row['roll_no'];
                        // echo "Data has been saved!";      
                    }
                }
            }
        } else {
            $gr = 'a';
            $error_message = "Error: " . $conn->error;
            $error = True;
        }
    }
    echo $gr . '*' . $roll_number;
    ?>