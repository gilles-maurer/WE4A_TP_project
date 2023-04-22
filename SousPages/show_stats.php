<?php

    //require("sqlfunctions.php");

    // On récupère les stats totales de la personne à qui appartient le blog
    $result = get_stats_blog($connexion, $id_stats); 

    $result = $result->fetch(); 

    $nombre_total_de_courses = $result["nb_courses"]; // utilisé pour afficher le bouton "Voir toutes les courses" sur blog

    $temps_heure = floor($result['temps']/3600);
    $temps_minute = floor(($result['temps'] - $temps_heure*3600)/60);
    $temps_seconde = $result['temps'] - $temps_heure*3600 - $temps_minute*60;

    echo "<br><p><label>Distance parcourue :</label> ".$result["distance"]." km</p><br>";

    if ($temps_heure == 0) {
        echo "<p><label>A couru pendant :</label> ".$temps_minute." min</p><br>";
    } else {
        echo "<p><label>A couru pendant :</label> ".$temps_heure." h et ".$temps_minute." min</p><br>";
    }

    echo "<p><label for='nombre'>Nombre de courses :</label> ".$result["nb_courses"]."</p><br>";


?>