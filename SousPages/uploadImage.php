<?php

function IsFileAdequate() {

    $result = array(
        'errorText' => "",
        'no_file' => false
    );

    if  ($_FILES['img']['size'] != 0 ){ // regarde si l'image est vide
        if($_FILES['img']['size'] > $_POST['MAX_FILE_SIZE']) { // regarde si l'image est trop grosse
            $result['errorText'] = "Fichier trop grand! Respectez la limite de 5Mo.";
        }
        // regarde si l'image est du bon type
        elseif($_FILES['img']['type'] == "image/jpeg" || $_FILES['img']['type'] == "image/png"){ 
            $result['errorText'] = "";
        }
        else {
            $result['errorText'] = "Type de fichier non accepté! Images JPG et PNG seulement.";
        }
    }
    else {
        $result['no_file'] = true;
    }

    return $result;

}


function SaveFileAsNew($errorText) {

    $result = array(
        'errorText' => $errorText,
        'file_path' => "", 
        'upload_successful' => false
    );

    if ($result["errorText"] == "") { // si l'image est valide

        $file = $_FILES['img']['name'];
        $path = pathinfo($file); //permet d'analyser l'image et d'obtenir des choses comme son extension
        $ext = $path['extension'];

        $temp_name = $_FILES['img']['tmp_name'];

        // creation du nouveau nom de l'image + chemin + extension
        $new_filename = uniqid() . "_" . $_POST['nom']; // uniqid() permet de generer un id unique
        $path_filename_ext = "./Icones/Avatars/" .$new_filename.".".$ext;

        // regarde si l'image existe deja (normalement pas)
        if ( file_exists($path_filename_ext) ) {

            $result["errorText"] = "Error, somehow the file already exists";

        } else {

            move_uploaded_file($temp_name,$path_filename_ext);

            $result["file_path"] = $path_filename_ext;
            $result["upload_successful"] = true;
        
        }

    }

    return $result;

}

function SaveDefaultImage($errorText) {


}




$result_isFileAdequate = IsFileAdequate();



if ($result['no_file']) {
    $errorText = SaveFileAsNew($errorText);
} else if ($errorText == "No file or file size = 0") {
    $errorText = SaveDefaultImage($errorText);
}







?>