<?php

// permet de vérifier si l'email de l'utilisateur existe déjà dans la base de données

function check_login($connexion, $email) {

    $sql = "SELECT * FROM utilisateur WHERE email='$email'";
    $result = $connexion->query($sql);

    return $result; 

}

?>