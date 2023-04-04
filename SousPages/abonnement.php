<?php

    require('connectionbdd.php');
    $connexion = connect_db();

    $id_suivie = $_POST['id_suivie'];
    $id_suiveur = $_POST['id_suiveur'];
    
    // vérifier si l'utilisateur suit déjà la personne

    $sql = "SELECT * FROM abonne WHERE id_suivie = ".$id_suivie." AND id_suiveur = ".$id_suiveur.";";
    $result = $connexion->query($sql);

    if ($result->rowCount() == 0) {

        // l'utilisateur ne suit pas la personne, on l'ajoute à la table abonne

        $sql = "INSERT INTO abonne (id_suivie, id_suiveur) VALUES (".$id_suivie.", ".$id_suiveur.");";
        $connexion->query($sql);

    } else {

        // l'utilisateur suit déjà la personne, on la supprime de la table abonne

        $sql = "DELETE FROM abonne WHERE id_suivie = ".$id_suivie." AND id_suiveur = ".$id_suiveur.";";
        $connexion->query($sql);
    }

    header('Location: ../blog.php?blog='.$id_suivie);

?>