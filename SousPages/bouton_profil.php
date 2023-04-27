<?php

$max = 64;
list($width, $height, $type, $attr) = getimagesize($row["avatar"]);

include("calcul_image_size.php");

/*
Quand on a la possibilité d'accéder à un profil (via un bouton, hors recherche),
on affiche la photo de profil et le nom, l'un au-dessus de l'autre.
*/
echo "
    <form action='blog.php'>
        <input type='hidden' name='blog' value='".$row['id_utilisateur']."'>
        <button type='submit'>
            <div style='align-items:center'>
                <img src='".$row["avatar"]."' height='".$height."' width='".$width."' class='avatar'>
                <br>
                ".$row['nom']." ".$row['prenom']."
            </div>
        </button>
    </form>
";

?>