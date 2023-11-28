<?php 
    if(!isset($_SESSION['logged_in']))
    { 
        $_SESSION['message'] = "You are not logged in! Please login to continue.";
        header('Location: login.php');
        exit();
    }
?>