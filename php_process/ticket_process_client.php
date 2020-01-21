<?php
require('connect_mar.php');
require('session.php');
echo mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if (isset($_POST['submit'])) {
    //        TABLES
    $incident = 'incident';
    $type_tb = 'type';
    //        TICKET
    $solutionid = 5;
    $type = htmlentities($_POST['type']);
    $topic =  htmlentities($_POST['topic']);
    $description =  htmlentities($_POST['description']);
    $frequency =  htmlentities($_POST['freq']);
    $statusid = 1;
    $registered_by = 'customer';
    $Date = date('Y-m-d');

    if (empty($topic) || empty($description)) {
        header('Location:ticket_client.php?error=EmptyForm');
        exit();
    }
    $sql_select = "SELECT l.licenseid,t.typeid, f.frequencyid FROM type as t, status as s,frequency as f, company as com, customer as c, license as l WHERE c.companyid=com.companyid AND com.licenseid=l.licenseid
    AND t.description=? AND f.description=? AND c.customerid=?;";

    // $sql_select = "SELECT t.typeid, f.frequencyid FROM type as t, status as s,frequency as f WHERE t.description=? AND f.description=? ;";
    if ($stmt_select =  mysqli_prepare($connect, $sql_select)) {
        mysqli_stmt_bind_param($stmt_select, 'ssi', $type, $frequency,  $_SESSION['customerId']);
        $execute_select = mysqli_stmt_execute($stmt_select);
        if ($execute_select == FALSE) {
            //                echo mysqli_error($connect);
            header('Location:ticket_client.php?error=SelectIssue');
            exit();
        }
        mysqli_stmt_bind_result($stmt_select, $licenseid, $typeid, $frequencyid);
        mysqli_stmt_store_result($stmt_select);
        if (mysqli_stmt_num_rows($stmt_select) == 0) {
            // echo mysqli_error($connect);
            header('Location:ticket_client.php?error=NoRowsFound');
            exit();
        } else {


            $sql_insert = 'INSERT INTO incident VALUES(NULL,NULL,?,?,?,?,?,?,?,?,?,?);';

            while (mysqli_stmt_fetch($stmt_select)) {

                // We create due date variable. Since customer has license, submited ticket by him has due date.
                // There are 3 types of licenses 1:Gold 24hrs 2:Silver 48 hrs 3:Bronze 72hrs;
                if ($licenseid == 1) {
                    $due_date = date('Y-m-d', strtotime($Date . ' + 3 days'));
                } elseif ($licenseid == 2) {
                    $due_date = date('Y-m-d', strtotime($Date . ' + 2 days'));
                } elseif ($licenseid == 3) {
                    $due_date = date('Y-m-d', strtotime($Date . ' + 1 days'));
                }

                // Since no operator is assigned when we submit ticket mysqli_stmt_num_rows on line 33 will be executed because no operator name will be found
                //  That is why we create additional operator in database

                $operatorid = '3';
                if ($stmt_insert = mysqli_prepare($connect, $sql_insert)) {

                    mysqli_stmt_bind_param(
                        $stmt_insert,

                        'iiiisssssss',
                        $solutionid,

                        $typeid,
                        $operatorid,
                        $statusid,
                        $_SESSION['customerId'],
                        $frequencyid,
                        $topic,
                        $description,
                        $registered_by,
                        $Date,
                        $due_date
                    );

                    $execute_insert = mysqli_stmt_execute($stmt_insert);
                    if ($execute_insert == FALSE) {
                        //                                          echo mysqli_error($connect);
                        header('Location:ticket_client.php?error=InsertIssue');
                        exit();
                    }
                    mysqli_stmt_close($stmt_insert);
                    header('Location:ticket_client.php?Success=TicketSubmited');
                    exit();
                }
            }
        }
        mysqli_stmt_close($stmt_select);
    }
} else {
    header('Location:ticket_client.php?error=IllegalEntrance');
    exit();
}
mysqli_close($connect);
