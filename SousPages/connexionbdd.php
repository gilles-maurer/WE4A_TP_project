<?php 
    define('USER', "root");
    define('PASSWD', "root");
    define('SERVER', "localhost");
    define('BASE', "RunShare"); 

    function connect_db() {

        $dsn = "mysql:dbname=".BASE.";host=".SERVER; 

        // On essaye de se connecter à la base de données avec les identifiants ci-dessus (UwAmp).
        try{ 
            $conn = new PDO($dsn, USER, PASSWD);
        }

        // Si ça ne marche pas, on essaye de se connecter sans mot de passe (XAMPP).
        catch(PDOException $e){ 
            try{
                $conn = new PDO($dsn, USER, "");
            }

            //Sinon, c'est qu'il y a une erreur.
            catch(PDOException $e){
                printf("Echec de connexion : %s\n", $e->getMessage());
                exit(); 
            }
        }
        return $conn;
    }
?>