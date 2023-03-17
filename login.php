<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">
<title>Log-in</title>
<link rel="stylesheet" href="./Styles/style.css"> 
</head>

<body>

<?php include("SousPages/navbar.php");

$email = "";
$mdp = "";

if (isset($_POST["email"])){

    $email = $_POST["email"];
    $mdp = $_POST["mot_de_passe"];
    $mdp_5 = md5($_POST["mot_de_passe"]);
    //mdp est utilisé pour le form, mdp_5 est utilisé pour la connexion.

    require('SousPages/connectionbdd.php');
    $connection = connect_db();

    $sql = "SELECT * FROM utilisateur WHERE email='$email'"
    $result = $connection->query($sql);
    $res = $result->fetch();

    //Si l'adresse mail et le mot de passe correspondent
    if ($email = $res["email"] && $mdp_5 = $res["mot_de_passe"]){

        setcookie('id_utilisateur', $res['id_utilisateur'], time() + 24*3600);
        header('Location: ./blog.php');

    } else {
        ?><p class="warning">Le mot de passe et l'email ne correspondent pas.</p><?php
        $mdp = "";
    }

}


?>

    <form action="#" method="post">

        <div>
            <label for="email">E-Mail :</label>
            <input type="email" name="email" placeholder="email@addresse.fr" value=<?php echo $email;?> required>
        </div>

        <div>
            <label for="mot_de_passe">Mot de passe :</label>
            <input type="password" name="mot_de_passe" placeholder="Mot de passe" value=<?php echo $mdp;?> required>
        </div>

        <div>
            <button type="submit">Envoyer</button>
        </div>
        
    </form>

</body>

</html> 