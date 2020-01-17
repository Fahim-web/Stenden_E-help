<?php
$mysqli = new mysqli("localhost", "root", "", "ssd");
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}


if (isset($_GET['maintain'])) {
    $exp = explode(":", $_GET['maintain']);
    $type = $exp[1];
$frequency =  $exp[0];
}
function getFreqID(){

    $mysqli = new mysqli("localhost", "root", "", "ssd");
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
    if ($stmt = $mysqli->prepare('SELECT FrequencyID FROM frequency WHERE description = ?')) {
        /* bind parameters for markers */
        $stmt->bind_param('s', $frequency);
        echo $frequency;
        echo "ASFASF";
        die();
        /* execute query */
        $stmt->execute();

        /* bind result variables */
        $stmt->bind_result($frequencyid);

        /* fetch value */
        $stmt->fetch();

        $stmt->close();
    }
}

function getTypeID(){

    $mysqli = new mysqli("localhost", "root", "", "ssd");
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
    if ($stmt = $mysqli->prepare('SELECT typeid FROM type WHERE description = ?')) {

        /* bind parameters for markers */
        $stmt->bind_param("s", $type);
    
        /* execute query */
        $stmt->execute();
    
        /* bind result variables */
        $stmt->bind_result($typeid);
    
        /* fetch value */
        $stmt->fetch();
    
        $stmt->close();
    }
}

?>