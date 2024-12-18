<?php
    session_start();
    if(!isset($_SESSION['user_level']) or ($_SESSION['user_level'] !=1)){
        header("Location: login-page.php");
        exit();
    }
?>