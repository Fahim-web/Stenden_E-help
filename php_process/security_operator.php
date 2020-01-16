<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
require('connect_mar.php');
if (isset($_POST['submit'])) {
    $Selcustomerid = htmlentities($_POST['customerid']);

    $sql_security = "SELECT customerid,username,customer_name,password,filepath FROM customer WHERE customerid=? ";

    if ($stmt_security = mysqli_prepare($connect, $sql_security)) {
        mysqli_stmt_bind_param($stmt_security, 'i', $Selcustomerid);

        $security_execute = mysqli_stmt_execute($stmt_security);
        if ($security_execute == FALSE) {
            echo mysqli_error($connect);
        }
        mysqli_stmt_bind_result($stmt_security, $customerid, $username, $customer_name, $password, $filepath);
        mysqli_stmt_store_result($stmt_security);

        $clearence = '1';
        while (mysqli_stmt_fetch($stmt_security)) {

            $sql_insert = 'INSERT INTO Operator values(NULL,?,?,?,?,?)';
            if ($stmt_insert = mysqli_prepare($connect, $sql_insert)) {
                mysqli_stmt_bind_param($stmt_insert, 'ssiss', $username, $customer_name, $clearence, $password, $filepath);

                $security_insert_execute = mysqli_stmt_execute($stmt_insert);
                if ($security_insert_execute == FALSE) {
                    echo mysqli_error($connect);
                }
                mysqli_stmt_close($stmt_insert);
                // customer cannot have submited tickets if we want to delete his data
                // which makes sense since operator creates customer account just so that security operator can give him operator privligaes
                $sql_delete = "DELETE FROM Customer WHERE customerid=?";
                if ($stmt_delete = mysqli_prepare($connect, $sql_delete)) {

                    mysqli_stmt_bind_param($stmt_delete, 'i', $Selcustomerid);
                    $execute_delete = mysqli_stmt_execute($stmt_delete);

                    if ($execute_delete == FALSE) {
                        echo mysqli_error($connect);
                    } else {
                        // echo 'success';
                        $execute_delete = mysqli_stmt_execute($stmt_delete);
                    }
                    mysqli_stmt_close($stmt_delete);
                }
            }
        }
        mysqli_stmt_close($stmt_security);
    }
}
