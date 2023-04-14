<?php

    require('connexionbdd.php');
    $connexion = connect_db();

    $id_post = $_POST['id_post'];
    $id_utilisateur = $_POST['id_utilisateur'];
    $datetime = $_POST['date'];
    
    $sql = "DELETE FROM 
                commentaire 
            WHERE 
                id_post = ".$id_post." AND id_utilisateur = ".$id_utilisateur." AND date = '".$datetime."';";
                
    $connexion->query($sql);


    header('Location: '.$_POST['path']);

?>