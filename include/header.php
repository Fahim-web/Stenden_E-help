<?php
    include ('./html/head.html');
    include ('connect.php');
    include ('session.php');
?>

<body>

<?php

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){

    echo $_SESSION['operatorID'];
    echo $_SESSION['customerID'];


echo "

<header>
        <div class='container'> 
        <a href='index.html' ><img class='logo' src='.../img/logo.png'></a>
        <div class='menu-btn not-active'><span></span>
            </div>

        <ul class='menu'><li><a href='#'>faq</a></li>
        ";
        if (isset($_SESSION['operatorID'])){
            $sql = 'SELECT Clearance FROM operator WHERE OperatorID = '$id';';
            if ($prep_sql = mysqli_prepare($con, $sql)){
                $exec_sql = mysqli_stmt_execute($prep_sql);
                if ($exec_sql == FALSE){
                    echo mysqli_error($exec_sql);
                }
                mysqli_stmt_bind_result($prep_sql, $clearance);
                mysqli_stmt_store_result($prep_sql);
                while (mysqli_stmt_fetch($prep_sql)){
                    echo $clearance;
                    if ($clearance == 1){
                        echo "
                        <li><a href='#'>View Registered tickets</a></li>
                        <li><a href='#'>Add a Phone Ticket</a></li>
                        " 
                        
                        include ('header_log_button.php');
                        "
                       
                            </ul>
                            </div>
                        </header>";


                    }elseif ($clearance == 2){
                        echo 
                        
                        include ('header_log_button.php');
                        "
                            </ul>
                            </div>
                        </header>";
                    }elseif ($clearance == 3){
                        echo "
                        <li><a href='#'>View Registered tickets</a></li>
                        <li><a href='#'>Add a Phone Ticket</a></li>
                        " 
                        
                        include ('header_log_button.php');
                        "
                       
                            </ul>
                            </div>
                        </header>";
                    }
                }

            }

        }else{
            $sql = 'SELECT Clearance FROM customer WHERE CustomerID = '$id';';
        }
        
        
        


";
}

?>
  
    