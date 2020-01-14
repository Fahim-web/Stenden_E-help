<?php
    require('connect.php');

    if(isset($_POST['submit'])){
//        TABLES
        $incident='incident';
        $type_tb='type';
//        TICKET
        $type= htmlentities($_POST['type']);
        $topic=  htmlentities($_POST['topic']);
        $description=  htmlentities($_POST['description']);
        $frequency=  htmlentities($_POST['freq']);
        $user='user';
        $status='opened';
        $registered_by='customer';
        $date=date('Y-m-d');
//        $customerid='1';
        if(empty($topic)|| empty($description)){
            header('Location:../ticket.php?error=EmptyForm');
            exit();
        }        
        $sql_select="SELECT t.typeid, s.statusid, f.frequencyid FROM type as t, status as s,frequency as f WHERE t.description=? AND s.description=? AND f.description=? ;";
        if($stmt_select=  mysqli_prepare($connect, $sql_select)){
            mysqli_stmt_bind_param($stmt_select,'sss',$type,$status,$frequency);
            $execute_select=mysqli_stmt_execute($stmt_select);
            if($execute_select==FALSE){
//                echo mysqli_error($connect);
                header('Location:../ticket.php?error=SelectIssue');
                exit();
            }
            mysqli_stmt_bind_result($stmt_select, $typeid,$statusid,$frequencyid);
            mysqli_stmt_store_result($stmt_select);
            if(mysqli_stmt_num_rows($stmt_select)==0){
                //                echo mysqli_error($connect);
                header('Location:../ticket.php?error=NoRowsFound');
                exit();
            }else{
                $sql_insert='INSERT INTO incident VALUES(NULL,NULL,?,NULL,?,NULL,?,?,?,?,?,?,NULL);';
//                With customer
//                $sql_insert='INSERT INTO incident VALUES(NULL,NULL,?,NULL,?,?,?,?,?,?,?,?,NULL);';
                
                while(mysqli_stmt_fetch($stmt_select)){                   
                    echo$typeid;
                    echo$statusid;
                    echo$frequencyid;
                    if($stmt_insert=mysqli_prepare($connect,$sql_insert)){
                        mysqli_stmt_bind_param($stmt_insert,'iiississ',$typeid,$statusid,
                                $frequencyid,$topic,$description,$frequencyid,$registered_by,$date);
//                        with customer
//                        mysqli_stmt_bind_param($stmt_insert,'iiiississ',$typeid,$statusid,$customerid,
//                                $frequencyid,$topic,$description,$frequencyid,$registered_by,$date);
                        $execute_insert=mysqli_stmt_execute($stmt_insert);
                        if($execute_insert==FALSE){
//                                          echo mysqli_error($connect);
                            header('Location:../ticket.php?error=InsertIssue');
                            exit();  
                        }mysqli_stmt_close($stmt_insert);
                        header('Location:../ticket.php?Success=TicketSubmited');
                        exit();
                    }
                }
            }mysqli_stmt_close($stmt_select);
            
        }
    }else{
        header('Location:../ticket.php?error=IllegalEntrance');
        exit();
    }
    mysqli_close($connect);
