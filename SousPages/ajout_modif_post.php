<?php 


    require('sqlfunctions.php');
    require('connectionbdd.php');
    $connexion = connect_db();

    $modif = $_POST["modif"];
    $id_post = $_POST["id_post"];
    $id_utilisateur = $_POST["id_utilisateur"];
    $date = $_POST["date"];
    $distance = $_POST["distance"] * 1000;
    $temps = $_POST["temps"];
    $lieu = $_POST["lieu"];
    $description = $_POST["description"];
    
    echo $modif."<br>";
    echo $id_post."<br>";
    echo $id_utilisateur."<br>";
    echo $date."<br>";
    echo $distance."<br>";
    echo $temps."<br>";
    echo $lieu."<br>";
    echo $description."<br>";



   if($modif) {

        update_post($connexion, $id_post, $id_utilisateur, $date, $distance, $temps, $lieu, $description); 

   } else { 

        insert_post($connexion, $id_utilisateur, $date, $distance, $temps, $lieu, $description);

   }

    header("Location: ../blog.php?blog=".$id_utilisateur);



?> 