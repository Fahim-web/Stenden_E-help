<?php
include('header.php');
require('connect_mar.php');

if (isset($_SESSION['operatorId'])) {
?>

    <div class="user_banner">
        <div class="user_banner_wrapper">
            <div class="user_banner_wrapper_pic">
                <img id="profilePic" src="https://i.ibb.co/VtWkjpZ/profile.png" alt="Profile picture">
            </div>
            <div class="user_banner_wrapper_msg">
                <h3>Welcome back <?php  ?> Ready to work?</h3>
            </div>
        </div>
    </div>
    <div class="content_wrapper">
        <!---BOX WID TIKET IN IT-->
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
                    <p>Awaits to be completed or approved</p>
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
        <?php
        // In this query we select all tickets that have not been yet assigned OR have been assigned to logged in operator

        $sql = 'SELECT i.incidentid,i.RegisteredBy,i.description,i.report_date,i.topic,o.operator_name,li.description,t.description,s.StatusID,o.operatorid,i.resolution_date,c.username 
    FROM incident as i, operator as o, customer as c, type as t, status as s,company as cmp, license as li 
    WHERE i.operatorid=o.operatorid AND i.typeID=t.typeID AND i.StatusID=s.StatusID AND i.customerID=c.customerID AND cmp.companyID=c.companyID AND cmp.LicenseID=li.LicenseID 

    AND o.operatorid=3 AND i.StatusID=1';

        if ($stmt_select = mysqli_prepare($connect, $sql)) {
            mysqli_stmt_bind_param($stmt_select, 'i', $_SESSION['operatorId']);
            $execute_select = mysqli_stmt_execute($stmt_select);
            if ($execute_select == FALSE) {
                echo mysqli_error($connect);
            }
            mysqli_stmt_bind_result($stmt_select, $incidentID, $registered_by, $description, $rep_date, $topic, $operatorName, $license, $typeDesc, $status, $opeID, $deadline, $customer_username);
            mysqli_stmt_store_result($stmt_select);




            if (mysqli_stmt_num_rows($stmt_select) == 0) {
                echo 'There is no open incidents';
            } else {
                // After executing positivly query we show all tickets that have not been assigned yet or that operator is currently working on
                // We show result in ascending order based on incident id. From the oldest ticket to newest 
                while (mysqli_stmt_fetch($stmt_select)) {

                    if ($status == 1) {
                        $srcpic = "https://i.ibb.co/g7W2LcZ/red.png";
                    } elseif ($status == 2) {
                        $srcpic = "https://i.ibb.co/L1XbrZG/green.png";
                    } elseif ($status == 3) {
                        $srcpic = "https://i.ibb.co/VHDmxhC/orange.png";
                    }

                    echo '<div class="ticket_box">
            <div class="ticket_box_top">
                <div class="ticket_box_id">
                    <p>ID#' . $incidentID . '</p>
                </div>

                <a href="ticket_maintanance.php?maintain=' . $incidentID . ':' . $_SESSION['operatorId'] . '">
                <div class="ticket_box_content">
                    <div class="ticket_box_content_title">
                        <h3>' . $topic . '</h3>
                    </div>
                    <div class="ticket_box_content_body">
                        <p>' . $description . '</p>
                    </div>
                    </a>
                </div>
            </div>
      
            <div class="ticket_box_bottom">';
                    if ($opeID != 3) {
                        echo '
                        <div class="ticket_box_assign">
                          <a href="#"><img class="ticket_box_assign_pic" src="../img/undertake.png" alt="Assign a Ticket"/>
                        </a></div>';
                    } elseif ($opeID == 3) {
                        echo '
                        <div class="ticket_box_assign">
                          <a href="operator_self_assign.php?update=' . $incidentID . ':' . $_SESSION['operatorId'] . '"><img class="ticket_box_assign_pic" src="https://i.ibb.co/881QtG6/open-a-ticket.png" alt="Assign a Ticket"/>
                        </a></div>';
                    }
                    echo '
                <div class="ticket_box_bottom_assignedTo">
                   <p>Assigned to:<br><br>' . $operatorName . '</p>
                </div>
                <div class="ticket_box_bottom_raisedBy">
                   <p>Registered by:<br><br>' . $registered_by . '</p>
                </div>
                <div class="ticket_box_bottom_priority">
                   <p>Priority:<br><br>' . $license . '</p>
                </div>
                <div class="ticket_box_bottom_category">
                  <p>Category:<br><br>' . $typeDesc . '</p>
                </div>
                <div class="ticket_box_bottom_category">
                  <p>Category:<br><br>' . $customer_username . '</p>
                </div>
                <div class="ticket_box_bottom_duedate">
                <p>Due Date:<br><br>' . $deadline . '</p>
                </div>
                <div class="ticket_box_bottom_status">
                    <img id="statusLight" src="' . $srcpic . '" alt="Status of the Ticket"/>
                </div>
            </div>
        </div>';
                }
            }
        }

        ?>
        <!--Additional "fake" boxes-->

    </div>

<?php
} else {
    header('Location:login_page.php?error=Not_loged_in');
    exit();
}
require("../html/footer.html");
?>