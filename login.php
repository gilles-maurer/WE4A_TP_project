<!DOCTYPE html>
<html lang="fr">

<head>
<?php include("SousPages/header.php");?>
<title>Log-in</title>
</head>

<script> 

    function ShowHidePassword(icone){
		var field = document.getElementById("mot_de_passe");
		
        if (field.type == "password"){ // Si le type est password, on change en text
			icone.src="./Icones/password_show.png";
			field.type="text";
		}
		else { // Sinon, on change en password
			icone.src="./Icones/password_hide.png";
			field.type="password";
		}

	}

</script>

<body>

<?php include("SousPages/navbar.php");?>

<div id="MainContainer">
<h1>Connexion :</h1>

<?php $email = "";
$mdp = "";

if (isset($_POST["email"])){

    $email = $_POST["email"];
    $email = str_replace("'", "\'", $email); 


    $mdp = $_POST["mot_de_passe"];
    $mdp_5 = md5($_POST["mot_de_passe"]);
    //mdp est utilisé pour le form, mdp_5 est utilisé pour la connexion.

    require('SousPages/connexionbdd.php');
    $connexion = connect_db();

    require('SousPages/sqlfunctions.php');
    $result = check_login($connexion, $email);

    $res = $result->fetch();

    if ($result->rowCount() != 0){
        //Si l'adresse mail et le mot de passe correspondent
        if ($email == $res["email"] && $mdp_5 == $res["mot_de_passe"]){

            setcookie("id_utilisateur", $res["ID_utilisateur"], time() + 24*3600);
            header('Location: ./blog.php');
            

        } else {
            ?><p class="warning">Le mot de passe et l'email ne correspondent pas.</p><?php
            $mdp = "";
        }
    } else {
        ?><p class="warning">L'email n'existe pas.</p><?php
        $mdp = "";
    }
}


?>

    <form action="#" method="post">

        <!-- Afin de centrer l'icône pour cacher le mot de passe,
        il faut ajouter ces divisions. Comme ça, tout est au même niveau. -->
        <div class='box-left'>
            <div class='boxtext'>
                <label for="email">E-Mail :</label>
                <input type="email" name="email" id="email" placeholder="email@addresse.fr" value="<?php echo $email;?>" required>
            </div>
        </div>
        <div class='box-left'>
            <div class='boxtext'>
                <label for="mot_de_passe">Mot de passe :</label>
                <input type="password" name="mot_de_passe" id="mot_de_passe" placeholder="Mot de passe" value="<?php echo $mdp;?>" required>
            </div>
            <div class='boximage'>
                <img id="passHide" onclick="ShowHidePassword(this)"
                    src="./Icones/password_hide.png" alt="Hide/Show password">
            </div>
        </div>

        <div class='box-left'><div class='boxtext'>
            <button type="submit">Envoyer</button>
        </div></div>
        
    </form>
</div>
</body>

</html> 