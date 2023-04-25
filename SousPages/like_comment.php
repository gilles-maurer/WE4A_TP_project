<?php

/*
Divs présents en arrivant dans ce fichier :

blog.php:
<div row>
    <div column main>

        contenu_blog.php :
        <div row>
            <div column third no bg>
                <div box invisible>
                    <div boximage>


*/

/*========================================================================
================================== Liker =================================
========================================================================*/

if (isset($_COOKIE['id_utilisateur'])) {

    $is_like = is_like($connexion, $row['id_post'], $_COOKIE['id_utilisateur']);
    $is_like = $is_like->fetch();    

    if ($is_like['nb_like'] == 0) {
        echo "
                        <form action='SousPages/like.php' method='post'>
                            <input type='hidden' name='id_post' value='".$row['id_post']."'>
                            <input type='hidden' name='id_utilisateur' value='".$_COOKIE['id_utilisateur']."'>
                            <input type='hidden' name='path' value='".$path."'>
                            <input type='image' src='./Icones/running.png' height='32px' width='32px'  alt='Like' title='Like'>
                        </form>";
    } else {
        echo "
                        <form action='SousPages/like.php' method='post'>
                            <input type='hidden' name='id_post' value='".$row['id_post']."'>
                            <input type='hidden' name='id_utilisateur' value='".$_COOKIE['id_utilisateur']."'>
                            <input type='hidden' name='path' value='".$path."'>
                            <input type='image' src='./Icones/running_clicked.png' height='32px' width='32px'  alt='Unlike' title='Unlike'>
                        </form>"; 
    }
}
echo "
                    </div>
                </div>";//</div> order: boximage, box (column-third et row sont arrêtés dans formulaire commentaire)





/*========================================================================
========================= Envoyer un commentaire =========================
========================================================================*/

/*
Divs présents en arrivant ici :

blog.php:
<div row>
    <div column main>

        contenu_blog.php :
        <div row>
            <div column third no bg>*/

if (isset($_COOKIE['id_utilisateur'])) {
    echo "
                <form action='SousPages/comment.php' method='post'>
                    <div class='box-left'>
                        <div class='boxtext'>
                            <input type='hidden' name='id_post' value='".$row['id_post']."'>
                            <input type='hidden' name='id_utilisateur' value='".$_COOKIE['id_utilisateur']."'>
                            <input type='hidden' name='path' value='".$path."'>
                            <input type='text' name='texte' placeholder='Un petit commentaire ?'>
                        </div>
                        <div class='boximage'>
                            <input type='image' src='./Icones/chat.png' height='32px' width='32px'  alt='Envoyer le commentaire' title='Envoyer le commentaire'>
                        </div>
                    </div>
                </form>"; //Les divs sont là pour que la zone de texte et l'icône soient côte à côte
        
}
echo "
            </div>
            <div class='boxtext'></div>
        </div>"; //column third puis row
        //boxtext est là juste pour "prendre plus de place"




/*========================================================================
========================= Lister les commentaires ========================
========================================================================*/

/*    
blog.php:
<div row>
    <div column main>*/

$comments = find_comments($connexion, $row['id_post']);

while ($comment = $comments->fetch()) {

    echo "
        <br><br>
        <div class='box-invisible'>
            <div class='boxtext'>
                <p class='commentuser'>".$comment['prenom']." ".$comment['nom']."</p>
                <p class='commenttext'>".$comment['texte']."</p>";
                //Cette div place les éléments plus sur la gauche

    if (isset($_COOKIE['id_utilisateur'])) {
        if ($comment['id_utilisateur'] == $_COOKIE['id_utilisateur']) {
            echo "
                <form action='SousPages/delete_comment.php' method='post'>
                    <input type='hidden' name='id_utilisateur' value='".$comment['id_utilisateur']."'>
                    <input type='hidden' name='id_post' value='".$comment['id_post']."'>
                    <input type='hidden' name='date' value='".$comment['date']."'>
                    <input type='hidden' name='path' value='".$path."'>
                    <input type='submit' value='Supprimer'>
                </form>";
        }
    }
    echo "
            </div>
            <div class='boximage'></div>
            <div class='boximage'></div>
        </div><br>"; //boxtext et boxinvisible
        /*
        Les boximages sont là pour prendre plus de place également
        (Pour s'assurer que les éléments sont bien collés à gauche)
        */

}    

/*
Divs présents en sortant de cet include:

    blog.php :
    <div row>
        <div column main>
*/


?>