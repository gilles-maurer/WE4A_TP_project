<?php

    require("../SousPages/connexionbdd.php");
    $connexion = connect_db();

    require("../SousPages/sqlfunctions.php");

    $text = $_GET["var"]; // récupère la variable envoyée par AJAX
    $text = str_replace("'", "\'", $text);

    echo '<i>';

    if ($text != "") {
        
        $result = get_recherche_blog($connexion, $text);

        $nb_result = $result->rowCount();

        if ($nb_result > 0) {
            $i = 1;
            while($row = $result->fetch()){


                echo "
                    <form action='blog.php'>
                        <input type='hidden' name='blog' value='".$row['id_utilisateur']."'>
                        <button type='submit'>".$row['nom']." ".$row['prenom']."</button>
                    </form>
                ";


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