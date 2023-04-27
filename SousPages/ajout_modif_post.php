<?php 

    //Cette page permet d'enregistrer les données de post.php

    require('sqlfunctions.php');
    require('connexionbdd.php');
    $connexion = connect_db();

    $modif = $_POST["modif"];
    $id_post = $_POST["id_post"];
    $id_utilisateur = $_POST["id_utilisateur"];
    $date = $_POST["date"];
    $distance = $_POST["distance"] * 1000;
    $temps = $_POST["temps"];
    $lieu = $_POST["lieu"];
    $description = $_POST["description"];

    //On sécurise les apostrophes :
    $lieu = str_replace("'", "\'", $lieu);
    $description = str_replace("'", "\'", $description);

    //S'il s'agit d'une modification :
    if($modif) {

        update_post($connexion, $id_post, $id_utilisateur, $date, $distance, $temps, $lieu, $description); 

    //S'il s'agit d'une création :
    } else { 

        insert_post($connexion, $id_utilisateur, $date, $distance, $temps, $lieu, $description);

    }

    header("Location: ../blog.php?blog=".$id_utilisateur);



?> 