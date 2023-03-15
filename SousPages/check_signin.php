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


?>