<?php

function get_informations($connexion, $id) {

    $sql = "SELECT * FROM utilisateur WHERE id_utilisateur = '".$id."'";
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