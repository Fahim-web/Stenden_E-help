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
  
    <header>
        <div class="container">
            <a href="index.html" ><img class="logo" src="img/logo.png"></a>
            <div class="menu-btn not-active"><span></span>
                </div>
            <ul class="menu"><li><a href="#">FAQ</a></li>
                <li><a href="#">View Registered Tickets</a></li>
                <li><a href="#">Log Out</a></li>
                <li><a href="#"></a></li>
            </ul>
        </div>
    </header>

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
        $sql = 'SELECT I.IncidentID,I.Topic,I.Description,I.RegisteredBy,I.resolution_date,O.Operator_name,T.Description FROM incident as I
    INNER JOIN operator as O ON I.OperatorID=O.OperatorID 
    INNER JOIN type as T ON I.typeID=T.typeID';
        //$sql .= 'SELECT  ';
        if ($stmt_select = mysqli_prepare($connect, $sql)) {
            $execute_select = mysqli_stmt_execute($stmt_select);
            if ($execute_select == FALSE) {
                echo mysqli_error($conenct);
            }
            mysqli_stmt_bind_result($stmt_select, $incidentID, $topic, $description, $registered_by, $resolution_date, $operatorName, $typeDesc);
            mysqli_stmt_store_result($stmt_select);
            
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
                   <p>'.$RegisteredBy.'<br><br></p>
                </div>
                <div class="ticket_box_bottom_priority">
                   <p>Priority:<br><br>GOLD</p>
                </div>
                <div class="ticket_box_bottom_category">
                  <p>Category:<br><br>'.$typeDesc.'</p>
                </div>
                <div class="ticket_box_bottom_duedate">
                <p>Due Date:<br><br>'.$resolution_date.'</p>
                </div>
                <div class="ticket_box_bottom_status">
                    <img id="statusLight" src="https://i.ibb.co/g7W2LcZ/red.png" alt="Status of the Ticket"/>
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