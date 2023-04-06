<?php


function get_post($connexion, $id_post) {
    
    $sql = "SELECT * FROM post WHERE id_post = ".$id_post.";";

    $result = $connexion->query($sql);

    return $result;
}


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


function insert_post($connexion, $id_utilisateur, $date, $distance, $temps, $lieu, $description) {

    $sql = "INSERT INTO 
                post (ID_utilisateur, date, distance, temps, lieu, description)
            VALUES 
                ('".$id_utilisateur."', '".$date."', '".$distance."', '".$temps."', '".$lieu."', '".$description."');";

    $connexion->query($sql);

}


function delete_post($connexion, $id_post) {

    $sql = "DELETE FROM post WHERE id_post = '".$id_post."';";

    $connexion->query($sql);

}

?>
