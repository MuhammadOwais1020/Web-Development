<?php
$image_name = "";
$gr_number = 0;
$teacher_name = "";
$gender = "";
$disability = "";
$father_name = "";
$cast = "";
$date_of_birth = "";
$date_of_admission  = "";
$monthly_salary = "";
$designation = "";
$address = "";
$cnic = 0;
$mobile_number = 0;
$qualification = "";

//Database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "madrassa";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    $error_message = "Connection failed: " . $conn->connect_error;
    $error = True;
} else {
    $sql = "SELECT * FROM teachers WHERE GR_no = " . $_POST['gr-id'];
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $gr_number = $row['GR_no'];
            $teacher_name = $row['teacher_name'];
            $gender = $row['gender_g'];
            $father_name = $row['father_name'];
            $cast = $row['sir_name'];
            $date_of_birth = $row['date_of_birth'];
            $date_of_admission  = $row['date_of_admission'];
            $monthly_salary = $row['monthly_salary'];
            $designation = $row['designation'];
            $address = $row['complete_address'];
            $cnic = $row['CNIC'];
            $mobile_number = $row['contact'];
            $qualification = $row['qualification'];
            $image_name = $row['image_name'];
        }

        //retrieve remaining account balance 

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            $error_message = "Connection failed: " . $conn->connect_error;
            $error = True;
        } else {
            $sql = "SELECT remaining_balance FROM remaining_salary WHERE GR_no = " . $_POST['gr-id'];
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $remaining_account_balance = $row['remaining_balance'];
                }
            } else {
                $remaining_account_balance = 0;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>???????? / ?????????? ??????????????</title>
    <?php
    include('C:\xampp\htdocs\pos\assets\header.php');
    ?>
    <style>
        .container-pro-box {
            height: 750px;
        }

        @font-face {
            font-family: urdu;
            src: url(JameelNooriNastaleeq.ttf);
        }

        body,
        p {
            font-family: urdu !important;
        }
    </style>
</head>

<body style="background-color: rgba(233, 229, 229, 0.938);">
    <?php
    include('C:\xampp\htdocs\pos\assets\nav-bar.php');
    ?>
    <div class="container-pro-box">
        <div class="heading">
            <p>???????????? ?? ??????????????</p>
        </div>
        <div style="font-size: 16px; padding:10px;">
            <br>
            <div class=" alert-message" id="success-message">
                <div class="alert alert-success">
                    <strong>??????????????</strong>! ???????? ?????? ???? ?????? ?????? ??????????
                </div>
            </div>
            <div class="alert-message" id="error-message">
                <div class="alert alert-danger">
                    <strong>????????</strong>! ?????????????? ???? ???? ?????????????? ?????????? ?????????? ??????????
                </div>
            </div>
        </div>
        <?php
        if ($gr_number != 0) {
            echo '<div id="data-to-show">';
            echo '<div class="right">';
            echo '<p> ?????????? ?????????? ????????: ' . $gr_number . '</p>';
            echo '<p>???????? / ??????????: ' . $teacher_name . '</p>';
            echo '<p>??????: ' . $gender . '</p>';
            echo '<p>??????????: ' . $father_name . '</p>';
            echo '<p>??????: ' . $cast . '</p>';
            echo '<p>?????????? ????????????: ' . $date_of_birth . '</p>';
            echo '<p>?????????? ??????????: ' . $date_of_admission . '</p>';

            echo '</div>';
            echo '<div class="left">';

            echo '<div class="image" id="imageP">';
            echo '<img src="http://localhost/pos/img/profile-teacher/' . $image_name . '" alt="????????" class="image-preview__image">';
            echo '</div>';
            echo '<p>?????????? ????????????: ' . $monthly_salary . '</p>';
            echo '<p>????????:' . $designation . '</p>';
            echo '<p>???????? ???????????? ??????: ' . $address . '</p>';
            echo '<p>???????? ???????????? ???????? ????????: ' . $cnic . '</p>';
            echo '<p>???????????? ????????: ' . $mobile_number . '</p>';
            echo '<p>???????????? ????????????: ' . $qualification . '</p>';
            if ($remaining_account_balance > 0) {
                echo '<p style="color:red">???????????????? : ' . $remaining_account_balance . '</p>';
            } else {
                echo '<p>???????????????? : ' . $remaining_account_balance . '</p>';
            }
            echo '</div>';
            echo '</div>';
        } else {
            echo '<div class="alert alert-danger">';
            echo '<strong>????????</strong>! ???? ???????? ?????? ???? ???????? ?????? ??????????';
            echo '</div>';
        }
        echo '<div id="data-updated">';
        echo '';
        echo '<form id="submit_update">';
        echo '<div class="right">';
        echo '<div class="text-align-center">';
        echo '';
        echo '<div class="image" id="imageP">';
        echo '<img src="http://localhost/pos/img/profile-teacher/' . $image_name . '" alt="????????" class="image-preview__image">';
        echo '</div>';
        echo '';
        echo '<br class="b-r"><br class="b-r"><br class="b-r"><br class="b-r"><br class="b-r"><br class="b-r"><br class="b-r"><br class="b-r"><br class="b-r"><br class="b-r"><br class="b-r"> <br>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* ??????????</b><br>';
        echo '<input type="file" name="image" accept="image/*" id="inputFile" title="??????????">';
        echo '</label>';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* ?????? ???????? / ??????????</b><br>';
        echo '<input type="text" id="name-of-teacher" title="?????? ???????? / ??????????" value="' . $teacher_name . '" required="" />';
        echo '</label>';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* ??????</b><br>';
        echo '<select id="gender" class="selection" id="" title="??????" required="" required>';
        echo '<option value="' . $gender . '" selected>' . $gender . '</option>';
        echo '<option value="????????">????????</option>';
        echo '<option value="????????">????????</option>';
        echo '<option value="??????">??????</option>';
        echo '</select>';
        echo '</label>';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* ??????????</b><br>';
        echo '<input type="text" id="father-name" title="??????????" value="' . $father_name . '" required="" />';
        echo '</label>';
        echo '';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* ??????</b><br>';
        echo '<input type="text" id="sir-name" title="??????" value="' . $cast . '" required="" />';
        echo '</label>';
        echo '';
        echo '</div>';

        echo '';
        echo '</div>';
        echo '<input type="submit" id="outter-btn" class="update-form-data" id="admission-form-submit" value="???????? ???? ?????? ????????" title="???????? ???? ?????? ????????">';
        echo '</div>';
        echo '';
        echo '<div class="left">';
        echo '<div class="text-align-center">';
        echo '';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* ?????????? ????????????</b><br>';
        echo '<input type="date" id="date-of-birth" title="?????????? ????????????" value="' . $date_of_birth . '" required="" />';
        echo '</label>';
        echo '';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* ?????????? ??????????</b><br>';
        echo '<input type="date" id="date-of-admission" title="?????????? ??????????" value="' . $date_of_admission . '" required="" />';
        echo '</label>';
        echo '';
        echo '</div>';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* ?????????? ????????????</b><br>';
        echo '<input type="numeric" id="fees" title="?????????? ????????????" value="' . $monthly_salary . '" required="" />';
        echo '</label>';
        echo '</div>';
        echo '';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* ????????</b><br>';
        echo '<input type="text" id="designation" title="????????" value="' . $designation . '" required="" />';
        echo '</label>';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* ???????? ???????????? ??????</b><br>';
        echo '<input type="text" id="address" title="???????? ???????????? ??????" value="' . $address . '" required="" />';
        echo '</label>';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* ???????? ???????????? ???????? ????????</b><br>';
        echo '<input type="numeric" id="CNIC" title="???????? ???????????? ???????? ????????" value="' . $cnic . '" required="">';
        echo '</label>';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* ???????????? ????????</b><br>';
        echo '<input type="numeric" id="mobile-number" title="???????????? ????????" value="' . $mobile_number . '" required="">';
        echo '</label>';
        echo '</div>';
        echo '';
        echo '<div class="input-feiled">';
        echo '<label for="">';
        echo '<b>* ???????????? ????????????</b><br>';
        echo '<input type="text" id="qualification" title="???????????? ????????????" required="" value="' . $qualification . '">';
        echo '</label>';
        echo '</div>';
        echo '';
        echo '<input type="submit" id="inner-btn" name="admission-form-submit" class="update-form-data" value="???????? ???? ?????? ????????" title="???????? ???? ?????? ????????">';
        echo '</div>';
        echo '</div>';
        echo '</form>';
        echo '</div>';
        ?>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

        <br>
        <div class="data-modification">
            <form action="teacher-admission-form.php" method="post">
                <?php
                echo '<input type="text" name="gr-id" id="gr-no" value="' . $gr_number . '" style="display:none;">';
                ?>
                <input type="submit" name="print" value="?????????? ??????" class="btn btn-primary" id="print-info">
            </form>

            <input type="submit" name="delete" value="?????? ??????" class="btn btn-danger" id="delete-info">

            <input type="submit" name="update" value="?????????? ??????" class="btn btn-success" id="update-info">
        </div>
    </div>

    <?php
    include('C:\xampp\htdocs\pos\assets\footer.php');
    ?>

    <script>
        $(document).ready(function() {
            // delete record function 
            function delete_record(gr) {
                if (confirm("?????? ?????? ???????? ?????? ???????? ?????????? ????????")) {

                    $.ajax({
                        url: "teacher-delete.php",
                        type: "POST",
                        data: {
                            id: gr
                        },
                        success: function(data) {
                            if (data == 1) {
                                $("#update-info, #delete-info, #print-info, .left, .right").fadeOut();
                                $("#success-message").fadeIn();
                                $("#error-message").fadeOut();
                            } else {
                                $("#error-message").fadeIn();
                                $("#message-message").fadeOut();
                            }
                        }
                    });
                }
            }
            // Delete record
            $("#delete-info").on("click", function(e) {
                var gr = $("#gr-no").val();
                $.ajax({
                    url: "salary_check.php",
                    type: "POST",
                    data: {
                        id: gr
                    },
                    success: function(data) {
                        if (data == 0) {
                            delete_record(gr);
                        } else if (data > 0) {
                            alert(data + " ?????????? ???? ?????? ?????? ???? ???????? ?????????? ???????? ?????????? ");
                            delete_record(gr);
                        } else if (data < 0) {
                            alert(data + " ?????? ???? ?????? ?????????? ???? ???????? ?????????? ???????? ?????????? ");
                            delete_record(gr);
                        } else {
                            alert(data);
                            alert("?????????? ?????????? ?????? ???????? ???? ?????? ???? ?????? ???????? ???????? ?????????????? ?????????? ?????????? ??????????");
                        }
                    }
                });
            });

            // Show form 
            $("#update-info").on("click", function(e) {
                $("#data-updated").show();
                $("#data-to-show").hide();
                $(".data-modification").hide();
                $(".container-pro-box").css("height", "1200px");

            });
            // Hide form
            // Hide form
            $("#submit_update").on("submit", function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "update.php",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if (data == 1) {
                            $("#data-updated").hide();
                            $("#data-to-show").show();
                            $(".data-modification").show();
                            $(".container-pro-box").css("height", "700px");

                            loadData(); //Load data
                        } else {
                            alert(data);
                        }
                    }
                });
            });

            // $(".update-form-data").on("click", function(e) {
            //     var gr = $("#gr-no").val();
            //     var s_name = $("#name-of-teacher").val();
            //     var gender = $("#gender").val();
            //     var father_name = $("#father-name").val();
            //     var cast = $("#sir-name").val();
            //     var date_of_birth = $("#date-of-birth").val();
            //     var date_of_admission = $("#date-of-admission").val();
            //     var monthly_fees = $("#fees").val();
            //     var designation = $("#designation").val();
            //     var address = $("#address").val();
            //     var cnic = $("#CNIC").val();
            //     var mobile_number = $("#mobile-number").val();
            //     var qualification = $("#qualification").val();

            //     $.ajax({
            //         url: "update.php",
            //         type: "POST",
            //         data: {
            //             gr_: gr,
            //             s_name_: s_name,
            //             gender_: gender,
            //             father_name_: father_name,
            //             cast_: cast,
            //             date_of_birth_: date_of_birth,
            //             date_of_admission_: date_of_admission,
            //             monthly_fees_: monthly_fees,
            //             designation: designation,
            //             address_: address,
            //             cnic_: cnic,
            //             mobile_number: mobile_number,
            //             qualification_: qualification
            //         },
            //         success: function(data) {
            //             if (data == 1) {
            //                 $("#data-updated").hide();
            //                 $("#data-to-show").show();
            //                 $(".data-modification").show();
            //                 $(".container-pro-box").css("height", "700px");

            //                 loadData(); //Load data
            //             } else {
            //                 alert(data);
            //             }
            //         }
            //     });


            // });

            // Load data fucntion 
            function loadData() {
                var gr = $("#gr-no").val();
                $.ajax({
                    url: "load-teacher-data.php",
                    type: "POST",
                    data: {
                        id: gr
                    },
                    success: function(data) {
                        $("#data-to-show").html(data);
                    }
                });
            }

        });
    </script>
</body>

</html>