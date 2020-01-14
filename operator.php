<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operator Page</title>
    <link rel="stylesheet" href="vendor/Slick/slick.css">
    <link rel="stylesheet" href="fonts/fonts.css">
    <link rel="stylesheet" href="css/style.css">
    
</head>

<body>
  
<?php
    include ('php_process/header.php');
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
        
        <?php
        
        require('php_process/connect.php');
        $sql = 'SELECT i.incidentid,i.RegisteredBy,i.description,i.report_date,i.topic,o.operator_name,li.description,t.description,s.StatusID
            FROM incident as i, operator as o, customer as c, type as t, status as s,company as cmp, license as li WHERE i.operatorid=o.operatorid AND i.typeID=t.typeID and i.StatusID=s.StatusID and 
            i.customerID=c.customerID and cmp.companyID=c.companyID AND cmp.LicenseID=li.LicenseID';
        if ($stmt_select = mysqli_prepare($connect, $sql)) {
            $execute_select = mysqli_stmt_execute($stmt_select);
            if ($execute_select == FALSE) {
                echo mysqli_error($connect);
            }
            mysqli_stmt_bind_result($stmt_select, $incidentID,$registered_by, $description, $rep_date, $topic, $operatorName,$license, $typeDesc, $status);
            mysqli_stmt_store_result($stmt_select);
            
            
            if($status == 1){
                $srcpic='https://i.ibb.co/g7W2LcZ/red.png';
            }else{
                $srcpic='https://i.ibb.co/3y0gwdH/green.png';
            }
            if (mysqli_stmt_num_rows($stmt_select) == 0) {
                echo 'There is no open incidents';
            } else {
                
                while (mysqli_stmt_fetch($stmt_select)) {
                    echo '<div class="ticket_box">
            <div class="ticket_box_top">
                <div class="ticket_box_id">
                    <p>ID#'.$incidentID.'</p>
                </div>
                <div class="ticket_box_content">
                    <div class="ticket_box_content_title">
                        <h3>'.$topic.'</h3>
                    </div>
                    <div class="ticket_box_content_body">
                        <p>'.$description.'</p>
                    </div>
                </div>
            </div>
      
            <div class="ticket_box_bottom">
                <div class="ticket_box_assign">
                  <a href="#"><img id="ticket_box_assign_pic" src="https://i.ibb.co/881QtG6/open-a-ticket.png" alt="Assign a Ticket"/>
                </a></div>
                <div class="ticket_box_bottom_assignedTo">
                   <p>Assigned to:<br><br>'.$operatorName.'</p>
                </div>
                <div class="ticket_box_bottom_raisedBy">
                   <p>Registered by:<br><br>'.$registered_by.'</p>
                </div>
                <div class="ticket_box_bottom_priority">
                   <p>Priority:<br><br>'.$license.'</p>
                </div>
                <div class="ticket_box_bottom_category">
                  <p>Category:<br><br>'.$typeDesc.'</p>
                </div>
                <div class="ticket_box_bottom_duedate">
                <p>Due Date:<br><br>'.$rep_date.'</p>
                </div>
                <div class="ticket_box_bottom_status">
                    <img id="statusLight" src="'.$srcpic.'" alt="Status of the Ticket"/>
                </div>
            </div>
        </div>';
                }
            }
            
        }
       
        ?>
        <!--Additional "fake" boxes-->

    </div>
    <footer>
        <div class="container clearfix">
            <div class="footer_logo"><img src="img/logo.png" alt="">
            </div>
            <div class="footer_contacts clearfix">
                <h3>Contacts</h3>
                <p>supportdesk@info.com</p>
                <p>+1234567890</p>
            </div>
        </div>
    </footer>
    <script src="vendor/jquery/jquery-3.2.0.min.js"></script>
    <script src="js/core.js"></script>
</body>

</html>