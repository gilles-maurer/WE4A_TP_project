<?php

    require('SousPages/connexionbdd.php');
    $connexion = connect_db();

    require('SousPages/sqlfunctions.php');

    delete_account($connexion, $_POST["id_utilisateur"]);

    setcookie('id_utilisateur'); // delete cookie
    setcookie('suppression_compte', "true", time() + 24*3600); // on crée un cookie pour afficher une notification


    header("Location: ./index.php");


?>

