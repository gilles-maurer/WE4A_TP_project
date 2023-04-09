<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">
<title>Statistiques</title>
<link rel="stylesheet" href="./Styles/style.css"> 
</head>

<body>

<?php include("SousPages/navbar.php");?>
<div id="MainContainer">
    <?php
        if(isset($_POST['id_utilisateur'])) {
            // delete cookie
            setcookie('id_utilisateur');
            header('Location: ./index.php');
        }

    ?>
        <h1> Mon profil </h1>

        <?php
        require("SousPages/connectionbdd.php");
        $connection = connect_db(); 

        require ("SousPages/sqlfunctions.php");

        $id = $_COOKIE['id_utilisateur'];
        
        echo "<h2> Mes informations </h2>";

        $result = get_informations($connection, $id);

        $row = $result->fetch();

        date_default_timezone_set("Europe/Paris"); //Ligne à inclure, sinon erreur dans la ligne suivante
        $date = new DateTime($row['date_naissance']);
        $date_actuelle = new DateTime();
        $age = $date->diff($date_actuelle);

        // affiche les informations de l'utilisateur

        echo "<p> Nom : ".$row['nom']."</p>";
        echo "<p> Prénom : ".$row['prenom']."</p>";
        echo "<p> Email : ".$row['email']."</p>";
        echo "<p> Date de naissance : ".$row['date_naissance']."</p>";
        echo "<p> Age : ".$age->y."</p>";
        echo "<p> Date d'inscription : ".$row['date_inscription']."</p>";


        echo "<h2> Mes abonnements </h2>";

        $result = get_abonnement($connection, $id);

        while($row = $result->fetch()) {
            $id_suivie = $row['id_suivie'];
            $result2 = get_informations($connection, $id_suivie);
            $row2 = $result2->fetch();
            echo "<p> Nom : ".$row2['nom']."</p>";
            echo "<p> Prénom : ".$row2['prenom']."</p>";
            echo "<p> Email : ".$row2['email']."</p>";
            echo "<p> Date de naissance : ".$row2['date_naissance']."</p>";
            echo "<p> Date d'inscription : ".$row2['date_inscription']."</p>";
        }


        echo "<h2> Mes abonnés </h2>";

        $result = get_abonne($connection, $id);

        while($row = $result->fetch()) {
            $id_suiveur = $row['id_suiveur'];
            $result2 = get_informations($connection, $id_suiveur);
            $row2 = $result2->fetch();
            echo "<p> Nom : ".$row2['nom']."</p>";
            echo "<p> Prénom : ".$row2['prenom']."</p>";
            echo "<p> Email : ".$row2['email']."</p>";
            echo "<p> Date de naissance : ".$row2['date_naissance']."</p>";
            echo "<p> Date d'inscription : ".$row2['date_inscription']."</p>";
        }


        ?>

        <!-- bouton déconnexion -->

        <div>
            <form action='#' method='post'>
                
                <div>
                    <input type="hidden" name="id_utilisateur" value="<?php echo $id; ?>">
                </div>
                <div>
                    <button type="submit">Se déconnecter</button>
                </div>
            </form>

        </div>

    </div>
</body>

</html> 