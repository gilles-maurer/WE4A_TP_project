<!DOCTYPE html>
<html lang="fr">

<head>

<?php include("SousPages/header.php");?>

<title>RunShare</title>
</head>

<!--
    Cette page est la page d'accueil.
    C'est ici qu'on affiche les posts par date de publication.
    Aussi, il y a une priorité pour les personnes
    auxquelles l'utilisateur est abonnées.
-->

<script>

    //Selon les headers qui nous amènent à cette page (lors de création/suppression de compte) :
    function notification_creation_compte() {
        alert("Votre compte a bien été créé !"); // Affiche une notification pour dire que le compte a bien été créé.
    }

    function notification_suppression_compte() {
        alert("Votre compte a bien été supprimé..."); // Affiche une notification pour dire que le compte a bien été supprimé.
    }

</script>

<body>

<?php include("SousPages/navbar.php");?>

<div id="MainContainer">

    <h1>RunShare</h1>

    <script>

        <?php if(isset($_COOKIE["creation_compte"]) && $_COOKIE["creation_compte"] == "true") { ?>
                // Si on vient de créer un compte, on affiche la notification.
                notification_creation_compte(); 
        <?php 
                // On supprime le cookie pour ne pas afficher la notification à chaque fois.
                setcookie("creation_compte", "false"); 
                } ?>

        <?php if(isset($_COOKIE['suppression_compte']) && $_COOKIE['suppression_compte'] == "true") { ?>
                // Si on vient de supprimer un compte, on affiche la notification.
                notification_suppression_compte(); 
        <?php 
                // On supprime le cookie pour ne pas afficher la notification à chaque fois.
                setcookie("suppression_compte", "false"); 
                } ?>

    </script>

    <?php 


        // Si l'utilisateur est connecté on renouvelle le cookie.
        if (isset($_COOKIE["id_utilisateur"])) { 
            setcookie("id_utilisateur", $_COOKIE["id_utilisateur"], time() + 24*3600);
        } 
        
        require('SousPages/connexionbdd.php'); 
        $connexion = connect_db();
        require('SousPages/sqlfunctions.php');


        // On récupère le nombre de posts à afficher :
        $nb_total_post = count_post($connexion); // On compte le nombre total de posts


        /* 
        Nombre de posts maximum à afficher 
        (utilisé pour enlever le bouton "afficher plus de posts"
        si on a plus de 40 posts à afficher) 
        */
        $nb_max_post = 28; 

        // Si on a un nombre de post à afficher, on le prend.
        if (isset($_POST["nb_post"])) { 
            
            $nb_post = $_POST["nb_post"];

            // Si on a plus de posts à afficher que de posts au total :
            if ($nb_post > $nb_total_post) { 
                $nb_post = $nb_total_post;
                $nb_max_post = $nb_total_post;
            }

        // Sinon, on prend la valeur par défaut.
        } else { 
            $nb_post = 10;
        }


        if (isset($_COOKIE["id_utilisateur"])) {
            $result = select_accueil_login($connexion, $_COOKIE["id_utilisateur"], $nb_post);
            /*
            Cette requête n'affiche pas les posts de l'utilisateur,
            et met en premier les posts des personnes qu'il suit.
            */

        } else {
            $result = select_accueil_logout($connexion, $nb_post);
        }
        
        while ($row = $result->fetch()) {

            $count_like = count_like($connexion, $row['id_post']);
            $count_like = $count_like->fetch();


            // Affichage des posts 
            echo "<div>";

                    include("SousPages/bouton_profil.php");
                    include("SousPages/contenu_blog.php");
                    $path = "../index.php";
                    include("SousPages/like_comment.php");

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