<?php
include('header.php');
?>


<div class="login_bg">
    <div class="container">
        <div class="login_form">
            <img src="img/login_img.png" alt="">
            <form action="" method="POST">
                <h2>Ready to work?</h2>
                <h3>Please write your operator login and password</h3>

                <input type="text" name="operatorname" placeholder="User name">
                <input type="password" name="pass" placeholder="user password">
                <input type="submit" value="Log in" name="submit">
            </form>
            <?php

            //if logged in -> index.php
            if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
                header("location: login_page.php");
                exit;
            }
            if (isset($_POST['submit'])) {
                if (empty(trim($_POST['operatorname']))) {
                    echo "Please fill in your username";
                } else {
                    $username = trim($_POST['operatorname']);
                    if (empty(trim($_POST['pass']))) {
                        echo "Please fill in your password";
                    } else {
                        $passwrd = trim($_POST['pass']);
                        $TbNameU = "operator";
                        $param_username = $_POST['operatorname'];
                        $check_user_qr = "SELECT OperatorID, username, password 
            FROM $TbNameU 
            WHERE username = ?";

                        if ($stmt = mysqli_prepare($con, $check_user_qr)) {
                            mysqli_stmt_bind_param($stmt, 's', $param_username);

                            //execute sql
                            if (mysqli_stmt_execute($stmt)) {
                                mysqli_stmt_store_result($stmt);
                                //check if username exists
                                if (mysqli_stmt_num_rows($stmt) == 1) {
                                    //bind result vars
                                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_pass);
                                    mysqli_stmt_store_result($stmt);

                                    // We verify the password
                                    password_verify($_POST['pass'], $hashed_pass);

                                    if (mysqli_stmt_fetch($stmt)) {
                                        // if(password_verify($passwrd, $hashed_pass)){

                                        $_SESSION['loggedIn'] = true;
                                        $_SESSION['operatorId'] = $id;
                                        $_SESSION['username_ope'] = $username;

                                        header("location: ../index.php");
                                        // }else{
                                        //     echo $passwrd;
                                        //    echo $hashed_pass;
                                        //      echo "Password incorrect!<br>";
                                        //}
                                    } else {
                                        echo "didnt fetch";
                                    }
                                } else {
                                    echo "fail";
                                }
                            } else {
                                echo "failed to exec";
                            }
                        } else {
                            echo "failed to prepare";
                        }
                        mysqli_stmt_close($stmt);
                        mysqli_close($con);
                    }
                }
            }

            ?>
        </div>
    </div>
</div>

<?php
require("../html/footer.html");
?>