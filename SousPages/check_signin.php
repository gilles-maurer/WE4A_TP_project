<?php

    function check_informations() {

        //Puisque tous les champs sont en required, isset(nom) permet de s'assurer que les champs sont remplis.
        //Si la condition est vérifiée, dans ce cas la fonction return false
        //  et la boucle IF dans laquelle la fonction est utilisée n'est pas traversée.
        return !(isset($_POST['nom']) && ($_POST['mot_de_passe'] == $_POST['confirm']));

    }


    function check_existing_email($connection){
        $email = $_POST["email"];
        $email = str_replace("'", "\'", $email);

        $sql = "SELECT COUNT(*) as nb_utilisateur FROM utilisateur WHERE email='$email'";

        $result = $connection->query($sql);

        $res = $result->fetch();

        return $res["nb_utilisateur"]!=0;
        //Si la fonction return false, ça veut dire que l'email n'est pas utilisé.
    }


    function save_informations($connection) { 

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
                        (nom, prenom, email, mot_de_passe, date_naissance, date_inscription) 
                VALUES 
                        ('$nom', '$prenom', '$email', '$mot_de_passe', '$date_naissance', '$date_inscription')";
    
        $result = $connection->query($sql);

        return $result;
    }

    function set_id_session($connection) {

        $nom = $_POST['nom'];
        $nom = str_replace("'", "\'", $nom);

        $prenom = $_POST['prenom'];
        $prenom = str_replace("'", "\'", $prenom);

        $email = $_POST['email'];
        $email = str_replace("'", "\'", $email);
        
        $sql = "SELECT id_utilisateur FROM utilisateur WHERE nom = '$nom' AND prenom = '$prenom' AND email = '$email'";

        $result = $connection->query($sql);

        $row = $result->fetch();

        setcookie('id_utilisateur', $row['id_utilisateur'], time() + 24*3600);

        return $result;
    }

?>