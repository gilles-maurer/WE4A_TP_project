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
    
        require('SousPages/check_signin.php');

        if(check_informations()) {

            require('SousPages/connectionbdd.php');
            $connection = connect_db();

            save_informations($connection); 
            set_id_session($connection);
            header('Location: ./blog.php');
        } else if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['mot_de_passe']) && isset($_POST['confirm']) && isset($_POST['date_naissance'])) {
        
            ?>  

            <h1>Inscription :</h1>

            <form action="#" method="post">

            <div>
                <label for="nom">Nom :</label>
                <input type="text" name="nom" placeholder="Nom" value="<?php echo $_POST['nom'];?>" required>
            </div>

            <div>
                <label for="prenom">Prénom :</label>
                <input type="text" name="prenom" placeholder="Prénom" value="<?php echo $_POST['prenom'];?>" required>
            </div>

            <div>
                <label for="email">E-Mail :</label>
                <input type="email" name="email" placeholder="email@addresse.fr" value="<?php echo $_POST['email'];?>" required>
            </div>

            <div>
                <label for="date_naissance">Date de naissance :</label>
                <input type="date" name="date_naissance" placeholder="JJ/MM/AAAA" value="<?php echo $_POST['date_naissance'];?>" required>
            </div>

            <div>
                <p class=error> Les mots de passe ne correspondent pas. </p>
            </div>

            <div>
                <label for="mot_de_passe">Mot de passe :</label>
                <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
            </div>

            <div>
                <label for="confirm">Confirmer le mot de passe :</label>
                <input type="password" name="confirm" placeholder="Mot de passe" required>
            </div>

            <div>
                <button type="submit">Envoyer</button>
            </div>
    </form>

    <hr>

    <p class="pcenter">Vous avez déjà un compte ? <a href="./login.php">Connectez-vous ici</a>.</p>
          
    <?php
        } else {
    ?>

    <h1>Inscription :</h1>

    <form action="#" method="post">

        <div>
            <label for="nom">Nom :</label>
            <input type="text" name="nom" placeholder="Nom" required>
        </div>

        <div>
            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" placeholder="Prénom" required>
        </div>

        <div>
            <label for="email">E-Mail :</label>
            <input type="email" name="email" placeholder="email@addresse.fr" required>
        </div>

        <div>
            <label for="date_naissance">Date de naissance :</label>
            <input type="date" name="date_naissance" placeholder="JJ/MM/AAAA" required>
        </div>

        <div>
            <label for="mot_de_passe">Mot de passe :</label>
            <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
        </div>

        <div>
            <label for="confirm">Confirmer le mot de passe :</label>
            <input type="password" name="confirm" placeholder="Confirmation" required>
        </div>

        <div>
            <button type="submit">Envoyer</button>
        </div>
    </form>

    <hr>

    <p class="pcenter">Vous avez déjà un compte ? <a href="./login.php">Connectez-vous ici</a>.</p>

    <?php } ?>

<!--nom, prenom, email, mot_de_passe, date_naissance-->
</div>

</body>

</html> 