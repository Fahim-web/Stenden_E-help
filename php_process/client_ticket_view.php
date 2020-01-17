<?php

require('connect_mar.php');
?>


<?php
include('header.php');
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
?>

<div class="user_banner">
    <div class="user_banner_wrapper">
        <div class="user_banner_wrapper_pic">
            <img id="profilePic" src="https://i.ibb.co/VtWkjpZ/profile.png" alt="Profile picture">
        </div>
        <div class="user_banner_wrapper_msg">
            <h3>Welcome back <?php echo $_SESSION['username']; ?> .Ready to work?</h3>
        </div>
    </div>
</div>
<div class="content_wrapper">
    <div class='view_legend'>
        <div class="legend_Lvl_1">
            <div>
                <img class="legendlight" src="https://i.ibb.co/g7W2LcZ/red.png" alt="Status of the Ticket" />
            </div>
            <div>
                <p>Awaits to be assigned</p>
            </div>
        </div>
        <div class="legend_Lvl_1">
            <div>
                <img class="legendlight" src="../img/orange.png" alt="Status of the Ticket" />
            </div>
            <div>
                <p>Awaits to be approved</p>
            </div>
        </div>
        <div class="legend_Lvl_1">
            <div>
                <img class="legendlight" src="../img/green.png" alt="Status of the Ticket" />
            </div>
            <div>
                <p>Done</p>
            </div>
        </div>
    </div>
    <!---BOX WID TIKET IN IT-->
    <?php

    // We select all the tickets that this customer has asubmitted

    $sql_select = "SELECT i.incidentid,i.description,i.report_date,i.topic,o.operator_name,c.customer_name,li.description,t.description,s.StatusID,i.resolution_date
            FROM incident as i, operator as o, customer as c, type as t, status as s,company as cmp, license as li WHERE i.operatorid=o.operatorid AND i.typeID=t.typeID and i.StatusID=s.StatusID and 
            i.customerID=c.customerID and cmp.companyID=c.companyID AND cmp.LicenseID=li.LicenseID AND c.customerid=? ORDER BY i.incidentid DESC;";
    if ($stmt_select = mysqli_prepare($connect, $sql_select)) {
        mysqli_stmt_bind_param($stmt_select, 'i', $_SESSION['customerId']);
        $execute = mysqli_stmt_execute($stmt_select);
        if ($execute == FALSE) {
            header('Location:client_ticket_view.php?error=Execute_Select');
            exit();
        }
        mysqli_stmt_bind_result($stmt_select, $incID, $incDescription, $incReportDate, $incTopic, $opeName, $CustName, $CompLicense, $TypeDescription, $Statusid, $resolution_date);
        mysqli_stmt_store_result($stmt_select);

        if (mysqli_stmt_num_rows($stmt_select) == 0) {
            echo '<div id="none_submitted">
                            <h3>No tickets have been submitted</h3>
                        </div>';
            // header('Location:client_ticket_view.php?error=No_Tickets_Submited');
            // exit();
        }

        while (mysqli_stmt_fetch($stmt_select)) {
            echo ' <div class="ticket_box">
                    <div class="ticket_box_top">
                        <div class="ticket_box_id">
                            <p>TicketID' . $incID . '</p>
                        </div>
                        <div class="ticket_box_content">
                            <div class="ticket_box_content_title">
                                <h3>' . $incTopic . '</h3>
                            </div>
                            <div class="ticket_box_content_body">
                                <p>' . $incDescription . '</p>
                            </div>
                        </div>
                    </div>
              
                    <div class="ticket_box_bottom">
                        <div class="ticket_box_assign">
                          </div>
                        <div class="ticket_box_bottom_assignedTo">
                           <p>Assigned to:<br><br>' . $opeName . '</p>
                        </div>
                        <div class="ticket_box_bottom_raisedBy">
                           <p>Registered by:<br><br>' . $CustName . '</p>
                        </div>
                        <div class="ticket_box_bottom_priority">
                           <p>Priority:<br><br>' . $CompLicense . '</p>
                        </div>
                        <div class="ticket_box_bottom_category">
                          <p>Category:<br><br>' . $TypeDescription . '</p>
                        </div>
                        <div class="ticket_box_bottom_duedate">
                        <p>Due Date:<br><br>' . $resolution_date . '</p>
                        </div>
                        <div class="ticket_box_bottom_status">';
            if ($Statusid == '1') {
                echo '<img class="statusLight" src="https://i.ibb.co/g7W2LcZ/red.png" alt="Status of the Ticket"/>';
            } elseif ($Statusid == '2') {
                echo  '<img class="light" src="../img/green.png" alt="Status of the Ticket"/>';
            } elseif ($Statusid == '3') {
                echo  '<img class="light" src="../img/orange.png" alt="Status of the Ticket"/>';
            }
            echo '                                                                
                        </div>
                    </div>
                </div>';
        }
        mysqli_stmt_close($stmt_select);
    }
    ?>


</div>

<?php
require("../html/footer.html");
mysqli_close($connect);
?>