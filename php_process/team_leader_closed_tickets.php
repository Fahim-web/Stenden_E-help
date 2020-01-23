<?php
require('connect_mar.php');
?>


<?php
require('header.php');

?>

<div class="user_banner">
    <div class="user_banner_wrapper">
        <div class="user_banner_wrapper_pic">

            <?php
            $operatorid = $_SESSION['operatorId'];
            $mysqli = new mysqli("localhost", "root", "", "ssd");
            if ($stmt = $mysqli->prepare('SELECT filepath, Operator_name FROM operator WHERE OperatorID = ?')) {
                /* bind parameters for markers */
                $stmt->bind_param('i', $operatorid);
                /* execute query */
                $stmt->execute();

                /* bind result variables */
                $stmt->bind_result($filepath, $customer);

                /* fetch value */
                $stmt->fetch();

                $stmt->close();
            }

            echo '
            <img id="profilePic" src="' . $filepath . '" alt="Profile picture">
            </div>
            <div class="user_banner_wrapper_msg">
            <h3>Welcome back <b>' . $customer . '</b></h3>
            </div>
                ';
            ?>
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
        $customerid = 2;
        // We select all the submited tickets by customers from database

        $sql_select = "SELECT i.incidentid,i.description,i.report_date,i.topic,o.operator_name,c.customer_name,li.description,t.description,s.StatusID,o.operatorID,c.username, c.customerID
            FROM incident as i, operator as o, customer as c, type as t, status as s,company as cmp, license as li WHERE i.operatorid=o.operatorid AND i.typeID=t.typeID and i.StatusID=s.StatusID and 
            i.customerID=c.customerID and cmp.companyID=c.companyID  AND cmp.LicenseID=li.LicenseID AND i.statusid=4 ORDER BY i.incidentid DESC ;";
        if ($stmt_select = mysqli_prepare($connect, $sql_select)) {
            $execute = mysqli_stmt_execute($stmt_select);
            if ($execute == FALSE) {
                header('Location:client_ticket_view.php?error=Execute_Select');
                exit();
            }
            mysqli_stmt_bind_result($stmt_select, $incID, $incDescription, $incReportDate, $incTopic, $opeName, $CustName, $CompLicense, $TypeDescription, $Statusid, $opeID, $customer_username, $customerid);
            mysqli_stmt_store_result($stmt_select);
            if (mysqli_stmt_num_rows($stmt_select) == 0) {
                echo '<div id="none_submitted">
                            <h3>No tickets have been completed</h3>
                        </div>';
            }

            while (mysqli_stmt_fetch($stmt_select)) {
                echo ' <div class="ticket_box">
                    <div class="ticket_box_top">
                        <div class="ticket_box_id">
                            <p>#' . $incID . '</p>
                        </div>
                        <a href="ticket_maintanance.php?maintain=' . $incID . ':' . $customerid . '">
                        <div class="ticket_box_content">
                            <div class="ticket_box_content_title">
                                <h3>' . $incTopic . '</h3>
                            </div>
                            <div class="ticket_box_content_body">
                                <p>' . $incDescription . '</p>
                            </div>
                            </a>
                        </div>
                    </div>
              
                    <div class="ticket_box_bottom">';
                if ($opeID === 3) {
                    echo '
                        <div class="ticket_box_assign">
                          <a href="operator_self_assign.php?update=' . $incID . ':' . $_SESSION['operatorId'] . '"><img class="ticket_box_assign_pic" src="https://i.ibb.co/881QtG6/open-a-ticket.png" alt="Assign a Ticket"/>
                        </a></div>';
                }
                echo '
                        <div class="ticket_box_assign">
                          <a href="#"><img id="ticket_box_assign_pic" src="https://i.ibb.co/881QtG6/open-a-ticket.png" alt="Assign a Ticket"/>
                        </a></div>';
                // In database we created row with operatorid=3. We did that because that row contains username="No operator assigned".
                // Therefore if we choose operatorid=3 it will display on ticket information that no operator has been assigned
                if ($opeID === 3) {
                    echo '<div class="ticket_box_bottom_assignedTo">
                                <p>Assigned to:<br><a href="team_leader_assign_ticket.php?TicketID=' . $incID . '" class="button">Assign</a></p>
                            </div>';
                }
                // If Team leader just assigned operator to ticket update incidents that he sees
                elseif (isset($_GET['assign'])) {
                    $imp = explode(':', $_GET['assign']);

                    $sql_assign = "UPDATE incident SET operatorid=? WHERE incidentid=?;";
                    if ($update = mysqli_prepare($connect, $sql_assign)) {

                        mysqli_stmt_bind_param($update, 'ii', $imp[0], $imp[1]);
                        $execute_update = mysqli_stmt_execute($update);
                        if ($execute_update == FALSE) {
                            echo mysqli_error($connect);
                        }
                        echo '<div class="ticket_box_bottom_assignedTo">
                            <p>Assigned to:<br><br>' . $opeName . '</p>
                         </div>';
                    }
                }
                // If operator is assigned already to ticket display the username of operator
                else {
                    echo '<div class="ticket_box_bottom_assignedTo">
                            <p>Assigned to:<br><br>' . $opeName . '</p>
                         </div>';
                }
                echo '
                        <div class="ticket_box_bottom_raisedBy">
                           <p>Registered by:<br><br>' . $CustName . '</p>
                        </div>
                        <div class="ticket_box_bottom_priority">
                           <p>Priority:<br><br>' . $CompLicense . '</p>
                        </div>
                        <div class="ticket_box_bottom_category">
                          <p>Category:<br><br>' . $TypeDescription . '</p>
                        </div>
                        <div class="ticket_box_bottom_category">
                  <p>Category:<br><br>' . $customer_username . '</p>
                </div>
                        <div class="ticket_box_bottom_duedate">
                        <p>Due Date:<br><br>' . $incReportDate . '</p>
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
        }
        // elseif (isset($_GET['assign'])) {
        //     // echo $_GET['assign'];
        //     $imp = explode(':', $_GET['assign']);
        //     // echo $_GET['assign'];
        //     echo $imp[0];
        //     echo $imp[1];

        //     $sql_assign = "UPDATE incident SET operatorid='" . $imp[0] . "' WHERE incidentid='" . $imp[1] . "';";
        // }
        ?>


    </div>

    <?php
    require("../html/footer.html");
    ?>