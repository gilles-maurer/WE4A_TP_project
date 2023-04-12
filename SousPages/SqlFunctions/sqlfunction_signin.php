<?php

// crée un nouvel utilisateur dans la base de données

function sign_in($connexion) {

    $sql = "INSERT INTO utilisateur 
    (nom, prenom, email, mot_de_passe, date_naissance, date_inscription) 
    VALUES 
    ('".$_POST['nom']."', '".$_POST['prenom']."', 
    '".$_POST['email']."', '".md5($_POST['mot_de_passe'])."', 
    '".$_POST['date_naissance']."', NOW())";

    $result = $connexion->query($sql);

    return $result; 
}

?>