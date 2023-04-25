<?php

    include("../SousPages/connexionbdd.php");
    $connexion = connect_db();

    $text = $_GET["var"]; // récupère la variable envoyée par AJAX
    $text = str_replace("'", "\'", $text);

    echo '<i>';

    if ($text != "") {
        $sql = "SELECT id_utilisateur, nom, prenom FROM utilisateur WHERE LOWER(nom) LIKE LOWER('$text%') OR LOWER(prenom) LIKE('$text%');";
        $result = $connexion->query($sql);

        // $nb_result = $row["nb_result"];

        $nb_result = $result->rowCount();

        if ($nb_result > 0) {
            $i = 1;
            while($row = $result->fetch()){
            
                include("bouton_profil.php");

                if ($i < $nb_result) {
                    echo " <hr> ";
                }
                $i++;
            }
        }
        else {
            echo 'Pas de résultats !';
        }
    }
    else{
        echo 'Recherchez des blogs !';
    }

    echo '</i>';
?>