<?php

// renvoie les informations d'un post en fonction de son id

function get_post($connexion, $id_post) {
    
    $sql = "SELECT * FROM post WHERE id_post = ".$id_post.";";

    $result = $connexion->query($sql);

    return $result;
}


// modifie les informations d'un post en fonction de son id

function update_post($connexion, $id_post, $id_utilisateur, $date, $distance, $temps, $lieu, $description) {

    $sql = "UPDATE 
                post
            SET 
                ID_utilisateur = '".$id_utilisateur."',
                date = '".$date."',
                distance = '".$distance."',
                temps = '".$temps."',
                lieu = '".$lieu."',
                description = '".$description."' 
            WHERE 
                id_post = ".$id_post.";";

    $connexion->query($sql);

}

// ajoute un post dans la base de données

function insert_post($connexion, $id_utilisateur, $date, $distance, $temps, $lieu, $description) {

    $sql = "INSERT INTO 
                post (ID_utilisateur, date, distance, temps, lieu, description)
            VALUES 
                ('".$id_utilisateur."', '".$date."', '".$distance."', '".$temps."', '".$lieu."', '".$description."');";

    $connexion->query($sql);

}


// supprime un post, ses likes et ses commentaires en fonction de son id

function delete_post($connexion, $id_post) {

    $sql = "DELETE FROM liker WHERE id_post = '".$id_post."';";
    $connexion->query($sql);

    $sql = "DELETE FROM commentaire WHERE id_post = '".$id_post."';";
    $connexion->query($sql);

    $sql = "DELETE FROM post WHERE id_post = '".$id_post."';";
    $connexion->query($sql);

}

?>
