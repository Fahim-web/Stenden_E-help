<?php
    $con = mysqli_connect("localhost","root","");
    if (!$con){
        echo "error";
    }else{
        $dbName = "ssd";
        mysqli_select_db($con, $dbName);
        global $con;
    }
?>