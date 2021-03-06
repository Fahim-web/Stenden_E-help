<?php
include('header.php');
require('connect_mar.php');
if (isset($_GET['TicketID'])) {
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
            <img id="profilePic" src="'.$filepath.'" alt="Profile picture">
        </div>
        <div class="user_banner_wrapper_msg">
            <h3>Welcome back <b>'.$customer. '</b></h3>
        </div>
        ';
        ?>
    </div>
    <div class="content_wrapper">
        <div class="responsive_assign">
            <?php

            $sql_select = "SELECT o.operatorID,o.username,o.filepath FROM operator as o where o.operatorid!=3;";
            if ($stmt = mysqli_prepare($connect, $sql_select)) {
                $execute = mysqli_stmt_execute($stmt);
                if ($execute == FALSE) {
                    echo mysqli_error($execute);
                }
                mysqli_stmt_bind_result($stmt, $opeID, $username, $filepath);
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 0) {
                    echo "No operators in system";
                }
                while (mysqli_stmt_fetch($stmt)) {
                    echo ' <div class="operator_assign">
                    <div class="operator_assign_top">
                        <div class="operator_assign_id">
                            <img class="operator_profile_img" src="' . $filepath . '" alt="operator">
                        </div>
                        <div class="operator_assign_content">
                            <div class="ticket_box_content_title">
                                <h3>Operator</h3>
                            </div>
                            <div class="ticket_box_content_body">
                                <p>' . $username . '</p>
                            </div>
                        </div>
                    </div>
                    <div class="ticket_box_bottom">
                        <div class="operator_box_assign">
                            <a href="team_leader_update_ticket.php?assign=' . $opeID . ':' . $_GET['TicketID'] . '"><img src="../img/greentick.png" class="assign"  ></img></a>
                        </div>
                    </div>
                </div>';
                }
            }


            ?>
        </div>
    </div>
<?php
} else {
    header('Location:team_leader_view_ticket.php?error=IllegalEntrance');
    exit();
}
require("../html/footer.html");
?>