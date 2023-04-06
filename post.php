<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">
<title>Création / Modification post</title>
<link rel="stylesheet" href="./Styles/style.css"> 
</head>

<body>

<?php include("SousPages/navbar.php");?>


<div id="MainContainer">

    <?php 

        require('SousPages/connectionbdd.php');
        $connection = connect_db();

        if (isset($_POST["id_post_modif"])) {
            $modif = true; // on vient pour modifier un post
        } else {
            $modif = false; // on vient pour créer un post
        }

        if ($modif) { // on vient pour modifier un post 
            
            require('SousPages/sqlfunctions.php');

            $result  = get_post($connection, $_POST["id_post_modif"]);

            $result = $result->fetch();

            $id_post = $result["ID_post"];
            $id_utilisateur = $result["ID_utilisateur"];
            $date = $result["date"];
            $distance = $result["distance"];
            $temps = $result["temps"];
            $lieu = $result["lieu"];
            $description = $result["description"];

            echo "<h2> Modification d'un post </h2>";
            
        } else {
            $id_post = "";
            $id_utilisateur = $_COOKIE["id_utilisateur"];
            $date = "";
            $distance = "";
            $temps = "";
            $lieu = "";
            $description = "";

            echo "<h2> Création d'un post </h2>";
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
        <label for="distance">Distance (en m) : </label>
        <input type="number" name="distance" id="distance" value="<?php echo $distance; ?>" step="1000" required>
        </div>
        <div>
        <label for="temps">Durée : </label>
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