<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">
<title>Accueil</title>
<link rel="stylesheet" href="./Styles/style.css"> 
</head>

<body>

<?php include("SousPages/navbar.php");?>


<?php 
    require('SousPages/connectionbdd.php'); 
    $connexion = connect_db();

    require('SousPages/sqlfunctions.php');

    $result = select_accueil_logout($connexion);
    // nom, prenom, date, distance, temps, vitesse, commentaire, lieu, nb like


    while ($row = $result->fetch()) {
        echo "<div>
        <p>".$row['nom']."</p>
        <p>".$row['prenom']."</p>
        <p>".$row['date']."</p>
        <p>".$row['distance']." km</p>
        <p>".$row['temps_heures']."h".$row['temps_minutes']."min".$row['temps_secondes']."s</p>
        <p>".$row['vitesse']." km/h</p>
        <p>".$row['commentaire']."</p>
        <p>".$row['lieu']."</p>
        <p>".$row['nb_like']."</p>
        </div>
        <br>
        <br>";
    }

?>


</body>

</html> 