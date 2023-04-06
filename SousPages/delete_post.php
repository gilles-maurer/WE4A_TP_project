<?php


    require('connectionbdd.php');
    $connection = connect_db();

    require('sqlfunctions.php');

    delete_post($connection, $_POST["id_post"]);

    header("Location: ../blog.php?blog=".$_COOKIE["id_utilisateur"]);


?>

