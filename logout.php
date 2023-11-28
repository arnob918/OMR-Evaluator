<?php
    session_start();

    if(isset($_SESSION['logged_in']))
    {
        unset($_SESSION['user_info']);
        unset($_SESSION['logged_in']);
        $_SESSION['message'] = "Logout Successfull";
    }

    header('Location: index.php');
    exit();
?>