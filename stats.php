<!DOCTYPE html>
<html lang="fr">

<head>
<?php include("SousPages/header.php");?>
<title>Profil</title>
</head>

<body>

<?php include("SousPages/navbar.php");?>
<div id="MainContainer">
    <?php
        //Pour la déconnexion : setcookie sans durée
        if(isset($_POST['deconnexion'])) {
            setcookie('id_utilisateur'); // delete cookie
            header('Location: ./index.php');
        }

    ?>
        <h1> Mon profil </h1>

        <?php
        require("SousPages/connexionbdd.php");
        $connexion = connect_db(); 

        require ("SousPages/sqlfunctions.php");

        $id = $_COOKIE['id_utilisateur'];
        
        echo "<h2> Mes informations </h2>";

        $result = get_informations($connexion, $id);

        $row = $result->fetch();

        date_default_timezone_set("Europe/Paris"); //Ligne à inclure, sinon erreur dans la ligne suivante
        $date = new DateTime($row['date_naissance']);
        $date_actuelle = new DateTime();
        $age = $date->diff($date_actuelle);


        /* =============================================================
        =================== Informations Utilisateur ===================
        ============================================================= */
        echo "<p> Nom : ".$row['nom']."</p>
            <p> Prénom : ".$row['prenom']."</p>
            <p> Email : ".$row['email']."</p>
            <p> Date de naissance : ".$row['date_naissance']."</p>
            <p> Age : ".$age->y."</p>
            <p> Date d'inscription : ".$row['date_inscription']."</p>";



        echo "<br>";
        $id_stats = $id; 
        include("SousPages/show_stats.php");
    


        /* =============================================================
        ========================== Abonnements =========================
        ============================================================= */
        echo "<hr>";
        echo "<h2> Mes abonnements </h2>";

        $result = get_abonnement($connexion, $id);


        while($row = $result->fetch()) {
            $id_suivie = $row['ID_suivie'];
            $result2 = get_informations($connexion, $id_suivie);
            $row2 = $result2->fetch();

            echo "<div class='box-invisible'>
                    <form action='blog.php'>
                        <input type='hidden' name='blog' value='".$row['ID_suivie']."'>
                        <button type='submit'>".$row2['nom']." ".$row2['prenom']."</button>
                    </form>
                </div>";  
               //On ajoute un div à chaque itération pour être sûr que chaque bouton est séparé du précédent
        }




        /* =============================================================
        ============================ Abonnés ===========================
        ============================================================= */
        echo "<hr>";
        echo "<h2> Mes abonnés </h2>";

        $result = get_abonne($connexion, $id);

        echo "";

        while($row = $result->fetch()) {
            $id_suiveur = $row['ID_suiveur'];
            $result2 = get_informations($connexion, $id_suiveur);
            $row2 = $result2->fetch();

            echo "<div class='box-invisible'>
                    <form action='blog.php'>
                        <input type='hidden' name='blog' value='".$row['ID_suiveur']."'>
                        <button type='submit'>".$row2['nom']." ".$row2['prenom']."</button>
                    </form><br>
                </div>";          
            
            }
        ?>



        <!-- Bouton déconnexion -->
        <hr>
        <div>
            <form action='#' method='post'>
                
                <div>
                    <input type="hidden" name="deconnexion" value="<?php echo $id; ?>">
                </div>
                <div>
                    <button type="submit">Se déconnecter</button>
                </div>
            </form>

        </div>

            <form action="SousPages/delete_account.php" 
                    onsubmit="return confirm('Etes-vous sur de vouloir supprimer votre compte (cette action est définitive) ?')" 
                    method='post'>
                <input type='hidden' name='id_utilisateur' value='<?php echo $id;?>'>
                <input type='submit' value='Supprimer'>
            </form>

        <div>


        </div>

    </div>
</body>

</html> 