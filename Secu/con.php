<?php
    
    function connect(){
        $host = 'localhost';
        $db   = 'secu';
        $user = 'debian-sys-maint';
        $pass = 'a>#cRm4nsH2}62L[)M4R';
        $charset = 'utf8mb4';
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=secu', $user, $pass);
            return $pdo;
        } catch (PDOException $e) {
            //On desactive si on deploi l application pour ne pas donner d info sur les erreurs
            //print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }


?>

