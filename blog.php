<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">
<title>Blog</title>
<link rel="stylesheet" href="./Styles/style.css"> 
</head>

<body>

<?php include("SousPages/navbar.php");?>


<?php 

    require('SousPages/connectionbdd.php'); 
    $connexion = connect_db();

    require('SousPages/sqlfunctions.php');

?>

<div class="row">

    <div class="column-main">
        

        <?php 

            /*  
            Soit on arrive depuis le bandeau :
                -> Si on est connecté, on a un Cookie
                -> Sinon, on a pas de Cookie, pas de Get et pas de Post

            Soit on arrive depuis le login : on a un Cookie
                                            
            Soit on arrive depuis un lien, un bouton ou la recherche : on a un Get 
            */

            if (isset($_GET["blog"])) {

                // Si on a un Get (-> via tout sauf bandeau) tout va bien
                $blog = $_GET["blog"];

            } else if (isset($_COOKIE["id_utilisateur"])) { 

                // Si pas de Get mais qu'on a un Cookie (-> via le bandeau), on le prend et on relance la page
                $blog = $_COOKIE["id_utilisateur"];

                ?> 
                <form name="formauto" method="get" action="#">
                    <input type="hidden" name="blog" value="<?php echo $blog;?>">        
                </form>

                <script>
                    document.forms["formauto"].submit();
                </script>

                <?php

            } else if (isset($_POST["blog"])) { 
                
                // En théorie, le post n'est jamais set mais par sécurité on le rajoute
                $blog = $_POST["blog"];

                ?> 
                <form name="formauto" method="get" action="#">
                    <input type="hidden" name="blog" value="<?php echo $blog;?>">        
                </form>

                <script>
                    document.forms["formauto"].submit();
                </script>

                <?php

            } else {

                // Si on a rien reçu, alors l'utilisateur n'est pas connecté et n'a pas accédé à un blog
                $blog = 0;
            }

            


            if (isset($_GET["nb_post"])) {
                $nb_post = $_GET["nb_post"];
            } else {
                $nb_post = 10;
            }

            if (isset($_GET["recherche"])) {
                $recherche = $_GET["recherche"];
            } else {
                $recherche = "";
            }




            if ($blog == 0) {

                echo "<p>Tu n'es sur aucun blog. Connecte toi pour en avoir un, ou recherche celui de quelqu'un d'autre.<p>";

            } else {
            
                $titre = select_titre_blog($connexion, $blog);

                $titre = $titre->fetch();

                echo "<h1> Blog de ".$titre['prenom']." ".$titre['nom']."</h1><hr>";

                // Si l'utilisateur est connecté :
                if (isset($_COOKIE["id_utilisateur"])) {

                    //Si l'utilisateur est sur son propre blog :
                    if ($_COOKIE["id_utilisateur"] == $blog) {

                        echo "<form method='post' action='post.php'>
                            <input type='submit' value='Ajouter un post'>
                        </form>";

                        // S'il est sur le blog de quelqu'un d'autre :
                    } else {

                        $result = is_follow_by($connexion, $blog, $_COOKIE["id_utilisateur"]);
                        $result = $result->fetch();

                        // Si l'utilisateur n'est pas ou est abonné (le dernier input change en fonction)
                        if ($result["nb_abonnement"] == 0) {
                            echo "<form method='post' action='SousPages/abonnement.php'>
                                    <input type='hidden' name='id_suivie' value='".$blog."'>
                                    <input type='hidden' name='id_suiveur' value='".$_COOKIE["id_utilisateur"]."'>
                                    <input type='submit' value='Suivre'>
                                </form>";
                        } else {
                            echo "<form method='post' action='SousPages/abonnement.php'>
                                    <input type='hidden' name='id_suivie' value='".$blog."'>
                                    <input type='hidden' name='id_suiveur' value='".$_COOKIE["id_utilisateur"]."'>
                                    <input type='submit' value='Ne plus suivre'>
                                </form>";
                        }

                        // On récupère les stats totales de la personne dont on visite le blog
                        $result = get_stats_blog($connexion, $blog); 

                        $result = $result->fetch(); 

                        $temps_heure = floor($result['temps']/3600);
                        $temps_minute = floor(($result['temps'] - $temps_heure*3600)/60);
                        $temps_seconde = $result['temps'] - $temps_heure*3600 - $temps_minute*60;

                        echo "<p>Distance parcourue : ".$result["distance"]." km</p>";
                        
                        if ($temps_heure == 0) {
                            echo "<p>A couru pendant : ".$temps_minute." min</p>";
                        } else {
                            echo "<p>A couru pendant : ".$temps_heure." h et ".$temps_minute." min</p>";
                        }

                        echo "<p>Nombre de courses : ".$result["nb_courses"]."</p>";




                    }
                }


                echo "<hr>";

                // On vérifie le nombre de posts à afficher
                if ($nb_post == "no_limit") {
                    $result = select_blog($connexion, $blog);
                } else {
                    $result = select_blog_limited($connexion, $blog, $nb_post);
                }

                // Ordre d'affichage : nom, prenom, date, distance, temps, vitesse, commentaire, lieu, nb like
                while ($row = $result->fetch()) {
                    
                    $count_like = count_like($connexion, $row['id_post']);
                    $count_like = $count_like->fetch();

                    include("SousPages/contenu_blog.php");
                    $path = "../blog.php?blog=".$blog;
                    include("SousPages/like_comment.php");

                    // Si on regarde des posts de notre propre blog, on a l'option de les supprimer ou de les modifier
                    if (isset($_COOKIE["id_utilisateur"])) {
                        if ($_COOKIE["id_utilisateur"] == $blog) {
                            
                            ?>
                            <div class='left'>
                                <form action="SousPages/delete_post.php" onsubmit="return confirm('Etes-vous sur de vouloir effacer?')" method='post'>
                                    <input type='hidden' name='id_post' value='<?php echo $row['id_post'];?>'>
                                    <input type='submit' value='Supprimer'>
                                </form>

                                <form method='post' action='post.php'>
                                    <input type='hidden' name='id_post_modif' value='<?php echo $row['id_post'];?>'>
                                    <input type='submit' value='Modifier'>
                                </form>
                            </div>
                            <?php
                        }
                    }

                    echo "<br><hr>
                    <br>";
                }

            }

        ?>

    </div> <!-- Fin de column-main -->

    <!-- Onglet de recherche -->
    <div class="column-side">

        <?php

        if(isset($_COOKIE["id_utilisateur"]) && $_COOKIE["id_utilisateur"] != $blog) {

            echo "
            <form action='blog.php'>
                    <input type='hidden' name='blog' value='".$_COOKIE['id_utilisateur']."'>
                    <button type='submit'>Retourner sur mon blog</button>
            </form>"; 
        }

        ?>

        <div> 
            <?php include("AJAX/recherche_blog.php"); ?> 
        </div>

    </div>

</body>


</html> 