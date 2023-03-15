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


    <h1>Inscription :</h1>


    <form action="#" method="post">

        <div>
            <label for="nom">Nom :</label>
            <input type="text" name="nom" placeholder="Nom">
        </div>

        <div>
            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" placeholder="Prénom">
        </div>

        <div>
            <label for="email">E-Mail :</label>
            <input type="email" name="email" placeholder="email@addresse.fr">
        </div>

        <div>
            <label for="date_naissance">Date de naissance :</label>
            <input type="date" name="date_naissance" placeholder="JJ/MM/AAAA">
        </div>

        <div>
            <label for="mot_de_passe">Mot de passe :</label>
            <input type="password" name="mot_de_passe" placeholder="Mot de passe">
        </div>

        <div>
            <label for="confirm">Confirmer le mot de passe :</label>
            <input type="password" name="confirm" placeholder="Confirmation">
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