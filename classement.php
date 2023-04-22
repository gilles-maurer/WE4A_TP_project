<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">
<title>Classement</title>
<link rel="stylesheet" href="./Styles/style.css"> 
</head>

<body>

<?php include("SousPages/navbar.php");?>

<div class="row">
<?php

    require('SousPages/connexionbdd.php');
    $connexion = connect_db();

    require('SousPages/sqlfunctions.php');


    /*==============================================================================
    =================== Première colonne : par nombre de courses ===================
    ==============================================================================*/

    /** Le fonctionnement est le même pour les trois colonnes.
     * Cependant, vu que les champs sont toujours légèrement différents,
     * on ne peut pas faire de include.
     * (Seule cette colonne sera commentée puisque les deux autres sont similaires.)
     */

    echo "<div class='column-third'>"; //Pour l'affichage en trois cadres côte à côte
    echo "<h2>Classement par nombre de courses</h2><br>";

    $result = classement_nb_courses($connexion);

    $i = 0; 

    while($row = $result->fetch()) {

        $i = $i + 1;
        echo "<hr><div class='box-invisible'>"; //Division pour pouvoir centrer la position

        if($i==1){
            echo "<p class='firstplace'>".$i."</p>";
        } elseif ($i==2) {
            echo "<p class='secondplace'>".$i."</p>";
        } elseif ($i==3) {
            echo "<p class='thirdplace'>".$i."</p>";
        } else {
            echo "<p class='otherplaces'>".$i."</p>";
        } //Pour pouvoir changer la couleur du cadre
        
        echo "
        </div>
        <div class='box-invisible'>
            <div class='boxtext'>
                <form action='blog.php'>
                        <input type='hidden' name='blog' value='".$row['id_utilisateur']."'>
                        <button type='submit'>".$row['nom']." ".$row['prenom']."</button>
                </form>
            </div>
            <div class='boxtext'>
                <p>a couru ".$row['nb_courses']." fois !</p>
            </div>
        </div><br><br>";
        //Ajout des divs pour pouvoir aligner bouton et texte et ne faire qu'une phrase
    }



    /*==============================================================================
    ======================== Deuxième colonne : par distance =======================
    ==============================================================================*/

    echo "</div><div class='column-third'>";
    echo "<h2>Classement par distance parcourue</h2><br>";

    $result = classement_distance($connexion);

    $i = 0;

    while($row = $result->fetch()) {

        $i = $i + 1;
        echo "<hr><div class='box-invisible'>";
            if($i==1){
                echo "<p class='firstplace'>".$i."</p>";
            } elseif ($i==2) {
                echo "<p class='secondplace'>".$i."</p>";
            } elseif ($i==3) {
                echo "<p class='thirdplace'>".$i."</p>";
            } else {
                echo "<p class='otherplaces'>".$i."</p>";
            }
        
        echo "
        </div>
        <div class='box-invisible'>
            <div class='boxtext'>
                <form action='blog.php'>
                        <input type='hidden' name='blog' value='".$row['id_utilisateur']."'>
                        <button type='submit'>".$row['nom']." ".$row['prenom']."</button>
                </form>
            </div>
            <div class='boxtext'>
                <p>a parcouru ".$row['distance']."km !</p>
            </div>
        </div><br><br>";
        //Ajout des divs pour pouvoir aligner bouton et texte et ne faire qu'une phrase
    }





    /*==============================================================================
    ========================= Troisième colonne : par temps ========================
    ==============================================================================*/

    echo "</div><div class='column-third'>";
    echo "<h2>Classement par temps de course total</h2><br>";

    $result = classement_temps($connexion);

    $i = 0;

    while($row = $result->fetch()) {

        $i = $i + 1;
        echo "<hr><div class='box-invisible'>";

        $temps_heure = floor($row['temps']/3600);
        $temps_minute = floor(($row['temps'] - $temps_heure*3600)/60);
        $temps_seconde = $row['temps'] - $temps_heure*3600 - $temps_minute*60;

        if($i==1){
            echo "<p class='firstplace'>".$i."</p>";
        } elseif ($i==2) {
            echo "<p class='secondplace'>".$i."</p>";
        } elseif ($i==3) {
            echo "<p class='thirdplace'>".$i."</p>";
        } else {
            echo "<p class='otherplaces'>".$i."</p>";
        }
        echo "
        </div>
        <div class='box-invisible'>
            <div class='boxtext'>
                <form action='blog.php'>
                        <input type='hidden' name='blog' value='".$row['id_utilisateur']."'>
                        <button type='submit'>".$row['nom']." ".$row['prenom']."</button>
                </form>
            </div>
            <div class='boxtext'>";
                if ($temps_heure == 0) {
                    echo "<p>a couru pendant ".$temps_minute." min !</p>";
                } else {
                    echo "<p>a couru pendant ".$temps_heure." h et ".$temps_minute." min !</p>";
                }
            echo "</div>
        </div><br><br>";
    }
    

?>

</div></div>

</body>

</html> 