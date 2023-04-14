<?php


    require('connexionbdd.php');
    $connexion = connect_db();

    require('sqlfunctions.php');

    delete_post($connexion, $_POST["id_post"]);

    header("Location: ../blog.php?blog=".$_COOKIE["id_utilisateur"]);


?>

