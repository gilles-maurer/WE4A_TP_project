<?php

function check_login($connexion, $email) {

    $sql = "SELECT * FROM utilisateur WHERE email='$email'";
    $result = $connexion->query($sql);

    return $result; 

}

?>