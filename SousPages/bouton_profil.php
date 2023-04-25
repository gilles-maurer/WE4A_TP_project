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

$max = 128;
list($width, $height, $type, $attr) = getimagesize($row["avatar"]);

if ($width > $height) {
    /*
    Si la largeur est la plus grande dimension,
    on resize pour ne pas dépasser $max
    */
    $height = $height * $max / $width;
    $width = $max;
} else {
    $width = $width * $max / $height;
    $height = $max;
}

echo "
    <form action='blog.php'>
        <input type='hidden' name='blog' value='".$row['id_utilisateur']."'>
        <button type='submit'>
            <img src='".$row["avatar"]."' height='".$height."' width='".$width."'>
            ".$row['nom']." ".$row['prenom']."
        </button>
    </form>
";

?>