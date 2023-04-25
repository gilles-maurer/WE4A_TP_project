<?php

    function check_informations() {

        //Puisque tous les champs sont en required, isset(nom) permet de s'assurer que les champs sont remplis.
        //Si la condition est vérifiée, dans ce cas la fonction return false
        //  et la boucle IF dans laquelle la fonction est utilisée n'est pas traversée.
        return !(isset($_POST['nom']) && ($_POST['mot_de_passe'] == $_POST['confirm']));

    }


    function check_existing_email($connexion){
        $email = $_POST["email"];
        $email = str_replace("'", "\'", $email);

        $sql = "SELECT COUNT(*) as nb_utilisateur FROM utilisateur WHERE email='$email'";

        $result = $connexion->query($sql);

        $res = $result->fetch();

        return $res["nb_utilisateur"]!=0;
        //Si la fonction return false, ça veut dire que l'email n'est pas utilisé.
    }


    // Cette fonction est appelée dans le fichier signin.php
    // Elle permet d'insérer les informations de l'utilisateur dans la base de données

    function save_informations($connexion, $avatar) { 

        $nom = $_POST['nom'];
        $nom = str_replace("'", "\'", $nom);

        $prenom = $_POST['prenom'];
        $prenom = str_replace("'", "\'", $prenom);

        $email = $_POST['email'];
        $email = str_replace("'", "\'", $email);

        $mot_de_passe = md5($_POST['mot_de_passe']); // md5 ne renvoir pas de ' donc pas besoin de str_replace

        $date_naissance = $_POST['date_naissance'];
        $date_inscription = date("Y-m-d");

        $sql = "INSERT INTO utilisateur 
                        (nom, prenom, email, mot_de_passe, date_naissance, date_inscription, avatar) 
                VALUES 
                        ('$nom', '$prenom', '$email', '$mot_de_passe', '$date_naissance', '$date_inscription', '$avatar')";
    
        $result = $connexion->query($sql);

        return $result;
    }

    // Cette fonction est appelée dans le fichier signin.php
    // Elle permet de créer un cookie qui contient l'id de l'utilisateur 

    function set_id_session($connexion) {

        $nom = $_POST['nom'];
        $nom = str_replace("'", "\'", $nom);

        $prenom = $_POST['prenom'];
        $prenom = str_replace("'", "\'", $prenom);

        $email = $_POST['email'];
        $email = str_replace("'", "\'", $email);
        
        $sql = "SELECT id_utilisateur FROM utilisateur WHERE nom = '$nom' AND prenom = '$prenom' AND email = '$email'";

        $result = $connexion->query($sql);

        $row = $result->fetch();

        setcookie('id_utilisateur', $row['id_utilisateur'], time() + 24*3600);

    }

?>