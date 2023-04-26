<?php 
    define('USER', "root");
    define('PASSWD', "root");
    define('SERVER', "localhost");
    define('BASE', "RunShare"); 

    function connect_db() {

        $dsn = "mysql:dbname=".BASE.";host=".SERVER; 

        try{ // essaye de se connecter à la base de données avec les identifiants ci-dessus
            $conn = new PDO($dsn, USER, PASSWD);
        }
        catch(PDOException $e){ // si ça ne marche pas, on essaye de se connecter sans mot de passe
            try{
                $conn = new PDO($dsn, USER, "");
            }
            catch(PDOException $e){
                printf("Echec de connexion : %s\n", $e->getMessage());
                exit(); 
            }
        }
        return $conn;
    }
?>