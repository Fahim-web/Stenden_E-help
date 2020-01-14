<?php
// Initialize the session
session_start();
 
// Unset all of the session variables
$_SESSION = array();
unset($_SESSION['loggedIn']);
unset($_SESSION['username']);
 
// Destroy the session.
session_destroy();
 
// Redirect to login page
header("location: ../index.html");
exit;
?>