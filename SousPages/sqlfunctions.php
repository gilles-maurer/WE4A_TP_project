<?php

    // fonctions page accueil

    function select_accueil_logout($connexion) {

        // nom, prenom, date, distance, temps, vitesse, commentaire, lieu, nb like

        $sql = "SELECT 
                    utilisateur.nom as nom, 
                    utilisateur.prenom as prenom, 
                    post.date as date, 
                    ROUND(post.distance / 1000, 2) as distance, 
                    post.temps as temps, 
                    HOUR(post.temps) as temps_heures,
                    MINUTE(post.temps) as temps_minutes,
                    SECOND(post.temps) as temps_secondes,
                    ROUND((post.distance / 1000) /((HOUR(post.temps) * 3600 + MINUTE(post.temps) * 60 + SECOND(post.temps)) / 3600), 2) as vitesse,
                    post.commentaire as commentaire,
                    post.lieu as lieu,
                    post.id_post as ID_post,
                    COUNT(*) as nb_like
                    FROM 
                        post INNER JOIN utilisateur 
                            on post.ID_utilisateur = utilisateur.ID_utilisateur 
                                LEFT OUTER JOIN liker 
                                    on liker.ID_post = post.ID_post
                GROUP BY
                    post.ID_post
                ORDER BY
                    post.date DESC
                LIMIT 10;
                ";

        $result = $connexion->query($sql);

        return $result;
    }


    // fonctions page signin 

    function sign_in($connexion) {

        $sql = "INSERT INTO utilisateur 
        (nom, prenom, email, mot_de_passe, date_naissance, date_inscription) 
        VALUES 
        ('".$_POST['nom']."', '".$_POST['prenom']."', 
        '".$_POST['email']."', '".md5($_POST['mot_de_passe'])."', 
        '".$_POST['date_naissance']."', NOW())";
    
        $result = $connexion->query($sql);

        return $result; 
    }

    // fonctions page login

    function check_login($connexion, $email) {

        $sql = "SELECT * FROM utilisateur WHERE email='$email'";
        $result = $connexion->query($sql);

        return $result; 

    }


    // fonctions page profil

    function select_profil($connexion) {

        $sql = "SELECT * FROM utilisateur WHERE id = '".$_SESSION['id']."'";
        $result = $connexion->query($sql);

        return $result;
    }

    function compute_age($date_naissance) {

        $date_naissance = new DateTime($date_naissance);
        $date_actuelle = new DateTime();
        $age = $date_naissance->diff($date_actuelle);

        return $age->y;
    }

    function compute_distance_total($connexion) {

        $sql = "SELECT SUM(distance) AS distance_total FROM parcours WHERE id_utilisateur = '".$_SESSION['id']."'";
        $result = $connexion->query($sql);

        return $result;
    }

    function compute_temps_total($connexion) {

        $sql = "SELECT SUM(temps) AS temps_total FROM parcours WHERE id_utilisateur = '".$_SESSION['id']."'";
        $result = $connexion->query($sql);

        return $result;
    }


    // fonctions page blog

    function select_blog_limited($connexion, $id, $limit) {

        $sql = "SELECT 
        utilisateur.nom as nom, 
        utilisateur.prenom as prenom, 
        post.date as date, 
        ROUND(post.distance / 1000, 2) as distance, 
        post.temps as temps, 
        HOUR(post.temps) as temps_heures,
        MINUTE(post.temps) as temps_minutes,
        SECOND(post.temps) as temps_secondes,
        ROUND((post.distance / 1000) /((HOUR(post.temps) * 3600 + MINUTE(post.temps) * 60 + SECOND(post.temps)) / 3600), 2) as vitesse,
        post.commentaire as commentaire,
        post.lieu as lieu,
        post.id_post as ID_post,
        COUNT(*) as nb_like
        FROM 
            post INNER JOIN utilisateur 
                on post.ID_utilisateur = utilisateur.ID_utilisateur 
                    LEFT OUTER JOIN liker 
                        on liker.ID_post = post.ID_post
        WHERE 
            post.ID_utilisateur = '".$id."'
        GROUP BY
            post.ID_post
        ORDER BY
            post.date DESC
        LIMIT ".$limit.";
        ";


        $result = $connexion->query($sql);

        return $result;
    }

    function select_blog($connexion, $id) {

        $sql = "SELECT 
        utilisateur.nom as nom, 
        utilisateur.prenom as prenom, 
        post.date as date, 
        ROUND(post.distance / 1000, 2) as distance, 
        post.temps as temps, 
        HOUR(post.temps) as temps_heures,
        MINUTE(post.temps) as temps_minutes,
        SECOND(post.temps) as temps_secondes,
        ROUND((post.distance / 1000) /((HOUR(post.temps) * 3600 + MINUTE(post.temps) * 60 + SECOND(post.temps)) / 3600), 2) as vitesse,
        post.commentaire as commentaire,
        post.lieu as lieu,
        post.id_post as ID_post,
        COUNT(*) as nb_like
        FROM 
            post INNER JOIN utilisateur 
                on post.ID_utilisateur = utilisateur.ID_utilisateur 
                    LEFT OUTER JOIN liker 
                        on liker.ID_post = post.ID_post
        WHERE 
            post.ID_utilisateur = '".$id."'
        GROUP BY
            post.ID_post
        ORDER BY
            post.date DESC
        ;";
        
        
        $result = $connexion->query($sql);

        return $result;
    }


    function select_recherche_blog($connexion, $recherche) {

        $sql = "SELECT
                    utilisateur.nom as nom,
                    utilisateur.prenom as prenom,
                    utilisateur.email as email
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


    // fonction page profil 

    function get_informations($connexion, $id) {

        $sql = "SELECT * FROM utilisateur WHERE id_utilisateur = '".$id."'";
        $result = $connexion->query($sql);

        return $result;
    }




    // fonctions page classement 

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
                    SUM(post.distance) as distance
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