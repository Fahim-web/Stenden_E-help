<?php


include "php_process/connect.php";
include "php_process/session.php";
//if logged in -> index.php
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: login_page.php");
    exit;
}
if (isset($_POST['submit'])){
    if (empty(trim($_POST['operatorname']))){
        echo "Please fill in your username";
    }else{
        $username = trim($_POST['operatorname']);
        if (empty(trim($_POST['pass']))){
            echo "Please fill in your password";
        }else{
            $passwrd = trim($_POST['pass']);
            $TbNameU = "operator";
            $check_user_qr = "SELECT OperatorID, username, password 
            FROM $TbNameU 
            WHERE username = ?";

            if($stmt = mysqli_prepare($con, $check_user_qr)){
                mysqli_stmt_bind_param($stmt, 's', $param_username);
                $param_username = $username;
                //execute sql
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                    //check if username exists
                    if(mysqli_stmt_num_rows($stmt) == 1){
                        //bind result vars
                        mysqli_stmt_bind_result($stmt, $id, $username, $hashed_pass);
                        
                        if (mysqli_stmt_fetch($stmt)){
                           // if(password_verify($passwrd, $hashed_pass)){
                                session_start();

                                $_SESSION['loggedIn'] = true;
                                $_SESSION['operatorId'] = $id;
                                $_SESSION['username'] = $username;

                                header("location: index.php");
                           // }else{
                           //     echo $passwrd;
                           //    echo $hashed_pass;
                          //      echo "Password incorrect!<br>";
                            //}
                        }else{
                            echo "didnt fetch";
                        }
                    }else{
                        echo "mysqli_stmt_num_rows($stmt)!";
                    }
                }else{
                    echo "failed to exec";
                }
            }else{
                echo "failed to prepare";
            }
            mysqli_stmt_close($stmt);
        mysqli_close($con);
    }   
        }
        
}












?>