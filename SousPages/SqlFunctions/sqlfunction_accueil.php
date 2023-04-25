<?php


// compte le nombre de post total dans la base de donnée

function count_post($connexion) {

    $sql = "SELECT COUNT(*) as nb_post FROM post";

    $result = $connexion->query($sql);

    $result = $result->fetch();

    return $result["nb_post"];
}



// renvoie les posts les plus récents de la base de donnée (prends une limité à 10)
// est appelé dans la page d'accueil si l'utilisateur n'est pas connecté
// ordonnés par date décroissante

function select_accueil_logout($connexion, $limit) {

    // nom, prenom, date, distance, temps, vitesse, commentaire, lieu

    $sql = "SELECT 
                utilisateur.id_utilisateur as id_utilisateur,
                utilisateur.nom as nom, 
                utilisateur.prenom as prenom, 
                utilisateur.avatar as avatar,
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
            LIMIT ".$limit.";
            ";

    $result = $connexion->query($sql);

    return $result;
}


// est appelé dans la page d'accueil si l'utilisateur n'est pas connecté
// renvoie les posts des utilisateurs que l'utilisateur connecté suit jusqu'à 10 jours 
// renvoie ensuite les posts les plus récents d'autres utilisateurs 
// limite à 10 posts
// ne renvoie pas les posts de l'utilisateur connecté

function select_accueil_login($connexion, $id_utilisateur, $limit) {

    $sql = "SELECT 
                utilisateur.id_utilisateur as id_utilisateur,
                utilisateur.nom as nom, 
                utilisateur.prenom as prenom, 
                utilisateur.avatar as avatar,
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
            LIMIT ".$limit."
            ;";
            
    $result = $connexion->query($sql);

    return $result;

}


// compte le nombre de like d'un post

function count_like($connexion, $id_post) {

    $sql = "SELECT COUNT(*) as nb_like FROM liker WHERE id_post = '".$id_post."'";
    $result = $connexion->query($sql);

    return $result;

}


// renvoie 1 si l'utilisateur connecté a liké le post, 0 sinon

function is_like($connexion, $id_post, $id_utilisateur) {

    $sql = "SELECT COUNT(*) as nb_like FROM liker WHERE id_post = '".$id_post."' AND id_utilisateur = '".$id_utilisateur."'";
    $result = $connexion->query($sql);

    return $result;
}


// renvoie les commentaires d'un post ainsi que les informations de l'utilisateur qui a commenté

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