<?php
require('connect_mar.php');
require('session.php');

if (isset($_POST['submit'])) {
    //        TABLES
    $incident = 'incident';
    $type_tb = 'type';
    //        TICKET
    $solutionid = 5;
    $client_username = htmlentities($_POST['client_username']);
    $type = htmlentities($_POST['type']);
    $topic =  htmlentities($_POST['topic']);
    $description =  htmlentities($_POST['description']);
    $frequency =  htmlentities($_POST['freq']);
    $user = 'user';
    $status = '1';
    $registered_by = 'phone';
    $Date = date('Y-m-d');

    if (empty($topic) || empty($description)) {
        header('Location:ticket_operator.php?error=EmptyForm');
        exit();
    }
    //We check if customer username exists in our database. We also select type, status and frequency of incident that we selected in previous page 
    $sql_select = "SELECT c.customerid,t.typeid, s.statusid, f.frequencyid,l.licenseid FROM customer as c,type as t, status as s,frequency as f, license as l, company as com
     WHERE c.companyid=com.companyid AND com.licenseid=l.licenseid AND c.username=? AND t.description=? AND s.statusid=? AND f.description=? ;";
    if ($stmt_select =  mysqli_prepare($connect, $sql_select)) {
        mysqli_stmt_bind_param($stmt_select, 'ssss', $client_username, $type, $status, $frequency);
        $execute_select = mysqli_stmt_execute($stmt_select);
        if ($execute_select == FALSE) {
            //                echo mysqli_error($connect);
            header('Location:ticket_operator.php?error=SelectIssue');
            exit();
        }
        // We bind results from above query
        mysqli_stmt_bind_result($stmt_select, $customerid, $typeid, $statusid, $frequencyid, $licenseid);
        mysqli_stmt_store_result($stmt_select);
        if (mysqli_stmt_num_rows($stmt_select) == 0) {
            //                echo mysqli_error($connect);
            header('Location:ticket_operator.php?error=NoRowsFound');
            exit();
        } else {
            // We insert into incident all of the values that we called in previous query and other values from form in previous page.
            // Those are: description of ticket,day it was registered,Topic of ticket etc.
            $sql_insert = 'INSERT INTO incident VALUES(NULL,?,?,?,?,?,?,?,?,?,?,?);';

            while (mysqli_stmt_fetch($stmt_select)) {
                if ($licenseid == 1) {
                    $due_date = date('Y-m-d', strtotime($Date . ' + 3 days'));
                } elseif ($licenseid == 2) {
                    $due_date = date('Y-m-d', strtotime($Date . ' + 2 days'));
                } elseif ($licenseid == 3) {
                    $due_date = date('Y-m-d', strtotime($Date . ' + 1 days'));
                }

                // Since no operator is assigned when we submit ticket mysqli_stmt_num_rows on line 33 will be executed because no operator name will be found
                //  That is why we create additional operator in database

                $solutionid = '5';

                if ($stmt_insert = mysqli_prepare($connect, $sql_insert)) {
                    // mysqli_stmt_bind_param($stmt_insert,'iiississ',$typeid,$statusid,
                    //         $frequencyid,$topic,$description,$frequencyid,$registered_by,$date);
                    //                        with customer

                    mysqli_stmt_bind_param(
                        $stmt_insert,
                        'iiiiiisssss',
                        $solutionid,
                        $typeid,
                        $_SESSION['operatorId'],
                        $statusid,
                        $customerid,
                        $frequencyid,
                        $topic,
                        $description,
                        $registered_by,
                        $Date,
                        $due_date
                    );

                    $execute_insert = mysqli_stmt_execute($stmt_insert);
                    if ($execute_insert == FALSE) {
                        // echo mysqli_error($connect);
                        header('Location:ticket.php?error=InsertIssue');
                        exit();
                    }
                    mysqli_stmt_close($stmt_insert);
                    header('Location:ticket_operator.php?Success=TicketSubmited');
                    exit();
                }
            }
        }
        mysqli_stmt_close($stmt_select);
    }
} else {
    header('Location:ticket_operator.php?error=IllegalEntrance');
    exit();
}
mysqli_close($connect);
