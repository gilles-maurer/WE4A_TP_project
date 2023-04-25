<?php

function IsFileAdequate() {

    // tableau de retour
    $result = array(
        'errorText' => "",
        'no_file' => false,
        'file_adequate' => false
    );

    if  ($_FILES['img']['size'] != 0 ){ // regarde si l'image est vide
        if($_FILES['img']['size'] > $_POST['MAX_FILE_SIZE']) { // regarde si l'image est trop grosse
            $result['errorText'] = "Fichier trop grand! Respectez la limite de 5Mo.";
        }
        // regarde si l'image est du bon type
        elseif($_FILES['img']['type'] == "image/jpeg" || $_FILES['img']['type'] == "image/png"){ 
            $result['file_adequate'] = true;
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


function SaveFileAsNew() {

    // tableau de retour
    $result = array(
        'errorText' => "",
        'file_path' => "", 
        'upload_successful' => false
    );


    $file = $_FILES['img']['name'];
    $path = pathinfo($file); //permet d'analyser l'image et d'obtenir des choses comme son extension
    $ext = $path['extension'];

    $temp_name = $_FILES['img']['tmp_name'];

    // creation du nouveau nom de l'image + chemin + extension
    $new_filename = uniqid() . "_" . $_POST['nom']; // uniqid() permet de generer un id unique

    // on sécurise le nom de l'image
    $new_filename = str_replace(" ", "_", $new_filename); // remplace les espaces par des _
    $new_filename = str_replace("'", "_", $new_filename); // remplace les apostrophes par des _
    $new_filename = str_replace("\"", "_", $new_filename); // remplace les \ par des _
    
    
    $path_filename_ext = "./Icones/Avatars/" .$new_filename.".".$ext;

    // regarde si l'image existe deja (normalement pas)
    if ( file_exists($path_filename_ext) ) {

        $result["errorText"] = "Error, somehow the file already exists";

    } else {

        move_uploaded_file($temp_name,$path_filename_ext);

        $result["file_path"] = $path_filename_ext;
        $result["upload_successful"] = true;
    
    }


    return $result;

}


$result_isFileAdequate = IsFileAdequate();


if ($result_isFileAdequate['no_file']) {
    
    $errorText = ""; 
    $uploadSuccessful = true;
    $filePath = "./Icones/Avatars/default.png";


} else if ($result_isFileAdequate['file_adequate']) {
    
    $result_SaveFile = SaveFileAsNew();
        
    $errorText = $result_SaveFile['errorText'];
    $uploadSuccessful = $result_SaveFile['upload_successful'];
    $filePath = $result_SaveFile['file_path'];

} else {
    $errorText = $result_isFileAdequate['errorText'];
    $uploadSuccessful = false;
    $filePath = "";
} 








?>