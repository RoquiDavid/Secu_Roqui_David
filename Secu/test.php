<?php
    include 'fonctions.php';
    generate_token();
    echo($_SESSION["csrf_token"]);
?>