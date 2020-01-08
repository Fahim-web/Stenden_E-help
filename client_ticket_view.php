<!DOCTYPE html>
<?php
    require('php_process/connect.php');
?>
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
                <h3>Welcome back *INSERT NAME*! Ready to work?</h3>
            </div>
        </div>
    </div>
    <div class="content_wrapper">
        <!---BOX WID TIKET IN IT-->
        <?php
        $customerid=2;
        // incidentid, incident description, operator_name, customer_name, LicenseID, type description, report_date,status description;
            $sql_select="SELECT i.incidentid,i.description,i.report_date,i.topic,o.operator_name,c.customer_name,li.description,t.description,s.description
            FROM incident as i, operator as o, customer as c, type as t, status as s,company as cmp, license as li WHERE i.operatorid=o.operatorid AND i.typeID=t.typeID and i.StatusID=s.StatusID and 
            i.customerID=c.customerID and cmp.companyID=c.companyID AND cmp.LicenseID=li.LicenseID AND c.customerid=? ;";
            if($stmt_select=mysqli_prepare($connect,$sql_select)){
                mysqli_stmt_bind_param($stmt_select,'s',$customerid);
                $execute=mysqli_stmt_execute($stmt_select);
                if($execute==FALSE){
                    header('Location:client_ticket_view.php?error=Execute_Select');
                    exit();
                }
                mysqli_stmt_bind_result($stmt_select,$incID,$incDescription,$incReportDate,$incTopic,$opeName,$CustName,$CompLicense,$TypeDescription,$StatusDescription);
                mysqli_stmt_store_result($stmt_select);
                if(mysqli_stmt_num_rows($stmt_select)==0){
                    echo"No tickets submited";
                    // header('Location:client_ticket_view.php?error=No_Tickets_Submited');
                    // exit();
                }
                while(mysqli_stmt_fetch($stmt_select)){
                    echo' <div class="ticket_box">
                    <div class="ticket_box_top">
                        <div class="ticket_box_id">
                            <p>ID# 002</p>
                        </div>
                        <div class="ticket_box_content">
                            <div class="ticket_box_content_title">
                                <h3>'.$incTopic.'</h3>
                            </div>
                            <div class="ticket_box_content_body">
                                <p>'.$incDescription.'</p>
                            </div>
                        </div>
                    </div>
              
                    <div class="ticket_box_bottom">
                        <div class="ticket_box_assign">
                          <a href="#"><img id="ticket_box_assign_pic" src="https://i.ibb.co/881QtG6/open-a-ticket.png" alt="Assign a Ticket"/>
                        </a></div>
                        <div class="ticket_box_bottom_assignedTo">
                           <p>Assigned to:<br><br>'.$opeName.'</p>
                        </div>
                        <div class="ticket_box_bottom_raisedBy">
                           <p>Registered by:<br><br>'.$CustName.'</p>
                        </div>
                        <div class="ticket_box_bottom_priority">
                           <p>Priority:<br><br>'.$CompLicense.'</p>
                        </div>
                        <div class="ticket_box_bottom_category">
                          <p>Category:<br><br>'.$TypeDescription.'</p>
                        </div>
                        <div class="ticket_box_bottom_duedate">
                        <p>Due Date:<br><br>'.$incReportDate.'</p>
                        </div>
                        <div class="ticket_box_bottom_status">';
                            if($StatusDescription=='opened'){
                                echo '<img class="statusLight" src="https://i.ibb.co/g7W2LcZ/red.png" alt="Status of the Ticket"/>';         
                            }elseif($StatusDescription=='closed'){
                                echo  '<img class="greenlight" src="img/green_dot.jpg" alt="Status of the Ticket"/>';     
                            }echo '                                                                
                        </div>
                    </div>
                </div>';
                }
            }
        ?>
       
        
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