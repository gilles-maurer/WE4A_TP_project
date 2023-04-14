<?php

    require('connexionbdd.php');
    $connexion = connect_db();

    $id_post = $_POST['id_post'];
    $id_utilisateur = $_POST['id_utilisateur'];
    $datetime = date("Y-m-d H:i:s");
    $texte = $_POST['texte'];

    $texte = str_replace("'", "\'", $texte);

    $sql = "INSERT INTO 
                commentaire (id_post, id_utilisateur, date, texte) 
            VALUES 
                (".$id_post.", ".$id_utilisateur.", '".$datetime."', '".$texte."');";

    $connexion->query($sql);


    header('Location: '.$_POST['path']);

?>