<?php

    require('connectionbdd.php');
    $connexion = connect_db();

    $id_post = $_POST['id_post'];
    $id_utilisateur = $_POST['id_utilisateur'];
    $date = date("Y-m-d");
    $texte = $_POST['texte'];

    $sql = "INSERT INTO 
                commentaire (id_post, id_utilisateur, date, texte) 
            VALUES 
                (".$id_post.", ".$id_utilisateur.", ".$date.", '".$texte."');";
    $connexion->query($sql);


    header('Location: ../index.php')

?>