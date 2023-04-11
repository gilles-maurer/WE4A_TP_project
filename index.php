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
            echo "
            <div>

                <form action='blog.php'>
                    <input type='hidden' name='blog' value='".$row['id_utilisateur']."'>
                    <button type='submit'>".$row['nom']." ".$row['prenom']."</button>
                </form>

                <p>".$row['date']."</p>
                <p>".$row['lieu']."</p>";

                if(!($row['description']=="")){
                    echo "<p class='box'>".$row['description']."</p>";
                }

                echo "<div class='row'>

                    <div class='column-third-no-bg'>
                        <div class='box'>
                            <div class='boximage'>
                                <img src='./Icones/distance.png'>
                            </div>
                            <div class='boxtext'>
                                <p>".$row['distance']." km</p>
                            </div>
                        </div>
                    </div>

                    <div class='column-third-no-bg'>
                        <div class='box'>
                            <div class='boximage'>
                                <img src='./Icones/duree.png'>
                            </div>
                            <div class='boxtext'>"; 

                            if ($row['temps_heures'] == 0) {
                                echo "<p>".$row['temps_minutes']."min</p>";
                            } else {
                                echo "<p>".$row['temps_heures']."h".$row['temps_minutes']."min</p>";
                            }

                        echo "</div>
                        </div>
                    </div>

                    <div class='column-third-no-bg'>
                        <div class='box'>
                            <div class='boximage'>
                                <img src='./Icones/vitesse.png'>
                            </div>
                            <div class='boxtext'>
                                <p>".$row['vitesse']." km/h</p>
                            </div>
                        </div>
                    </div>

                </div>
            
        
            <div class='row'>
                <div class='column-third-no-bg'>
                    <div class='box-invisible'>
                        <div class='boxtext'>
                            <p>".$count_like['nb_like']." encouragements au compteur !</p>
                        </div>
                        <div class='boximage'>";

                            $path = "../index.php";

                            include("SousPages/like_comment.php");
                            //Les </div> nécessaires sont dans ce include

                echo "
            </div>
            <br> <hr>
            <br>";
        }

    ?>

</div>

</body>

</html> 