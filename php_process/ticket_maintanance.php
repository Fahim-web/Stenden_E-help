<?php
include('header.php');
?>


<?php

if (isset($_GET['maintain'])) {
    $exp = explode(":", $_GET['maintain']);

        $sql = "SELECT i.incidentid,i.RegisteredBy,i.description,i.report_date, i.resolution_date, i.topic,o.username,o.operator_name,li.description,t.description,s.StatusID,o.operatorid, cmp.name, o.filepath, c.filepath, c.username, c.email, sol.SolutionID, sol.Description, f.description
        FROM incident as i, operator as o, customer as c, type as t, status as s,company as cmp, license as li , solution as sol, frequency as f
        WHERE i.operatorid=o.operatorid AND i.typeID=t.typeID AND i.StatusID=s.StatusID AND i.customerID=c.customerID AND cmp.companyID=c.companyID AND cmp.LicenseID=li.LicenseID AND i.SolutionID=sol.SolutionID AND i.FrequencyID=f.FrequencyID
        AND i.customerID= " . $exp[1] . " AND i.incidentid = " . $exp[0] . ";";

    if ($stmt = mysqli_prepare($con, $sql)) {
        $execute = mysqli_stmt_execute($stmt);
        if ($execute == FALSE) {
            header('Location:ticket_maintanance.php?error=ExecuteIssue');
            exit();
        }
        //header('Location:ticket_maintanance.php?maintain=');
        mysqli_stmt_bind_result($stmt, $incidentID, $registered_by, $description, $rep_date, $res_date, $topic, $operUsername, $operatorName,
        $license, $typeDesc, $status, $opeID, $companyName, $opPic, $custPic, $custUsername, $custEmail, $solID, $solution, $frequency);
        mysqli_stmt_store_result($stmt);
        



        while (mysqli_stmt_fetch($stmt)) {
     echo
     '
     <body>
     <div class="content_wrapper">
    <div class="maintain_wrapper">
        <div class="maintain_client">
            <div class="maintain_client_info">';
            if ($solID != '5' && $opeID !='3' && $_SESSION['loggedInCustomer'] = true){
                $pic = $opPic;
                $row1 = 'Username: ' . $operUsername;
                $row2 = 'Name: ' . $operatorName;
                $row3 = 'ID: ' . $opeID;
            }else{
                $pic = $custPic;
                $row1 = 'Name: ' . $custUsername;
                $row2 = 'Comapny: ' . $companyName;
                $row3 = 'Email: ' . $custEmail;
            }
            echo '
                <img id="profilePic" src="' . $pic . '" alt="Profile picture">
                <div class="maintain_client_info_text">
                    <h4>' . $row1 . '</h4>
                    <h4>'. $row2 .'</h4>
                    <h4>' . $row3 . '</h4>
                </div>
            </div>
            <div class="maintain_client_text">
                <div class="bubble">
                    <h2>' . $topic . '</h2>
                    <p>' . $description . '</p>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="maintain_wrapper">
        <div class="maintain_client">
            <div class="maintain_client_info">
                <p>Date Reported: '.$rep_date.'</p>
                <p>Deadline Date: '.$res_date.'</p>
                <p>Registered By: '.$registered_by.'</p>
                <p>Type: '.$typeDesc.'</p>
                <p>Frequency: '.$frequency.'</p>
            </div>';

            if ($solID !== 5){
                echo '
            <div class="maintain_client_text">
                <!--IF TEXT APPEARS PUT TEXT INTO A .bubble_response(different color bubble with different dirrextion of a tail)-->
                <div class="bubble_response">';

                    echo '<p>'.$solution.'</p>
                    </div>
                </div>
            </div>
        </div>
        </div>
            ';
                }
                echo '
                </div>
        </div>
        <form id="maintain_form" action="" method="POST">
        ';

        }
    }
} else {
    header('Location:ticket_maintanance.php?error=Illegal_entrance');
    exit();
}



    //<!--START OF THE OPERATOR INPUT-->


    if (isset($clearance) && $status == '1' && $opeID == $_SESSION['operatorId']){
            echo "
            <div class='maintain_client_anwserBar'>
                <div class='maintain_client_anwserBar_wrap clearfix'>
                    <div class='maintain_client_anwserBar_text'>
                            <textarea id='textarea' id='response' name='response' placeholder='Write your response'></textarea>
                    </div>
                    <div class='maintain_client_anwserBar_buttons'>
                        <input type='checkbox' id='status' name='status' value='3'>
                        <label for='status'>
                            <h4>TICKET IS READY FOR TL's REVIEW</h4>
                        </label>
                        <button class='submitbtn' type='submit' name='submit'>Submit</button>
                    </div>
                </form>
            ";
            
            if (isset($_POST['submit'])){
                $response = htmlentities($_POST['response']); 
                
                if (isset($_POST['status'])){
                    $status = 3;
                        $sql_update_incident = 'UPDATE incident SET StatusID = ? WHERE IncidentID = ?';
                        if ($stmt_update = mysqli_prepare($con, $sql_update_incident)){
                            mysqli_stmt_bind_param($stmt_update, 'ii', $status, $incidentID);
                            $exec_update = mysqli_stmt_execute($stmt_update);
                            header('Location:ticket_maintanance.php?maintain=' . $incidentID . ':' . $exp[1] . '');
                            if ($exec_update == FALSE) {
                                echo "pizda";
                                exit();
                            }
                            mysqli_stmt_close($stmt_update);
                            exit();
                    }
                }


                $sql_insert_solution = 'INSERT INTO solution VALUES(NULL, ?)';

                if ($stmt_insert = mysqli_prepare($con, $sql_insert_solution)){
                    mysqli_stmt_bind_param(
                        $stmt_insert,
                        's',
                        $response
                    );
                    $exec_insert = mysqli_stmt_execute($stmt_insert);
                    if ($exec_insert == FALSE) {
                        header('Location:ticket_client.php?error=SelectIssue');
                    }
                    mysqli_stmt_close($stmt_insert);
                }
                
                if(!empty($solution)){
                    $anwser = $solution . '.<br>@: "' . date("h:i:s a") . '" ' . $operUsername . ': ' . $response;
                    $sql_update_solution = 'UPDATE solution SET Description = ? WHERE SolutionID = ?';
                    if ($stmt_update_sol = mysqli_prepare($con, $sql_update_solution)){
                        mysqli_stmt_bind_param($stmt_update_sol,'si',$anwser, $solID);
                        $exec_update = mysqli_stmt_execute($stmt_update_sol);
                        header('Location:ticket_maintanance.php?maintain=' . $incidentID . ':' . $exp[1] . '');
                        if ($exec_update == FALSE) {
                            echo "pizda";
                            exit();
                        }
                        mysqli_stmt_close($stmt_update_sol);
                        exit();
                    }
                }

                
                    $sql_select_solutionID = 'SELECT SolutionID FROM solution WHERE Description = ?';
                    if($stmt_select = mysqli_prepare($con, $sql_select_solutionID)){
                        mysqli_stmt_bind_param($stmt_select, 's', $response);
                        $exec_select = mysqli_stmt_execute($stmt_select);
                        mysqli_stmt_bind_result($stmt_select, $response);
                        mysqli_stmt_store_result($stmt_select);
                        if (mysqli_stmt_num_rows($stmt_select) == 0) {
                            header('Location:ticket_client.php?error=NoRowsFound');
                            exit();
                        } else {
                            $sql_update_incident = 'UPDATE incident SET StatusID = ?, SolutionID = ? WHERE IncidentID = ?';
                            while(mysqli_stmt_fetch($stmt_select)){
                                if ($stmt_update = mysqli_prepare($con, $sql_update_incident)){
                                    mysqli_stmt_bind_param($stmt_update, 'isi', $status, $response, $incidentID);
                                    $exec_update = mysqli_stmt_execute($stmt_update);
                                    header('Location:ticket_maintanance.php?maintain=' . $incidentID . ':' . $exp[1] . '');
                                    
                                    if ($exec_update == FALSE) {
                                        echo "pizda";
                                        exit();
                                    }
                                    mysqli_stmt_close($stmt_update);
                                    exit();
                                }
                            }
                        }
                        mysqli_stmt_close($stmt_select);
                    }else{
                        echo "fill in the fields";
                    }    
                }
                    unset($response);
                    //<!--END OF OPERATOR INPUT-->
                    //<!--START OF TEAM LEADER INPUT-->

            }elseif(isset($clearance) && $clearance=='3' && $solID !== '5' && $status == '3'){
                echo "
                <div class='maintain_client_anwserBar'>
                    <div class='maintain_client_anwserBar_wrap clearfix'>
                            <div class='maintain_client_anwserBar_text'>
                                <textarea id='textarea' id='response' name='response' placeholder='Write your response'></textarea>
                            </div>
                        <div class='maintain_client_anwserBar_buttons'>
                            <input type='checkbox' id='status' name='status' value= '5' >
                            <label for='status'>
                                <h4>Ticket is approved by Team Leader</h4>
                            </label>
                            <button class='submitbtn' type='submit' name='submit'>Submit</button>
                        </div>
                        </form>


                ";


                  if (isset($_POST['submit'])){
                    $response = htmlentities($_POST['response']);
                    //$response = $solution . '. *Team Leader Added*: ' . $response;

                    if (isset($_POST['status'])){
                        $status = 2;
                        $sql_update_incident = 'UPDATE incident SET StatusID = ? WHERE IncidentID = ?';
                        if ($stmt_update = mysqli_prepare($con, $sql_update_incident)){
                            mysqli_stmt_bind_param($stmt_update, 'ii', $status, $incidentID);
                            $exec_update = mysqli_stmt_execute($stmt_update);
                            header('Location:ticket_maintanance.php?maintain=' . $incidentID . ':' . $exp[1] . '');
                            
                            if ($exec_update == FALSE) {
                                echo "pizda";
                                exit();
                            }
                            mysqli_stmt_close($stmt_update);
                            exit();
                        }
                    }

                    $anwser = $solution . '.<br>@: "' . date("h:i:s a") . '" Team Leader Added: ' . $response;
                    $sql_update_solution = 'UPDATE solution SET Description = ? WHERE SolutionID = ?';
                    if ($stmt_update_sol = mysqli_prepare($con, $sql_update_solution)){
                        mysqli_stmt_bind_param($stmt_update_sol,'si',$anwser, $solID);
                        $exec_update = mysqli_stmt_execute($stmt_update_sol);
                        header('Location:ticket_maintanance.php?maintain=' . $incidentID . ':' . $exp[1] . '');

                        if ($exec_update == FALSE) {
                            echo "pizda";
                            exit();
                        }
                        mysqli_stmt_close($stmt_update_sol);
                        exit();
                    }
                }
            }
            

unset($response);
unset($anwser);
            //<!--END OF TEAM LEADER INPUT-->
    echo "


    </div>";

require("../html/footer.html");
?>