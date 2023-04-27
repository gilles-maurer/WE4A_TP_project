<?php

if ($width > $height) {
    /*
    Si la largeur est la plus grande dimension,
    on resize pour ne pas dépasser $max
    */
    $height = $height * $max / $width;
    $width = $max;
    //$max est défini dans bouton_profil.php (où ce ficher est utilisé)
} else {
    $width = $width * $max / $height;
    $height = $max;
}

?>