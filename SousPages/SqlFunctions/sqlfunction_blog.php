<?php

// renvoie les posts d'un utilisateur en fonction de son id (prends une limite de nombre de posts)
// ordonnés par date décroissante

function select_blog_limited($connexion, $id, $limit) {

    $sql = "SELECT 
    utilisateur.nom as nom, 
    utilisateur.prenom as prenom, 
    post.id_post as id_post,
    post.date as date, 
    ROUND(post.distance / 1000, 2) as distance, 
    HOUR(post.temps) as temps_heures,
    MINUTE(post.temps) as temps_minutes,
    SECOND(post.temps) as temps_secondes,
    ROUND((post.distance / 1000) /((HOUR(post.temps) * 3600 + MINUTE(post.temps) * 60 + SECOND(post.temps)) / 3600), 2) as vitesse,
    post.description as description,
    post.lieu as lieu,
    post.id_post as ID_post
    FROM 
        post INNER JOIN utilisateur 
            ON post.ID_utilisateur = utilisateur.ID_utilisateur 
    WHERE 
        post.ID_utilisateur = '".$id."'
    ORDER BY
        post.date DESC
    LIMIT ".$limit.";
    ";


    $result = $connexion->query($sql);

    return $result;
}


// renvoie les posts d'un utilisateur en fonction de son id (sans limite de nombre de posts)
// ordonnés par date décroissante

function select_blog($connexion, $id) {

    $sql = "SELECT 
    utilisateur.nom as nom, 
    utilisateur.prenom as prenom, 
    post.id_post as id_post,
    post.date as date, 
    ROUND(post.distance / 1000, 2) as distance, 
    HOUR(post.temps) as temps_heures,
    MINUTE(post.temps) as temps_minutes,
    SECOND(post.temps) as temps_secondes,
    ROUND((post.distance / 1000) /((HOUR(post.temps) * 3600 + MINUTE(post.temps) * 60 + SECOND(post.temps)) / 3600), 2) as vitesse,
    post.description as description,
    post.lieu as lieu,
    post.id_post as ID_post
    FROM 
        post INNER JOIN utilisateur 
            ON post.ID_utilisateur = utilisateur.ID_utilisateur 
    WHERE 
        post.ID_utilisateur = '".$id."'
    ORDER BY
        post.date DESC
    ;";
    
    
    $result = $connexion->query($sql);

    return $result;
}


// recherche les utilisateurs en fonction d'une chaîne de caractères (nom, prénom, email)

function select_recherche_blog($connexion, $recherche) {

    $sql = "SELECT
                utilisateur.nom as nom,
                utilisateur.prenom as prenom,
                utilisateur.email as email,
                utilisateur.id_utilisateur as id_utilisateur            
            FROM
                utilisateur
            WHERE
                utilisateur.nom LIKE '%".$recherche."%'
            OR
                utilisateur.prenom LIKE '%".$recherche."%'
            OR
                utilisateur.email LIKE '%".$recherche."%'
            ;";

    $result = $connexion->query($sql);

    return $result;
}

// renvoie le nom et le prénom d'un utilisateur en fonction de son id

function select_titre_blog($connexion, $blog) {

    $sql = "SELECT
                utilisateur.nom as nom,
                utilisateur.prenom as prenom         
            FROM
                utilisateur
            WHERE
                utilisateur.id_utilisateur = '".$blog."'
            ;";

    $result = $connexion->query($sql);

    return $result;


}


// renvoie les statistiques d'un utilisateur en fonction de son id

function get_stats_blog($connexion, $id_utilisateur) {

    $sql = "SELECT 
                COUNT(post.id_post) as nb_courses,
                ROUND(SUM(post.distance) / 1000, 2) as distance,
                SUM(SECOND(post.temps) + MINUTE(post.temps) * 60 + HOUR(post.temps) * 3600) as temps
            FROM                     
                utilisateur
            INNER JOIN
                post
            ON
                utilisateur.id_utilisateur = post.id_utilisateur
            WHERE 
                utilisateur.id_utilisateur = ".$id_utilisateur.";"; 

    $result = $connexion->query($sql); 

    return $result; 

}


// renvoie 1 si l'utilisateur est abonné à l'utilisateur dont l'id est $id_suivie, 0 sinon

function is_follow_by($connexion, $id_suivie, $id_suiveur) {

    $sql = "SELECT COUNT(*) as nb_abonnement FROM abonne WHERE id_suivie = '".$id_suivie."' AND id_suiveur = '".$id_suiveur."';";
    $result = $connexion->query($sql);
    return $result;

}

?>