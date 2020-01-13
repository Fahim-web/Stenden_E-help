
<?php

if ((($_FILES['picture_input']['type'] == "image/gif" ) 
|| ($_FILES['picture_input']['type'] == "image/jpeg")
|| ($_FILES['picture_input']['type'] == "image/png"))
&& ($_FILES['picture_input']['size'] < 600000))
{
    //check for errors
    if ($_FILES['file_input']['error']>0){
        echo $_FILES['file_input']['error'];
    }else{
        move_uploaded_file($_FILES['picture_input']['tmp_name'], "userImg/" . $_FILES['picture_input']['name']);

        echo "Name: " . $_FILES['picture_input']['name'] . "<br>";
        echo "Type: " . $_FILES['picture_input']['type'] . "<br>";
        echo "Size: " . $_FILES['picture_input']['size'] . "<br>";
        // echo "Temporary File Dirrectory : " . $_FILES['file_input']['tmp_name'] . "<br>";
        //echo "Stored in: " . "userImg/" . $_FILES['file_input']['name'] . "<br>";
    }   
}else{
    echo "Invalid File<br>Couldn't Create your account";
    die();
}
?>