<?php

    // fonctions page accueil

    function select_accueil_logout($connexion) {

        $sql = "SELECT * FROM post ORDER BY date DESC LIMIT 20";
        $result = $connexion->query($sql);

        return $result;
    }


    // fonctions page signin 

    function sign_in($connexion) {

        $sql = "INSERT INTO utilisateur 
        (nom, prenom, email, mot_de_passe, date_naissance, date_inscription) 
        VALUES 
        ('".$_POST['nom']."', '".$_POST['prenom']."', 
        '".$_POST['email']."', '".MD5($_POST['mot_de_passe'].)"', 
        '".$_POST['date_naissance']."', NOW())";
    
        $result = $connexion->query($sql);

        return $result; 
    }

    // fonctions page login

    function check_email($connexion) {

        $sql = "SELECT * FROM utilisateur WHERE email = '".$_POST['email']."'";
        $result = $connexion->query($sql);

        return $result;
    }

    function check_password($connexion) {

        $sql = "SELECT * FROM utilisateur WHERE mot_de_passe = '".MD5($_POST['mot_de_passe'])."'";
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

    function select_blog_10($connexion) {

        $sql = "SELECT * FROM post WHERE id_utilisateur = '".$_GET['id']."' ORDER BY date DESC LIMIT 10";
        $result = $connexion->query($sql);

        return $result;
    }

    function select_blog_20($connexion) {

        $sql = "SELECT * FROM post WHERE id_utilisateur = '".$_GET['id']."' ORDER BY date DESC LIMIT 20";
        $result = $connexion->query($sql);

        return $result;
    }

    function select_blog($connexion) {

        $sql = "SELECT * FROM post WHERE id_utilisateur = '".$_GET['id']."' ORDER BY date DESC";
        $result = $connexion->query($sql);

        return $result;
    }

    


?>