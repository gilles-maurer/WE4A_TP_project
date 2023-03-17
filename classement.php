<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">
<title>Classement</title>
<link rel="stylesheet" href="./Styles/style.css"> 
</head>

<body>

<?php include("SousPages/navbar.php");?>


<?php

    require('SousPages/connectionbdd.php');
    $connexion = connect_db();

    require('SousPages/sqlfunctions.php');

    echo "<div>";
    echo "<p>Classement nombre de courses</p>";
    echo "</div>";

    $result = classement_nb_courses($connexion);

    $i = 0; 

    while($row = $result->fetch()) {

        $i = $i + 1;

        echo "<div>";
        echo "<p>".$i."</p>";
        echo "<p>".$row['nom']."</p>";
        echo "<p>".$row['prenom']."</p>";
        echo "<p>".$row['nb_courses']."</p>";
        echo "</div>";
        echo "<br>";
        echo "<br>";
    }

    echo "<div>";
    echo "<p>Classement distance parcourue</p>";
    echo "</div>";

    $result = classement_distance($connexion);

    $i = 0;

    while($row = $result->fetch()) {

        $i = $i + 1;

        echo "<div>";
        echo "<p>".$i."</p>";
        echo "<p>".$row['nom']."</p>";
        echo "<p>".$row['prenom']."</p>";
        echo "<p>".$row['distance']." km</p>";
        echo "</div>";
        echo "<br>";
        echo "<br>";
    }

    echo "<div>";
    echo "<p>Classement temps couru</p>";
    echo "</div>";

    $result = classement_temps($connexion);

    $i = 0;

    while($row = $result->fetch()) {

        $i = $i + 1;

        $temps_heure = floor($row['temps']/3600);
        $temps_minute = floor(($row['temps'] - $temps_heure*3600)/60);
        $temps_seconde = $row['temps'] - $temps_heure*3600 - $temps_minute*60;
        
        echo "<div>";
        echo "<p>".$i."</p>";
        echo "<p>".$row['nom']."</p>";
        echo "<p>".$row['prenom']."</p>";
        echo "<p>".$temps_heure."h".$temps_minute."min".$temps_seconde."s</p>";
        echo "</div>";
        echo "<br>";
        echo "<br>";
    }
    

?>


</body>

</html> 