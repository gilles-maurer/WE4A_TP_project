<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">
<title>Accueil</title>
<link rel="stylesheet" href="./Styles/style.css"> 
</head>

<body>

<?php include("SousPages/navbar.php");?>

<div id="MainContainer">

    <h1>RunShare</h1>


    <?php 
        require('SousPages/connectionbdd.php'); 
        $connexion = connect_db();

        require('SousPages/sqlfunctions.php');

        $result = select_accueil_logout($connexion);
        // nom, prenom, date, distance, temps, vitesse, commentaire, lieu

        while ($row = $result->fetch()) {

            $count_like = count_like($connexion, $row['id_post']);
            $count_like = $count_like->fetch();


            // Affichage des posts 
            // A FAIRE : enlever id_post
            echo "
            <div>
                <p>".$row['id_post']."</p> 

                <form action='blog.php'>
                    <input type='hidden' name='blog' value='".$row['id_utilisateur']."'>
                    <button type='submit'>".$row['nom']." ".$row['prenom']."</button>
                </form>

                <p>".$row['date']."</p>
                <p>".$row['lieu']."</p>
                
                <p>".$row['description']."</p>

                <div class='box'>
                    <div class='boximage'>
                        <img src='./Icones/distance.png'>
                    </div>
                    <div class='boxtext'>
                        <p>".$row['distance']." km</p>
                    </div>
                </div>

                <div class='box'>
                    <div class='boximage'>
                        <img src='./Icones/duree.png'>
                    </div>
                    <div class='boxtext'>
                    <p>".$row['temps_heures']."h".$row['temps_minutes']."min".$row['temps_secondes']."s</p>
                    </div>
                </div>

                <div class='box'>
                    <div class='boximage'>
                        <img src='./Icones/vitesse.png'>
                    </div>
                    <div class='boxtext'>
                        <p>".$row['vitesse']." km/h</p>
                    </div>
                </div>
            
            </div>
            
            <p>".$count_like['nb_like']."</p>";

            //Nom, date, lieu
            //Description
            //Distance, temps, vitesse
            //Likes, commentaires

            $path = "../index.php";

            include("SousPages/like_comment.php");

            echo "
            </div>
            <br> <hr>
            <br>";
        }

    ?>

</div>

</body>

</html> 