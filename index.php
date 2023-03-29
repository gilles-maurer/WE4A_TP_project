<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">
<title>Accueil</title>
<link rel="stylesheet" href="./Styles/style.css"> 
</head>

<body>

<?php include("SousPages/navbar.php");?>


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
        echo "<div>
        <p>".$row['id_post']."</p>
        <p>".$row['nom']."</p>
        <p>".$row['prenom']."</p>
        <p>".$row['date']."</p>
        <p>".$row['distance']." km</p>
        <p>".$row['temps_heures']."h".$row['temps_minutes']."min".$row['temps_secondes']."s</p>
        <p>".$row['vitesse']." km/h</p>
        <p>".$row['description']."</p>
        <p>".$row['lieu']."</p>
        <p>".$count_like['nb_like']."</p>";

        // Formulaire like / unlike
        if (isset($_COOKIE['id_utilisateur'])) {

            $is_like = is_like($connexion, $row['id_post'], $_COOKIE['id_utilisateur']);
            $is_like = $is_like->fetch();    

            if ($is_like['nb_like'] == 0) {
                echo "<form action='SousPages/like.php' method='post'>
                <input type='hidden' name='id_post' value='".$row['id_post']."'>
                <input type='hidden' name='id_utilisateur' value='".$_COOKIE['id_utilisateur']."'>
                <input type='hidden' name='path' value='../index.php'>
                <input type='submit' value='Like'>
                </form>";
            } else {
                echo "<form action='SousPages/like.php' method='post'>
                <input type='hidden' name='id_post' value='".$row['id_post']."'>
                <input type='hidden' name='id_utilisateur' value='".$_COOKIE['id_utilisateur']."'>
                <input type='hidden' name='path' value='../index.php'>
                <input type='submit' value='Unlike'>
                </form>";
            }
        }

        // Commentaires
        $comments = find_comments($connexion, $row['id_post']);

        while ($comment = $comments->fetch()) {
            echo "<p>".$comment['texte']."</p>";
        }    

        // Formulaire commentaire
        if (isset($_COOKIE['id_utilisateur'])) {
            echo "<form action='SousPages/comment.php' method='post'>
            <input type='hidden' name='id_post' value='".$row['id_post']."'>
            <input type='hidden' name='id_utilisateur' value='".$_COOKIE['id_utilisateur']."'>
            <input type='hidden' name='path' value='../index.php'>
            <input type='text' name='texte'>
            <input type='submit' value='Commenter'>
            </form>";
        }


        echo "
        </div>
        <br> <hr>
        <br>";
    }

?>


</body>

</html> 