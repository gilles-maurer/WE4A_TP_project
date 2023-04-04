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
            
                soit on arrive depuis le bandeau -> on a un cookie si on est connecté
                                                -> on a pas de cookie, pas de get et pas de post

                soit on arrive depuis le login -> on a un cookie
                                                
                soit on arrive depuis un lien -> on a un get 

                soit on arrive depuis un bouton -> on a un get 

                soit on revient depuis le recherche -> on a un get

            */

            if (isset($_GET["blog"])) { // si on a un get tout va bien
                $blog = $_GET["blog"];

                echo "Tu es sur le blog de ".$blog; // A ENLEVER

            } else if (isset($_COOKIE["id_utilisateur"])) { // si pas de get mais qu'on a un cookie, on le prend et on relance la page
                $blog = $_COOKIE["id_utilisateur"];

                ?> 
                <form name="formauto" method="get" action="#">
                    <input type="hidden" name="blog" value="<?php echo $blog;?>">        
                </form>

                <script>
                    document.forms["formauto"].submit();
                </script>

                <?php

            } else if (isset($_POST["blog"])) { // en théorie, le post n'est jamais set mais par sécurité on le rajoute
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

        ?> 
        <?php


            if ($blog == 0) {
                echo "Tu n'es sur aucun blog connecte toi pour en avoir un, ou recherche celui de quelqu'un d'autre";
            } else {
            

                $titre = select_titre_blog($connexion, $blog);

                $titre = $titre->fetch();

                echo "<h1> Blog de ".$titre['prenom']." ".$titre['nom']."</h1>";

                echo "<hr>"; 

                if (isset($_COOKIE["id_utilisateur"])) {
                    if ($_COOKIE["id_utilisateur"] == $blog) {
                        echo "<form method='post' action='SousPages/ajout_post.php'>
                            <input type='submit' value='Ajouter un post'>
                        </form>";
                    } else {

                        $result = get_abonnement($connexion, $blog, $_COOKIE["id_utilisateur"]);
                        $result = $result->fetch();

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

                        $result = get_stats_blog($connexion, $blog); 

                        $result = $result->fetch(); 

                        $temps_heure = floor($result['temps']/3600);
                        $temps_minute = floor(($result['temps'] - $temps_heure*3600)/60);
                        $temps_seconde = $result['temps'] - $temps_heure*3600 - $temps_minute*60;

                        echo "<p>Distance parcourue : ".$result["distance"]." km</p>";
                        
                        echo "<p>Temps couru : ".$temps_heure." h ".$temps_minute." min ".$temps_seconde." s</p>";
                        echo "<p>Nombre de courses : ".$result["nb_courses"]."</p>";




                    }
                }


                echo "<hr>";



                if ($nb_post == "no_limit") {
                    $result = select_blog($connexion, $blog);
                } else {
                    $result = select_blog_limited($connexion, $blog, $nb_post);
                }

                // nom, prenom, date, distance, temps, vitesse, commentaire, lieu, nb like

                while ($row = $result->fetch()) {
                    
                    $count_like = count_like($connexion, $row['id_post']);
                    $count_like = $count_like->fetch();

                    echo "<div class='left'>

                    <p>".$row['date']."</p>
                    <p>".$row['distance']." km</p>
                    <p>".$row['temps_heures']."h".$row['temps_minutes']."min".$row['temps_secondes']."s</p>
                    <p>".$row['vitesse']." km/h</p>
                    <p>".$row['description']."</p>
                    <p>".$row['lieu']."</p>
                    <p>".$count_like['nb_like']."</p>";

                    $path = "../blog.php?blog=".$blog;

                    include("SousPages/like_comment.php");


                    echo "</div>
                    <br><hr>
                    <br>";
                }

            }

        ?>

    </div>

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