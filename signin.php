<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">
<title>Création Compte</title>
<link rel="stylesheet" href="./Styles/style.css"> 
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

    if($condition){
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $email = $_POST["email"];
        $mot_de_passe = $_POST["mot_de_passe"];
        $confirm = $_POST["confirm"];
        $date_naissance = $_POST["date_naissance"];
    

        require('SousPages/check_signin.php');
        require('SousPages/connexionbdd.php');
        $connexion = connect_db();

        if (check_existing_email($connexion)) {
            //Si l'email est déjà pris
            $verif_email = true;
        } else if(check_informations()) {
            //Si mdp et confirm ne correspondent pas
            $verif_mdp = true;
            $mot_de_passe = "";
            $confirm = "";
        } else {
            //Si tout est bon
            save_informations($connexion); 
            set_id_session($connexion);
            header('Location: ./index.php');
        }
    }?>

    <h1>Inscription :</h1>

    <form action="#" method="post">

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