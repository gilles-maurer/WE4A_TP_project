<?php

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

?>