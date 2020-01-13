<?php
require('php_process/connect.php');
if (isset($_POST['submit'])) {
    $Selcustomerid = htmlentities($_POST['customerid']);

    $sql_security = "SELECT customerid,username,customer_name,password FROM customer WHERE customerid=? ";

    if ($stmt_security = mysqli_prepare($connect, $sql_security)) {
        mysqli_stmt_bind_param($stmt_security, 'i', $Selcustomerid);

        $security_execute = mysqli_stmt_execute($stmt_security);
        if ($security_execute == FALSE) {
            echo mysqli_error($connect);
        }
        mysqli_stmt_bind_result($stmt_security, $customerid, $username, $customer_name, $password);
        mysqli_stmt_store_result($stmt_security);

        $clearence = '1';
        while (mysqli_stmt_fetch($stmt_security)) {

            $sql_insert = 'INSERT INTO Operator values(NULL,?,?,?,?)';
            if ($stmt_insert = mysqli_prepare($connect, $sql_insert)) {
                mysqli_stmt_bind_param($stmt_insert, 'ssis', $username, $customer_name, $clearence, $password);

                $security_insert_execute = mysqli_stmt_execute($stmt_insert);
                if ($security_insert_execute == FALSE) {
                    echo mysqli_error($connect);
                }
                mysqli_stmt_close($stmt_insert);

                $sql_delete = "DELETE FROM Customer WHERE customerid=?";
                if ($stmt_delete = mysqli_prepare($connect, $sql_delete)) {

                    mysqli_stmt_bind_param($stmt_delete, 'i', $Selcustomerid);
                    $execute_delete = mysqli_stmt_execute($stmt_delete);

                    if ($execute_delete == FALSE) {
                        echo mysqli_error($connect);
                    } else {
                        echo 'success';
                    }
                    mysqli_stmt_close($stmt_delete);
                }
            }
        }
        mysqli_stmt_close($stmt_security);
    }
}
