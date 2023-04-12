<?php

function select_accueil_logout($connexion) {

    // nom, prenom, date, distance, temps, vitesse, commentaire, lieu

    $sql = "SELECT 
                utilisateur.id_utilisateur as id_utilisateur,
                utilisateur.nom as nom, 
                utilisateur.prenom as prenom, 
                post.id_post as id_post,
                post.date as date, 
                ROUND(post.distance / 1000, 2) as distance, 
                post.temps as temps, 
                HOUR(post.temps) as temps_heures,
                MINUTE(post.temps) as temps_minutes,
                SECOND(post.temps) as temps_secondes,
                ROUND((post.distance / 1000) /((HOUR(post.temps) * 3600 + MINUTE(post.temps) * 60 + SECOND(post.temps)) / 3600), 2) as vitesse,
                post.description as description,
                post.lieu as lieu,
                post.id_post as ID_post
            FROM 
                post INNER JOIN utilisateur 
                    on post.ID_utilisateur = utilisateur.ID_utilisateur 
            ORDER BY
                post.date DESC
            LIMIT 10;
            ";

    $result = $connexion->query($sql);

    return $result;
}

function select_accueil_login($connexion, $id_utilisateur) {

    $sql = "SELECT 
                utilisateur.id_utilisateur as id_utilisateur,
                utilisateur.nom as nom, 
                utilisateur.prenom as prenom, 
                post.id_post as id_post,
                post.date as date, 
                ROUND(post.distance / 1000, 2) as distance, 
                post.temps as temps, 
                HOUR(post.temps) as temps_heures,
                MINUTE(post.temps) as temps_minutes,
                SECOND(post.temps) as temps_secondes,
                ROUND((post.distance / 1000) /((HOUR(post.temps) * 3600 + MINUTE(post.temps) * 60 + SECOND(post.temps)) / 3600), 2) as vitesse,
                post.description as description,
                post.lieu as lieu,
                post.id_post as ID_post
            FROM 
                post INNER JOIN utilisateur 
                    on post.ID_utilisateur = utilisateur.ID_utilisateur
            WHERE 
                utilisateur.ID_utilisateur != '".$id_utilisateur."'
            ORDER BY 
                post.id_post in (SELECT 
                                    ID_post
                                FROM 
                                    abonne INNER JOIN post 
                                        ON abonne.ID_suivie = post.ID_utilisateur
                                WHERE 
                                    ID_suiveur = '".$id_utilisateur."'
                                AND 
                                    post.date > DATE_SUB(NOW(), INTERVAL 10 DAY)) DESC,
                post.date DESC
            LIMIT 10
            ;";
            
    $result = $connexion->query($sql);

    return $result;

}

function count_like($connexion, $id_post) {

    $sql = "SELECT COUNT(*) as nb_like FROM liker WHERE id_post = '".$id_post."'";
    $result = $connexion->query($sql);

    return $result;

}

function is_like($connexion, $id_post, $id_utilisateur) {

    $sql = "SELECT COUNT(*) as nb_like FROM liker WHERE id_post = '".$id_post."' AND id_utilisateur = '".$id_utilisateur."'";
    $result = $connexion->query($sql);

    return $result;
}

function find_comments($connexion, $id_post) {

    $sql = "SELECT 
                commentaire.id_post as id_post,
                commentaire.id_utilisateur as id_utilisateur,
                commentaire.date as date,
                commentaire.texte as texte,
                utilisateur.nom as nom,
                utilisateur.prenom as prenom
            FROM 
                commentaire INNER JOIN utilisateur 
                    ON commentaire.id_utilisateur = utilisateur.id_utilisateur
            WHERE 
                id_post = '".$id_post."'
            ORDER BY date DESC";

    $result = $connexion->query($sql);

    return $result;
}


?>