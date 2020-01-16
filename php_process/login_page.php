<?php
include('header.php');
?>

<div class="login_bg">
    <div class="container">
        <div class="login_form">
            <img src="img/login_img.png" alt="">
            <form action="" method="POST">
                <h2>Long time no see!</h2>
                <h3>Please write your login and password</h3>

                <input type="text" name="user" placeholder="User name">
                <input type="password" name="pass" placeholder="user password">
                <input type="submit" value="Log in" name="submit">
                <a href="register_page.php">Still not registered? Click here!</a>
                <p> <a href="login_operator_page.php">Login as operator</a></p>
            </form>
            <?php
            // in header we already started session and in login we start another session();
            // It has to be fixed 

            //start

            if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
                header("location: login_page.php");
                exit;
            }
            if (isset($_POST['submit'])) {
                if (empty(trim($_POST['user']))) {
                    echo "Please fill in your username";
                } else {
                    $username = trim($_POST['user']);
                    if (empty(trim($_POST['pass']))) {
                        echo "Please fill in your password";
                    } else {
                        $passwrd = trim($_POST['pass']);
                        $TbNameU = "customer";
                        $check_user_qr = "SELECT CustomerID, username, password 
                        FROM $TbNameU 
                        WHERE username = ?";

                        if ($stmt = mysqli_prepare($con, $check_user_qr)) {
                            mysqli_stmt_bind_param($stmt, 's', $param_username);
                            $param_username = $username;
                            //execute sql
                            if (mysqli_stmt_execute($stmt)) {
                                mysqli_stmt_store_result($stmt);
                                //check if username exists
                                if (mysqli_stmt_num_rows($stmt) == 1) {
                                    //bind result vars
                                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_pass);

                                    if (mysqli_stmt_fetch($stmt)) {
                                        if (password_verify($passwrd, $hashed_pass)) {
                                            session_start();

                                            $_SESSION['loggedIn'] = true;
                                            $_SESSION['customerId'] = $id;
                                            $_SESSION['username'] = $username;

                                            header("location: index.html");
                                        } else {
                                            echo $passwrd;
                                            echo $hashed_pass;
                                            echo "Password incorrect!<br>";
                                        }
                                    } else {
                                        echo "didnt fetch";
                                    }
                                } else {
                                    echo "mysqli_stmt_num_rows($stmt)";
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

            //LOGIN end








            ?>
        </div>
    </div>
</div>

<?php
require("../html/footer.html");
?>