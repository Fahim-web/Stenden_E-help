<?php
require('connect_mar.php');
require('header.php');
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
if (isset($_POST['submit'])) {
    //        TABLES
    $incident = 'incident';
    $type_tb = 'type';
    //        TICKET
    $type = htmlentities($_POST['type']);
    $topic =  htmlentities($_POST['topic']);
    $description =  htmlentities($_POST['description']);
    $frequency =  htmlentities($_POST['freq']);
    $user = 'user';
    $statusid = 1;
    $registered_by = 'customer';
    $customerid = $_SESSION['customerId'];
    $Date = date('Y-m-d');
    

    if (empty($topic) || empty($description)) {
        header('Location:ticket_client.php?error=EmptyForm');
        exit();
    }
    $sql_select = "SELECT l.licenseid 
    FROM license as l, customer as c, company as com 
    WHERE l.LicenseID=com.LicenseID AND com.companyID=c.companyID AND customerid= ?;";

    // $sql_select = "SELECT t.typeid, f.frequencyid FROM type as t, status as s,frequency as f WHERE t.description=? AND f.description=? ;";
    if ($stmt_select =  mysqli_prepare($connect, $sql_select)) {
        mysqli_stmt_bind_param($stmt_select, 'i', $customerid);
        $execute_select = mysqli_stmt_execute($stmt_select);
        if ($execute_select == FALSE) {
            //                echo mysqli_error($connect);
            header('Location:ticket_client.php?error=SelectIssue');
            exit();
        }

        $mysqli = new mysqli("localhost", "root", "", "ssd");

        if ($stmt = $mysqli->prepare('SELECT FrequencyID FROM frequency WHERE description = ?')) {
            /* bind parameters for markers */
            $stmt->bind_param('s', $frequency);
            /* execute query */
            $stmt->execute();
    
            /* bind result variables */
            $stmt->bind_result($frequencyid);
    
            /* fetch value */
            $stmt->fetch();
    
            $stmt->close();
        }

        if ($stmt = $mysqli->prepare('SELECT typeid FROM type WHERE description = ?')) {

            /* bind parameters for markers */
            $stmt->bind_param("s", $type);
        
            /* execute query */
            $stmt->execute();
        
            /* bind result variables */
            $stmt->bind_result($typeid);
        
            /* fetch value */
            $stmt->fetch();
        
            $stmt->close();
        }

        
        
        mysqli_stmt_bind_result($stmt_select, $licenseid);
        mysqli_stmt_store_result($stmt_select);
        if (mysqli_stmt_num_rows($stmt_select) == 0) {
            //                echo mysqli_error($connect);
            header('Location:ticket_client.php?error=NoLicenseKey');
            exit();
        } else {


            $sql_insert = 'INSERT INTO incident VALUES(NULL,?,?,?,?,?,?,?,?,?,?,?);';

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
                $solutionid = '5';
                $operatorid = '3';
                if ($stmt_insert = mysqli_prepare($connect, $sql_insert)) {

                    mysqli_stmt_bind_param(
                        $stmt_insert,
                        'iiiisssssss',
                        $typeid,
                        $solutionid,
                        $operatorid,
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
                        //                                          echo mysqli_error($connect);
                        header('Location:ticket_client.php?error=InsertIssue');
                        exit();
                    }
                    mysqli_stmt_close($stmt_insert);
                    header('Location:client_ticket_view.php?Success=TicketSubmited');
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
