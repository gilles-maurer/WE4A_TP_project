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

        if (isset($_COOKIE["id_utilisateur"])) { // si l'utilisateur est connecté on renouvelle le cookie
            setcookie("id_utilisateur", $_COOKIE["id_utilisateur"], time() + 24*3600);
        }
        
        require('SousPages/connectionbdd.php'); 
        $connexion = connect_db();

        require('SousPages/sqlfunctions.php');

        if (isset($_COOKIE["id_utilisateur"])) {
            $result = select_accueil_login($connexion, $_COOKIE["id_utilisateur"]);
            // nom, prenom, date, distance, temps, vitesse, commentaire, lieu, description
            // n'affiche pas les posts de l'utilisateur
            // met en premier les posts des personnes qu'il suit


        } else {
            $result = select_accueil_logout($connexion);
            // nom, prenom, date, distance, temps, vitesse, commentaire, lieu, description
        }
        
        while ($row = $result->fetch()) {

            $count_like = count_like($connexion, $row['id_post']);
            $count_like = $count_like->fetch();


            // Affichage des posts 
            echo "
            <div>

                <form action='blog.php'>
                    <input type='hidden' name='blog' value='".$row['id_utilisateur']."'>
                    <button type='submit'>".$row['nom']." ".$row['prenom']."</button>
                </form>";

                
                include("SousPages/contenu_blog.php");
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