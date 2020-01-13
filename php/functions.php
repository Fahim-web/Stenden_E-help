<?php

function get_ticket_maintain(){

include "include/connect.php";

$get_ticket = "SELECT * from incident where IncidentID = '$get_incident_id'";

$run_ticket = mysqli_query($con, $get_ticket);

while ($row_posts = mysqli_fetch_array($row_posts)){
    $incident_id = $row_posts['IncidentID'];
    $sol_id = $row_posts['SolutionID'];
    $type_id = $row_posts['TypeID'];
    $oper_id = $row_posts['OperatorID'];
    $stat_id = $row_posts['StatusID'];
    $cust_id = $row_posts['CustomerID'];
    $freq_id = $row_posts['FrequencyID'];
    $topic = $row_posts['Topic'];
    $desc = $row_posts['Description'];
    $regist_by = $row_posts['RegisteredBy'];
    $report_date = $row_posts['report_date'];
    $res_date = $report_date;

    $userqr = "SELECT * FROM customer WHERE CustomerID = $cust_id";

    $run_user = mysqli_query($con, $userqr);
    $row_user = mysqli_fetch_array($run_user);

    $user_name = $row_user['username'];
    $user_comp_id = $row_user['CompanyID'];
    $user_phone = $row_user['phone'];
    $user_email = $row_user['email'];
    $user_img = $row_user['file_path'];

    $compqr = "SELECT * FROM company WHERE companyID = $user_comp_id";
    $run_comp =  mysqli_query($con, $compqr);
    $row_comp = mysqli_fetch_array($run_comp);
    
}

?>