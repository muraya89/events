<?php 
session_start();
// for functions
require('../helpers/DbHelpers.php');
// check if the session exists
if (isset($_SESSION['id']) && isset($_SESSION['name'])) {
    session_destroy();
    unset($_SESSION['id']);
    unset($_SESSION['name']);
    // redirect here   
    header("Location: ../index.php");
}

?>