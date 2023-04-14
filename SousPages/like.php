<?php

    require('connexionbdd.php');
    $connexion = connect_db();

    $id_post = $_POST['id_post'];
    $id_utilisateur = $_POST['id_utilisateur'];
    
    // vérifier si l'utilisateur a déjà liké le post

    $sql = "SELECT * FROM liker WHERE id_post = ".$id_post." AND id_utilisateur = ".$id_utilisateur.";";
    $result = $connexion->query($sql);

    if ($result->rowCount() == 0) {

        // l'utilisateur n'a pas encore liké le post, on l'ajoute dans la table liker

        $sql = "INSERT INTO liker (id_post, id_utilisateur) VALUES (".$id_post.", ".$id_utilisateur.");";
        $connexion->query($sql);

    } else {

        // l'utilisateur a déjà liké le post, on le supprime de la table liker

        $sql = "DELETE FROM liker WHERE id_post = ".$id_post." AND id_utilisateur = ".$id_utilisateur.";";
        $connexion->query($sql);
    }

    header('Location: '.$_POST['path'])

?>