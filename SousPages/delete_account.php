<?php


    require('connexionbdd.php');
    $connexion = connect_db();

    require('sqlfunctions.php');

    delete_account($connexion, $_POST["id_utilisateur"]);

    setcookie('id_utilisateur'); // delete cookie
    setcookie("suppresion_compte", "true", time() + 24*3600); // on crée un cookie pour afficher une notification

    header("Location: ../index.php");


?>

