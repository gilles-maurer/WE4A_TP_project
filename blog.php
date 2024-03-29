<!DOCTYPE html>
<html lang="fr">

<head>
<?php include("SousPages/header.php");?>
<title>Blog</title>
</head>

<body>

<!--
    Cette page est là où s'affichent les blogs
    des personnes (contrairement à l'accueil où
    les posts sont affichés par date).

    De base, on affiche le blog de l'utilisateur
    (s'il est connecté),
    mais il peut rechercher un autre utilisateur et
    consulter son blog.
-->

<?php include("SousPages/navbar.php");?>


<?php 

    require('SousPages/connexionbdd.php'); 
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

            

            //Spécification du nombre de posts à afficher par pages
            if (isset($_GET["nb_post"])) {
                $nb_post = $_GET["nb_post"];
            } else {
                $nb_post = 10;
            }


            //Si on est sur aucun blog (déconnecté + pas de blog en lecture)
            if ($blog == 0) {

                echo "<p>Tu n'es sur aucun blog. Connecte toi pour en avoir un, ou recherche celui de quelqu'un d'autre.<p>";

            } else {
            
                // On récupère les infos de la personne à qui appartient le blog
                $titre = select_titre_blog($connexion, $blog);
                $titre = $titre->fetch();


                // on calcule la taille de l'avatar
                $max = 128;
                list($width, $height, $type, $attr) = getimagesize($titre["avatar"]);
                include("SousPages/calcul_image_size.php");


                // on affiche l'avatar et le nom de la personne
                echo "<div><br>";
                echo "<img src='".$titre["avatar"]."' class='avatar' height='".$height."' width='".$width."' >";
                echo "</div>";

                echo "<h1> Blog de ".$titre['prenom']." ".$titre['nom']."</h1>";
                


                // Si l'utilisateur est connecté :
                if (isset($_COOKIE["id_utilisateur"])) {

                    //Si l'utilisateur est sur son propre blog, il peut créer un post.
                    if ($_COOKIE["id_utilisateur"] == $blog) {

                        echo "<hr><form class='right' method='post' action='post.php'>
                            <input type='submit' value='Ajouter un post'>
                        </form>";

                    // S'il est sur le blog de quelqu'un d'autre, il peut s'abonner ou se désabonner
                    } else {

                        $result = is_follow_by($connexion, $blog, $_COOKIE["id_utilisateur"]);
                        $result = $result->fetch();

                        // Si l'utilisateur n'est pas ou est abonné (le dernier input change en fonction)
                        if ($result["nb_abonnement"] == 0) {
                            echo "<hr>
                                <form method='post' action='SousPages/abonnement.php'>
                                    <input type='hidden' name='id_suivie' value='".$blog."'>
                                    <input type='hidden' name='id_suiveur' value='".$_COOKIE["id_utilisateur"]."'>
                                    <input type='submit' value='Suivre'>
                                </form>";
                        } else {
                            echo "<hr>
                                <form method='post' action='SousPages/abonnement.php'>
                                    <input type='hidden' name='id_suivie' value='".$blog."'>
                                    <input type='hidden' name='id_suiveur' value='".$_COOKIE["id_utilisateur"]."'>
                                    <input type='submit' value='Ne plus suivre'>
                                </form>";
                        }
                    }
                    
                }


                // Affichage des stats du blog que l'on soit connecté ou non
                $id_stats = $blog;
                include('SousPages/show_stats.php');

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
                    /*
                    Malgré la présence de divs dans ces includes,
                    on revient à la hiérarchie d'origine à la fin
                    */

                    // Si on regarde des posts de notre propre blog, on a l'option de les supprimer ou de les modifier
                    if (isset($_COOKIE["id_utilisateur"])) {
                        if ($_COOKIE["id_utilisateur"] == $blog) {
                            
                            ?>
                            <div class='right'>
                                <form method='post' action='post.php'>
                                    <input type='hidden' name='id_post_modif' value='<?php echo $row['id_post'];?>'>
                                    <input type='submit' value='Modifier le post'>
                                </form>

                                <form action="SousPages/delete_post.php" onsubmit="return confirm('Etes-vous sur de vouloir effacer?')" method='post'>
                                    <input type='hidden' name='id_post' value='<?php echo $row['id_post'];?>'>
                                    <input type='submit' value='Supprimer le post'>
                                </form>
                            </div>
                            <?php
                        }
                    }

                    echo "<br><hr><br>";
                }

                // En bas de page, on a la possibilité de voir tous les posts 
                if ($nb_post != "no_limit" && $nombre_total_de_courses > 10) {
                    ?>
                    <form method='get' action='blog.php'>
                        <input type='hidden' name='blog' value='<?php echo $blog;?>'>
                        <input type='hidden' name='nb_post' value='no_limit'>
                        <input type='submit' value='Voir tous les posts'>
                    </form>
                    <?php
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

        <!-- Affichage dynamique des comptes avec AJAX -->
        <div> 
            <?php include("AJAX/recherche_blog.php"); ?> 
        </div>

    </div>

</div>
</body>


</html> 