<?php

    include("../SousPages/connectionbdd.php");
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
            
                echo "
                <form action='blog.php'>
                    <input type='hidden' name='blog' value='".$row['id_utilisateur']."'>
                    <button type='submit'>".$row['nom']." ".$row['prenom']."</button>
                </form>";

                if ($i < $nb_result) {
                    echo " <hr> ";
                }
                $i++;
            }
        }
        else {
            echo 'pas de résultats !';
        }
    }
    else{
        echo 'rechercher des blogs !';
    }

    echo '</i>';
?>