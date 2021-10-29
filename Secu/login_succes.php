<?php
    session_start();
    //Check if the user is loged
    if(!isset($_SESSION["user_name"]) || !isset($_SESSION["user_password"])){
        header("location: index.php");
        exit;
    }
    echo '<h3>Login Success, Welcome - '.$_SESSION["user_name"].'</h3>';  
    echo '<br /><br /><a href="logout.php">Logout</a>';  
?>
