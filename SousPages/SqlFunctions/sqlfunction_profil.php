<?php

function get_informations($connexion, $id) {

    $sql = "SELECT * FROM utilisateur WHERE id_utilisateur = '".$id."'";
    $result = $connexion->query($sql);

    return $result;
}


?>