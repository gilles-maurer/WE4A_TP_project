<!DOCTYPE html>
<html lang="fr">

<head>
<?php include("SousPages/header.php");?>
<title>Création Compte</title>
</head>

<body>

<?php include("SousPages/navbar.php");?>

<div id="MainContainer">

    <?php 

    //Puisque tous les champs sont en required, l'existence d'un suffit à prouver l'existence des autres.
    $condition = (isset($_POST['nom']));
    
    $nom = "";
    $prenom = "";
    $email = "";
    $mot_de_passe = "";
    $confirm = "";
    $date_naissance = "";

    $verif_email = false;
    $verif_mdp = false;
    $verif_image = false;

    if($condition){
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $email = $_POST["email"];
        $mot_de_passe = $_POST["mot_de_passe"];
        $confirm = $_POST["confirm"];
        $date_naissance = $_POST["date_naissance"];


        include('SousPages/uploadImage.php');
        

        require('SousPages/sqlfunctions.php');
        require('SousPages/connexionbdd.php');
        $connexion = connect_db();

        if (check_existing_email($connexion)) {
            //Si l'email est déjà pris
            $verif_email = true;
        } else if (!$uploadSuccessful) {
            //Si l'image n'est pas valide
            $verif_image = true;
        } else if(check_informations()) {
            //Si mdp et confirm ne correspondent pas
            $verif_mdp = true;
            $mot_de_passe = "";
            $confirm = "";
        } else {
            //Si tout est bon
            save_informations($connexion, $filePath); 
            set_id_session($connexion);

            setcookie("creation_compte", "true", time() + 24*3600); // on crée un cookie pour afficher une notification

            header('Location: ./index.php');
        
        }
    }?>

    <h1>Inscription :</h1>

    <form action="#" method="post" enctype="multipart/form-data">

        <div>
            <label for="nom">Nom :</label>
            <input type="text" name="nom" placeholder="Nom" value="<?php echo $nom;?>" required>
        </div>

        <div>
            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" placeholder="Prénom" value="<?php echo $prenom;?>" required>
        </div>

        <?php
        if ($verif_email){
            ?>
            <p class="warning">Cet email correspond à un compte déjà existant.</p>
            <?php
        }
        ?>

        <div>
            <label for="email">E-Mail :</label>
            <input type="email" name="email" placeholder="email@addresse.fr" value="<?php echo $email;?>" required>
        </div>

        <div>
            <label for="date_naissance">Date de naissance :</label>
            <input type="date" name="date_naissance" placeholder="JJ/MM/AAAA" value="<?php echo $date_naissance;?>" required>
        </div>

        <?php
        if ($verif_image){
            ?>
            <p class="warning"><?php echo $errorText ?></p>
            <?php
        }
        ?>

        <div>
            <input type="hidden" name="MAX_FILE_SIZE" value="5242880"/>
            <label for="img" >Ajouter une photo de profil: </label>
            <input type="file" name="img">
        </div>

        <?php
        if ($verif_mdp){
            ?>
            <p class="warning">Les deux mots de passe ne correspondent pas.</p>
            <?php
        }
        ?>

        <div>
            <label for="mot_de_passe">Mot de passe :</label>
            <input type="password" name="mot_de_passe" placeholder="Mot de passe" value="<?php echo $mot_de_passe;?>" required>
        </div>

        <div>
            <label for="confirm">Confirmer le mot de passe :</label>
            <input type="password" name="confirm" placeholder="Mot de passe" value="<?php echo $confirm;?>" required>
        </div>

        <div>
            <button type="submit">Envoyer</button>
        </div>
    </form>

    <hr>

    <p class="pcenter">Vous avez déjà un compte ? <a href="./login.php">Connectez-vous ici</a>.</p>
            
        
    <!--nom, prenom, email, mot_de_passe, date_naissance-->
</div>

</body>

</html> 