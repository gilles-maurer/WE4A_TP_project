<!DOCTYPE html>
<html lang="fr">

<head>
<?php include("SousPages/header.php");?>
<title>Création / Modification post</title>
</head>

<body>

<!--
    C'est dans cette page que l'utilisateur
    peut créer/modifier un post.
-->

<?php include("SousPages/navbar.php");?>


<div id="MainContainer">

    <?php 

        require('SousPages/connexionbdd.php');
        $connexion = connect_db();

        // Si on vient pour modifier un post :
        $modif = isset($_POST["id_post_modif"]);
        if ($modif) {
            
            require('SousPages/sqlfunctions.php');

            $result  = get_post($connexion, $_POST["id_post_modif"]);
            $result = $result->fetch();

            /*
            On set les champs avec les valeurs du post
            pour que l'utilisateur n'ait pas à tout réécrire
            */

            $id_post = $result["ID_post"];
            $id_utilisateur = $result["ID_utilisateur"];
            $date = $result["date"];
            $distance = $result["distance"] / 1000;
            $temps = $result["temps"];
            $lieu = $result["lieu"];
            $description = $result["description"];

            echo "<h1> Modification d'un post </h1>";
            
        // Sinon, c'est qu'on vient pour une création de post
        } else {

            //On crée les variables pour la suite
            $id_post = "";
            $id_utilisateur = $_COOKIE["id_utilisateur"];
            $date = "";
            $distance = "";
            $temps = "";
            $lieu = "";
            $description = "";

            echo "<h1> Création d'un post </h1>";
        }
    
    ?> 

    <form action="SousPages/ajout_modif_post.php" method="post">

        <input type="hidden" name="modif" value="<?php echo $modif; ?>">
        <input type="hidden" name="id_post" value="<?php echo $id_post; ?>">
        <input type="hidden" name="id_utilisateur" value="<?php echo $id_utilisateur; ?>">

        <div>
            <label for="date">Date : </label>
            <input type="date" name="date" id="date" value="<?php echo $date; ?>" required>
        </div>
        <div>
            <label for="distance">Distance (en km) : </label>
            <input type="number" name="distance" id="distance" step="0.1" value="<?php echo $distance; ?>" required>
        </div>
        <div>
            <label for="temps">Durée (hh:mm) : </label>
            <input type="time" name="temps" id="temps" value="<?php echo $temps; ?>" required>
        </div>
        <div>
            <label for="lieu">Lieu : </label>
            <input type="text" name="lieu" id="lieu" value="<?php echo $lieu; ?>" required>
        </div>
        <div>
            <label for="description">Description : </label>
            <input name="description" id="description" value="<?php echo $description; ?>"></textarea>
        </div>
        <div>
            <input type="submit" value="Envoyer">
        </div>

    </form>

</div>


</body>

</html> 