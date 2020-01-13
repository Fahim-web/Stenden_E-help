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
            $sql = 'SELECT Clearance FROM operator WHERE OperatorID = ?;';
        }
        
        
        echo "
                <li><a href='#'>contact us</a></li>
                <li><a href='login'>login/register</a></li>
                <li><a href='#'></a></li>
        </ul>
        </div>
    </header>


";
}

?>
  
    