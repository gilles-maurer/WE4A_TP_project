<?php

function classement_nb_courses($connexion) {

    $sql = "SELECT 
                utilisateur.nom as nom,
                utilisateur.prenom as prenom,
                utilisateur.id_utilisateur as id_utilisateur,
                COUNT(post.id_post) as nb_courses
            FROM
                utilisateur
            INNER JOIN
                post
            ON
                utilisateur.id_utilisateur = post.id_utilisateur
            GROUP BY
                utilisateur.id_utilisateur
            ORDER BY
                nb_courses DESC
            ;"; 

    $result = $connexion->query($sql);

    return $result;
}


function classement_distance($connexion) {

    $sql = "SELECT 
                utilisateur.nom as nom,
                utilisateur.prenom as prenom,
                utilisateur.id_utilisateur as id_utilisateur,
                ROUND(SUM(post.distance) / 1000, 2) as distance
            FROM
                utilisateur
            INNER JOIN
                post
            ON
                utilisateur.id_utilisateur = post.id_utilisateur
            GROUP BY
                utilisateur.id_utilisateur
            ORDER BY
                distance DESC
            ;"; 

    $result = $connexion->query($sql);

    return $result;
}


function classement_temps($connexion) {

    $sql = "SELECT 
                utilisateur.nom as nom,
                utilisateur.prenom as prenom,
                utilisateur.id_utilisateur as id_utilisateur,
                SUM(SECOND(post.temps) + MINUTE(post.temps) * 60 + HOUR(post.temps) * 3600) as temps
            FROM
                utilisateur
            INNER JOIN
                post
            ON
                utilisateur.id_utilisateur = post.id_utilisateur
            GROUP BY
                utilisateur.id_utilisateur
            ORDER BY
                temps DESC
            ;"; 

    $result = $connexion->query($sql);

    return $result;
}


?>