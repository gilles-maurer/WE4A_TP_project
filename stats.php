<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">
<title>Statistiques</title>
<link rel="stylesheet" href="./Styles/style.css"> 
</head>

<body>

<?php include("SousPages/navbar.php");?>

<?php
    if(isset($_POST['id_utilisateur'])) {
        // delete cookie
        setcookie('id_utilisateur');
        header('Location: ./index.php');
    }

?>
    <h2> Mon profil </h2>

    <?php
    require("SousPages/connectionbdd.php");
    $connection = connect_db(); 

    require ("SousPages/sqlfunctions.php");

    $id = $_COOKIE['id_utilisateur'];

    $result = get_informations($connection, $id);

    $row = $result->fetch();

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




    ?>

    <!-- T'en fait ce que tu veux de ce form mdr  -->
    <div>

        <form action='#' method='post'>
            
            <div>
                <!-- Caché -->
                <input type="hidden" name="id_utilisateur" value="<?php echo $id; ?>">
            </div>
            <div>
                <button type="submit">Se déconnecter</button>
            </div>
        </form>

    </div>

</body>

</html> 