<?php

$max = 64;
list($width, $height, $type, $attr) = getimagesize($row["avatar"]);

include("calcul_image_size.php");

/*
Quand on a la possibilité d'accéder à un profil (via un bouton),
on affiche la photo de profil et le nom, alignés.
*/
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