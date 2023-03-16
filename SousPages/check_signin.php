<?php

    function check_informations() {
        if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['mot_de_passe']) && isset($_POST['confirm']) && isset($_POST['date_naissance'])) {
            if ($_POST['mot_de_passe'] == $_POST['confirm']) {
                return true;                    
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    function save_informations($connection) { 

        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $mot_de_passe = md5($_POST['mot_de_passe']);
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
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        
        $sql = "SELECT id_utilisateur FROM utilisateur WHERE nom = '$nom' AND prenom = '$prenom' AND email = '$email'";

        $result = $connection->query($sql);

        $row = $result->fetch();

        setcookie('id_utilisateur', $row['id_utilisateur'], time() + 24*3600);

        return $result;
    }

?>