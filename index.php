<!DOCTYPE html>
<html lang="fr">

<head>

<?php include("SousPages/header.php");?>

<title>RunShare</title>
</head>

<script>

    function notification_creation_compte() {
        alert("Votre compte a bien été créé !"); // affiche une notification pour dire que le compte a bien été créé
    }

    function notification_suppresion_compte() {
        alert("Votre compte a bien été supprimé..."); // affiche une notification pour dire que le compte a bien été supprimé
    }

</script>

<body>

<?php include("SousPages/navbar.php");?>

<div id="MainContainer">

    <h1>RunShare</h1>

    <script>

        <?php if(isset($_COOKIE["creation_compte"]) && $_COOKIE["creation_compte"] == "true") { ?>
                notification_creation_compte(); // si on vient de créer un compte, on affiche la notification
        <?php 
                setcookie("creation_compte", "false"); // on supprime le cookie pour ne pas afficher la notification à chaque fois
            } ?>

        <?php if(isset($_COOKIE["suppresion_compte"]) && $_COOKIE["creation_compte"] == "true") { ?>
                notification_suppresion_compte(); // si on vient de supprimer un compte, on affiche la notification
        <?php 
                setcookie("suppresion_compte", "false"); // on supprime le cookie pour ne pas afficher la notification à chaque fois
            } ?>

    </script>

    <?php 


        if (isset($_COOKIE["id_utilisateur"])) { // si l'utilisateur est connecté on renouvelle le cookie
            setcookie("id_utilisateur", $_COOKIE["id_utilisateur"], time() + 24*3600);
        } 
        
        require('SousPages/connexionbdd.php'); 
        $connexion = connect_db();

        require('SousPages/sqlfunctions.php');


        // on récupère le nombre de posts à afficher

        $nb_total_post = count_post($connexion); // on compte le nombre de posts total


       // nombre de posts maximum à afficher 
       //(utilisé pour enlever le bouton "afficher plus de posts" si on a plus de 40 posts à afficher)
       $nb_max_post = 28; 

        if (isset($_POST["nb_post"])) { // si on a un nombre de post à afficher, on le prend        
            
            $nb_post = $_POST["nb_post"];

            if ($nb_post > $nb_total_post) { // si on a plus de posts à afficher que de posts total
                $nb_post = $nb_total_post;
                $nb_max_post = $nb_total_post;
            }

        } else { // sinon on prend la valeur par défaut
            $nb_post = 10;
        }


        if (isset($_COOKIE["id_utilisateur"])) {
            $result = select_accueil_login($connexion, $_COOKIE["id_utilisateur"], $nb_post);
            // nom, prenom, date, distance, temps, vitesse, commentaire, lieu, description
            // n'affiche pas les posts de l'utilisateur
            // met en premier les posts des personnes qu'il suit


        } else {
            $result = select_accueil_logout($connexion, $nb_post);
            // nom, prenom, date, distance, temps, vitesse, commentaire, lieu, description
        }
        
        while ($row = $result->fetch()) {

            $count_like = count_like($connexion, $row['id_post']);
            $count_like = $count_like->fetch();


            // Affichage des posts 
            echo "<div>";
            include("bouton_profil.php");
            ?>

                
            <?php
            include("SousPages/contenu_blog.php");
            $path = "../index.php";

            include("SousPages/like_comment.php");
            //Les </div> nécessaires sont dans ce include

            echo "</div>
                <br> <hr>
                <br>";
        }

        if ($nb_post < $nb_max_post) { // on affiche le bouton pour afficher plus de posts que si on a moins de 40 posts affichés
            echo "<form action='index.php' method='post'>
                    <input type='hidden' name='nb_post' value='".($nb_post + 10)."'>
                    <button type='submit'>Afficher plus de posts</button>
                </form>";
        }

    ?>

</div>

</body>

</html> 