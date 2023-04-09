<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">
<title>Classement</title>
<link rel="stylesheet" href="./Styles/style.css"> 
</head>

<body>

<?php include("SousPages/navbar.php");?>

<div class="row">
<?php

    require('SousPages/connectionbdd.php');
    $connexion = connect_db();

    require('SousPages/sqlfunctions.php');

    echo "<div class='column-third'>";
    echo "<h2>Classement par nombre de courses</h2>";

    $result = classement_nb_courses($connexion);

    $i = 0; 

    while($row = $result->fetch()) {

        $i = $i + 1;

        if($i==1){
            echo "<p class='firstplace'>".$i."</p>";
        } elseif ($i==2) {
            echo "<p class='secondplace'>".$i."</p>";
        } elseif ($i==3) {
            echo "<p class='thirdplace'>".$i."</p>";
        } else {
            echo "<p class='otherplaces'>".$i."</p>";
        }
        echo "<p>".$row['nom']." ".$row['prenom']."</p>";
        echo "<p>A couru ".$row['nb_courses']." fois !</p>";
        echo "<br><br>";
    }

    echo "</div><div class='column-third'>";
    echo "<h2>Classement par distance parcourue</h2>";

    $result = classement_distance($connexion);

    $i = 0;

    while($row = $result->fetch()) {

        $i = $i + 1;

        if($i==1){
            echo "<p class='firstplace'>".$i."</p>";
        } elseif ($i==2) {
            echo "<p class='secondplace'>".$i."</p>";
        } elseif ($i==3) {
            echo "<p class='thirdplace'>".$i."</p>";
        } else {
            echo "<p class='otherplaces'>".$i."</p>";
        }
        echo "<p>".$row['nom']." ".$row['prenom']."</p>";
        echo "<p>A parcouru ".$row['distance']."km !</p>";
        echo "<br><br>";
    }

    echo "</div><div class='column-third'>";
    echo "<h2>Classement par temps couru</h2>";

    $result = classement_temps($connexion);

    $i = 0;

    while($row = $result->fetch()) {

        $i = $i + 1;

        $temps_heure = floor($row['temps']/3600);
        $temps_minute = floor(($row['temps'] - $temps_heure*3600)/60);
        $temps_seconde = $row['temps'] - $temps_heure*3600 - $temps_minute*60;

        if($i==1){
            echo "<p class='firstplace'>".$i."</p>";
        } elseif ($i==2) {
            echo "<p class='secondplace'>".$i."</p>";
        } elseif ($i==3) {
            echo "<p class='thirdplace'>".$i."</p>";
        } else {
            echo "<p class='otherplaces'>".$i."</p>";
        }
        echo "<p>".$row['nom']." ".$row['prenom']."</p>";
        echo "<p>A couru pendant ".$temps_heure."h".$temps_minute."min".$temps_seconde."s !</p>";
        echo "<br>";
        echo "<br>";
    }
    

?>

</div></div>

</body>

</html> 