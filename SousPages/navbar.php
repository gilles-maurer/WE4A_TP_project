
<?php 

// check si il y a des cookies 
if (!isset($_COOKIE['email']) && !isset($_COOKIE['mot_de_passe'])) {
    // si il n'y a pas de cookies, on affiche le bandeau sans log
    ?> 
        <div class="navbar">
            <a href="./index.php">Accueil</a>
            <a href="./blog.php">Blog</a>
            <a href="./classement.php">Classement</a>
            <a href="./signin.php">Sign In</a>
            <a href="./login.php">Log In</a>
        </div>
    <?php
} else {
    // si il y a des cookies, on affiche le bandeau avec log
    ?> 
        <div class="navbar">
            <a href="./index.php">Accueil</a>
            <a href="./blog.php">Blog</a>
            <a href="./classement.php">Classement</a>
            <a href="./post.php">Poster</a>
            <a href="./stats.php">Profil</a>

        </div>
    <?php
}

?>

