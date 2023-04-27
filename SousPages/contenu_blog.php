<?php 

date_default_timezone_set("Europe/Paris"); //Ligne à inclure, sinon erreur dans la ligne suivante.
$date = date_create($row['date']);
$date = date_format($date, 'd/m/Y');

/**
 *  Affiche :
 *   - La date et le lieu
 *   - La distance, le temps, et la vitesse moyenne
 *   - Le nombre de likes
 *   - Les commentaires
 * 
 * Likes et commentaires sont définis dans
 * like_comment.php (toujours include après cet include-ci).
 * */ 

echo "
<p class='location'>Le ".$date.", à ".$row['lieu']."</p><br><br>";

if(!($row['description']=="")){
    echo "<p class='box'>".$row['description']."</p>";
}

echo "
<div class='row'>

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
?>