<?php

function get_informations($connexion, $id) {

    $sql = "SELECT 
                utilisateur.id_utilisateur as id,
                utilisateur.nom as nom,
                utilisateur.prenom as prenom,
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


function get_abonne($connexion, $id) {

    $sql = "SELECT * FROM abonne WHERE id_suivie = '".$id."'";
    $result = $connexion->query($sql);

    return $result;
}


function get_abonnement($connexion, $id) {

    $sql = "SELECT * FROM abonne WHERE id_suiveur = '".$id."'";
    $result = $connexion->query($sql);

    return $result;
}


?>