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

        echo "Tu es sur le blog de ".$blog;

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

    <div class="right"> 

        <form method="get" action="#">
            <input type="hidden" name="blog" value="<?php echo $blog;?>">
            <input type="hidden" name="nb_post" value="<?php echo $nb_post;?>">
            
            <input type="text" name="recherche" placeholder="Recherche">

            <input type="submit" value="Rechercher">
        </form>

    </div>

<?php 

    if ($recherche != "") {

        $result = select_recherche_blog($connexion, $recherche);

        // nom, prenom, email
        while ($row = $result->fetch()) {

        ?>
                
                <div class="left">
                    <p><?php echo $row['nom'];?></p>
                    <p><?php echo $row['prenom'];?></p>
                    <p><?php echo $row['email'];?></p>
                    <form method="get" action="#">
                        <input type="hidden" name="blog" value=" <?php echo $row['id_utilisateur'];?> ">
                        <input type="submit" value="Voir le blog">
                    </form>
                </div>
                <br>
                <br>

        <?php

        }
    }
?>


<?php


    if ($blog == 0) {
        echo "Tu n'es sur aucun blog connecte toi pour en avoir un, ou recherche celui de quelqu'un d'autre";
    } else {
    
        if ($nb_post == "no_limit") {
            $result = select_blog($connexion, $blog);
        } else {
            $result = select_blog_limited($connexion, $blog, $nb_post);
        }
    
        // nom, prenom, date, distance, temps, vitesse, commentaire, lieu, nb like
    
        while ($row = $result->fetch()) {
            echo "<div class='left'>
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

    }

?>




</body>

</html> 