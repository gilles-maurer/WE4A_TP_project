<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">
<title>Accueil</title>
<link rel="stylesheet" href="./Styles/style.css"> 
</head>

<body>

<?php 
    require('connectionbdd.php'); 
    $connexion = connect_db();

    require('sqlfunctions.php');

    $result = select_accueil_logout($connexion);
    // nom, prenom, date, distance, temps, vitesse, commentaire, lieu, nb like


    while ($row = $result->fetch()) {
        echo "<div>";
        echo "<p>".$row['nom']."</p>";
        echo "<p>".$row['prenom']."</p>";
        echo "<p>".$row['date']."</p>";
        echo "<p>".$row['distance']." km</p>";
        echo "<p>".$row['temps']." min</p>";
        echo "<p>".$row['vitesse']." km/h</p>";
        echo "<p>".$row['commentaire']."</p>";
        echo "<p>".$row['lieu']."</p>";
        echo "<p>".$row['nb_like']."</p>";
        echo "</div>";
        echo "<br>";
        echo "<br>";
    }

?>


</body>

</html> 