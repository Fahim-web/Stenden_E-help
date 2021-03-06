<?php
if (isset($_POST['submit'])) {
    if (!empty($_POST['user']) && ($_POST['cust_name']) && ($_POST['phone']) && ($_POST['email']) && ($_POST['pass']) && ($_POST['repass'])) {

        if (isset($_POST['submit'])) {

            $user = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_STRING);
            $custName = filter_input(INPUT_POST, 'cust_name', FILTER_SANITIZE_STRING);
            $pass =  $_POST['pass'];
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
            $imgPath = "../userImg/" . $_FILES['picture_input']['name'];
            $repass = $_POST['repass'];
            $TbName = "customer";

            if ($_POST['pass'] != $_POST['repass']) {
                echo "Your passwords do not match!<br>";
            } else {
                include 'connect.php';
                //username check
                $user_check_qr = "SELECT username from $TbName where username = ?;";
                if ($stmt = mysqli_prepare($con, $user_check_qr)) {
                    mysqli_stmt_bind_param($stmt, 's', $username);
                    //set param
                    $username = trim($_POST['user']);
                    //execute
                    if (mysqli_stmt_execute($stmt)) {
                        //store result
                        mysqli_stmt_store_result($stmt);

                        if (mysqli_stmt_num_rows($stmt) == 1) {
                            header("Location:register_page.php?error=User_Name_Already_Taken");
                            exit();
                        } else {

                            //password check
                            if (strlen(trim($_POST['pass'])) < 5) {
                                header("Location:register_page.php?error=Password_must_be_atleast_6_characters_long!");
                                exit();
                            } else {

                                $password = trim($_POST['pass']);
                                move_uploaded_file($_FILES['picture_input']['tmp_name'], $imgPath);

                                $qr = "INSERT INTO customer VALUES(NULL,NULL, ?, ?, ?, ?, ?, ?);";
                                if ($stmt = mysqli_prepare($con, $qr)) {
                                    mysqli_stmt_bind_param($stmt, 'ssssss', $username, $custName, $phone, $email, $pass_param, $imgPath);


                                    //hashing pass
                                    $pass_param = password_hash($pass, PASSWORD_DEFAULT);

                                    if (mysqli_stmt_execute($stmt)) {

                                        //file upload include
                                        include 'picture_upload.php';


                                        header("Location:login_page.php?Works=Account_created");
                                        exit();
                                    } else {
                                        echo "Error creating account!";
                                    }
                                } else {
                                    echo "couldn't prepare";
                                }
                            }




                            mysqli_stmt_close($stmt);
                            mysqli_close($con);
                        }
                    }
                }
            }
        }
    } else {
        header("Location:register_page.php?error=Fill_out_form");
        exit();
    }
} else {
    header("Location:register_page.php?error=Illegal_entrance");
    exit();
}
