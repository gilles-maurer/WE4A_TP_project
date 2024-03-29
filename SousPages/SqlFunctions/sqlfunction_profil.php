<?php

// renvoie les informations d'un utilisateur en fonction de son id

function get_informations($connexion, $id) {

    $sql = "SELECT 
                utilisateur.id_utilisateur as id_utilisateur,
                utilisateur.nom as nom,
                utilisateur.prenom as prenom,
                utilisateur.avatar as avatar,
                utilisateur.email as email,
                utilisateur.date_naissance as date_naissance,
                utilisateur.date_inscription as date_inscription
            FROM 
                utilisateur 
            WHERE 
                id_utilisateur = '".$id."';";

    $result = $connexion->query($sql);

    return $result;
}

// renvoie les id des utilisateurs qui suivent l'utilisateur en fonction de son id

function get_abonne($connexion, $id) {

    $sql = "SELECT * FROM abonne WHERE id_suivie = '".$id."'";
    $result = $connexion->query($sql);

    return $result;
}

// renvoie les id des utilisateurs que l'utilisateur suit en fonction de son id

function get_abonnement($connexion, $id) {

    $sql = "SELECT * FROM abonne WHERE id_suiveur = '".$id."'";
    $result = $connexion->query($sql);

    return $result;
}


function delete_account($connexion, $id) {

    $sql = "DELETE FROM abonne WHERE id_suiveur = '".$id."' OR id_suivie = '".$id."';";
    $connexion->query($sql);

    $sql = "DELETE FROM post WHERE id_utilisateur = '".$id."';";
    $connexion->query($sql);

    $sql = "DELETE FROM commentaire WHERE id_utilisateur = '".$id."';";
    $connexion->query($sql);

    $sql = "DELETE FROM liker WHERE id_utilisateur = '".$id."';";
    $connexion->query($sql);

    $sql = "DELETE FROM utilisateur WHERE id_utilisateur = '".$id."';";
    $connexion->query($sql);
}


?>