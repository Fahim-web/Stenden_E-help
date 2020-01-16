<?php
require('connect_mar.php');

if (isset($_GET['update'])) {
    $exp = explode(":", $_GET['update']);
    $sql_update = 'UPDATE incident SET operatorid=? WHERE incidentid=?';
    if ($stmt = mysqli_prepare($connect, $sql_update)) {
        mysqli_stmt_bind_param($stmt, 'ii', $exp[1], $exp[0]);
        $execute = mysqli_stmt_execute($stmt);
        if ($execute == FALSE) {
            header('Location:operator.php?error=ExecuteIssue');
            exit();
        }
        // echo $exp[0];
        // echo $exp[1];
        header('Location:operator.php?Update=Updated');
        exit();
    }
} else {
    header('Location:operator.php?error=Illegal_entrance');
    exit();
}
