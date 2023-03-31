<?php 
    define('USER', "root");
    define('PASSWD', "root");
    define('SERVER', "localhost");
    define('BASE', "RunShare"); 

    function connect_db() {

        $dsn = "mysql:dbname=".BASE.";host=".SERVER;

        try{
            $conn = new PDO($dsn, USER, PASSWD);
        }
        catch(PDOException $e){
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