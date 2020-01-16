<?php
include('../html/head.html');
include('connect.php');
include('session.php');

?>

<body>

    <header>
        <div class='container'>
            <a href='../php_process/index.php'><img class='logo' src='../img/logo.png'></a>
            <div class='menu-btn not-active'><span></span>
            </div>

            <ul class='menu'>
                <li><a href='Faq.php'>faq</a></li>

                <?php

                if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] === true) {

                    if (isset($_SESSION['operatorId'])) {
                        $sql = 'SELECT Clearance FROM operator WHERE operatorid = ' . $_SESSION['operatorId'] . ';';
                        if ($prep_sql = mysqli_prepare($con, $sql)) {
                            $exec_sql = mysqli_stmt_execute($prep_sql);
                            if ($exec_sql == FALSE) {
                                echo mysqli_error($exec_sql);
                            }
                            mysqli_stmt_bind_result($prep_sql, $clearance);
                            mysqli_stmt_store_result($prep_sql);
                            while (mysqli_stmt_fetch($prep_sql)) {
                                if ($clearance = 1) {
                                    echo "
                        <li><a href='#'>View Registered tickets</a></li>
                        <li><a href='#'>Add a Phone Ticket</a></li>
                        ";

                        require('header_log_button.php');
                        
                       echo"
                            </ul>
                            </div>
                        </header>";
                                } if ($clearance = 2){
                                    echo "
                                    <li><a href='security_view_operator.php'>GIVE PRIVELDGE</a></li>
                                    ";
                                    require('header_log_button.php');

                                }
                            }
                        }
                    } else {
                        echo "<li><a href='#'>View tickets</a></li>
                        <li><a href='#'>Submit a Ticket</a></li>";
                        require('header_log_button.php');
                    }
                } else {
                    require('header_log_button.php');
                }
                ?>

            </ul>
        </div>
    </header>