<!DOCTYPE html>
<html lang="fr">

<head>
<?php include("SousPages/header.php");?>
<title>Profil</title>
</head>

<!--
    Cette page est la page de profil,
    qui contient :
        - Les informations de l'utilisateur (nom, mail, etc)
        - Les personnes que l'utilisateur suit
        - Les personnes qui suivent l'utilisateur
        - L'option de se déconnecter ou supprimer son compte
-->

<body>

<?php include("SousPages/navbar.php");?>
<div id="MainContainer">
    <?php
    //Pour la déconnexion : setcookie sans durée (supprime le cookie).
    if(isset($_POST['deconnexion'])) {
        setcookie('id_utilisateur');
        header('Location: ./index.php');
    }

    ?>
    <h1> Mon profil </h1>

    <?php

    require("SousPages/connexionbdd.php");
    $connexion = connect_db(); 
    require ("SousPages/sqlfunctions.php");

    $id = $_COOKIE['id_utilisateur'];

    $result = get_informations($connexion, $id);
    $row = $result->fetch();

    //On calcule l'âge en fonction de la date de naissance.
    date_default_timezone_set("Europe/Paris"); //Ligne à inclure, sinon erreur dans la ligne suivante.
    $date = new DateTime($row['date_naissance']);
    $date_actuelle = new DateTime();
    $age = $date->diff($date_actuelle);

    //On prépare l'affichage de l'avatar.
    $max = 128;
    list($width, $height, $type, $attr) = getimagesize($row["avatar"]);
    include("SousPages/calcul_image_size.php");





    /* =============================================================
    =================== Informations Utilisateur ===================
    ============================================================= */

    echo "
        <h2> Mes informations </h2>

        <img src='".$row["avatar"]."' class=avatar height='".$height."' width='".$width."' >

        <p><strong> Nom : </strong> ".$row['nom']."</p>
        <p><strong> Prénom : </strong> ".$row['prenom']."</p>
        <p><strong> Email : </strong> ".$row['email']."</p>
        <p><strong> Date de naissance : </strong> ".$row['date_naissance']."</p>
        <p><strong> Age : </strong> ".$age->y."</p>
        <p><strong> Date d'inscription : </strong> ".$row['date_inscription']."</p>
        <br>";

    $id_stats = $id; //On renomme pour le include qui suit.
    include("SousPages/show_stats.php");




    /* =============================================================
    ========================== Abonnements =========================
    ============================================================= */

    echo "<hr>";
    echo "<h2> Mes abonnements </h2>";

    $result = get_abonnement($connexion, $id);

    //On affiche les boutons des personnes
    while($row_abonnement = $result->fetch()) {
        $id_suivie = $row_abonnement['ID_suivie'];
        $result2 = get_informations($connexion, $id_suivie);
        $row = $result2->fetch();

        include("SousPages/bouton_profil.php");

    }




    /* =============================================================
    ============================ Abonnés ===========================
    ============================================================= */

    echo "<hr>";
    echo "<h2> Mes abonnés </h2>";

    $result = get_abonne($connexion, $id);

    //On affiche les boutons des personnes
    while($row_abonne = $result->fetch()) {

        $id_suiveur = $row_abonne['ID_suiveur'];
        $result2 = get_informations($connexion, $id_suiveur);
        $row = $result2->fetch();

        include("SousPages/bouton_profil.php");       
        
        }
    
    
    
    
    
    
    /* =============================================================
    ============== Déconnexion, suppression du compte ==============
    ============================================================= */
    ?>

    <hr>
    <div class='box-invisible'>
        <div class='boxtext'>
            <form action='#' method='post'>
                <input type="hidden" name="deconnexion" value="<?php echo $id; ?>">
                <button type="submit">Se déconnecter</button>
            </form>

        </div>
        <div class='boxtext'>

            <form action='delete_account.php' 
                    onsubmit="return confirm('Etes-vous sur de vouloir supprimer votre compte (cette action est définitive) ?')" 
                    method='post'>
                <input type='hidden' name='id_utilisateur' value='<?php echo $id;?>'>
                <input type='submit' value='Supprimer mon compte'>
            </form>

        </div>


    </div>

</div>
</body>

</html> 