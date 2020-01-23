<?php
require('connect_mar.php');

if (isset($_GET['update'])) {
    $status = 1;
    $exp = explode(":", $_GET['update']);
    $sql_update = 'UPDATE incident SET operatorid=?, `statusid`=? WHERE incidentid=?';
    if ($stmt = mysqli_prepare($connect, $sql_update)) {
        mysqli_stmt_bind_param($stmt, 'iii', $exp[1], $status, $exp[0]);
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
