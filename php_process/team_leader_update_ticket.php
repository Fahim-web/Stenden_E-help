<?php
require('connect_mar.php');

if (isset($_GET['assign'])) {
    $imp = explode(':', $_GET['assign']);

    $sql_assign = "UPDATE incident SET operatorid=? WHERE incidentid=?;";
    if ($update = mysqli_prepare($connect, $sql_assign)) {

        mysqli_stmt_bind_param($update, 'ii', $imp[0], $imp[1]);
        $execute_update = mysqli_stmt_execute($update);
        if ($execute_update == FALSE) {
            echo mysqli_error($connect);
        }
        header('Location:team_leader_view_ticket.php?works=Operator_assigned');
        exit();
        mysqli_stmt_close($update);
    }
} else {
    header('Location:team_leader_view_ticket.php?error=Illegal_Entrance');
    exit();
}
mysqli_close($connect);
