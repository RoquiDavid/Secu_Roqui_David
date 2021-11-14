<!DOCTYPE html>

<link rel="stylesheet" href="<?php echo dirname($_SERVER['PHP_SELF']).'Css/style.css' ?>">
<script type="text/javascript" src="script.js"></script>

<html>
    <head>
        <meta charset="utf-8" />
        <meta content="text/html; charset=UTF-8; X-Content-Type-Options=nosniff" http-equiv="Content-Type" />
        <title>Inscription</title>
    </head>

    <body>
    <header>
        <?php
            include 'fonctions.php';
            session_start();
            //Check if the user is loged
            if(!isset($_SESSION["user_name"]) || !isset($_SESSION["user_password"])){
                header("location: index.php");
                exit;
            }
            //On decripte les valeurs de la session
            echo '<h3>Login Success, Welcome - '.encrypt_decrypt($_SESSION['user_name'], 'decrypt').'</h3>';  
            echo '<br /><br /><a href="logout.php">Logout</a>';  
        ?>

    </header>
        
    </body>
</html>
