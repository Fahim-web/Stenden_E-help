<?php
    $connect=mysqli_connect('localhost', 'root','','ssd');
    if($connect==FALSE){
        echo mysqli_connect_error();
    }
?>
