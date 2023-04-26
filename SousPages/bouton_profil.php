<?php

/*

ajax/load recherche:
    <form action='blog.php'>
        <input type='hidden' name='blog' value='".$row['id_utilisateur']."'>
        <button type='submit'>".$row['nom']." ".$row['prenom']."</button>
    </form>";

index:
    <form action='blog.php'>
        <input type='hidden' name='blog' value='".$row['id_utilisateur']."'>
        <button type='submit'>".$row['nom']." ".$row['prenom']."</button>
    </form>";

stats (profil -> abonnements):
    <form action='blog.php'>
        <input type='hidden' name='blog' value='".$row['ID_suiveur']."'>
        <button type='submit'>".$row2['nom']." ".$row2['prenom']."</button>
    </form><br>

    -> DIFFERENCES


classements:
    <form action='blog.php'>
        <input type='hidden' name='blog' value='".$row['id_utilisateur']."'>
        <button type='submit'>".$row['nom']." ".$row['prenom']."</button>
    </form>
*/

$max = 64;
list($width, $height, $type, $attr) = getimagesize($row["avatar"]);

include("calcul_image_size.php");

echo "
    <form action='blog.php'>
        <input type='hidden' name='blog' value='".$row['id_utilisateur']."'>
        <button type='submit'>
            <div class='box-invisible'>
                <div class='boximage'>
                    <img src='".$row["avatar"]."' height='".$height."' width='".$width."' class='avatar'>
                </div>
                <div class='boxtext'>
                    ".$row['nom']." ".$row['prenom']."
                </div>
            </div>
        </button>
    </form>
";

?>