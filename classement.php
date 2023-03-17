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

        echo "<div>";
        echo "<p>".$i."</p>";
        echo "<p>".$row['nom']."</p>";
        echo "<p>".$row['prenom']."</p>";
        echo "<p>".$row['temps_heures']."h".$row['temps_minutes']."min".$row['temps_secondes']."s</p>";
        // echo "<p>".$row['temps_heures']."h</p>";
        // echo "<p>".$row['temps']."s</p>";
        echo "</div>";
        echo "<br>";
        echo "<br>";
    }
    

?>


</body>

</html> 