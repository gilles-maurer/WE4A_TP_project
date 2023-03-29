<?php

    // Formulaire like / unlike
    if (isset($_COOKIE['id_utilisateur'])) {

        $is_like = is_like($connexion, $row['id_post'], $_COOKIE['id_utilisateur']);
        $is_like = $is_like->fetch();    

        if ($is_like['nb_like'] == 0) {
            echo "<form action='SousPages/like.php' method='post'>
            <input type='hidden' name='id_post' value='".$row['id_post']."'>
            <input type='hidden' name='id_utilisateur' value='".$_COOKIE['id_utilisateur']."'>
            <input type='hidden' name='path' value='".$path."'>
            <input type='submit' value='Like'>
            </form>";
        } else {
            echo "<form action='SousPages/like.php' method='post'>
            <input type='hidden' name='id_post' value='".$row['id_post']."'>
            <input type='hidden' name='id_utilisateur' value='".$_COOKIE['id_utilisateur']."'>
            <input type='hidden' name='path' value='".$path."'>
            <input type='submit' value='Unlike'>
            </form>";
        }
    }

    // Commentaires
    $comments = find_comments($connexion, $row['id_post']);

    while ($comment = $comments->fetch()) {

        echo "<p>".$comment['nom']." ".$comment['prenom']."</p>
        <p>".$comment['texte']."</p>";

        if (isset($_COOKIE['id_utilisateur'])) {
            if ($comment['id_utilisateur'] == $_COOKIE['id_utilisateur']) {
                echo "<form action='SousPages/delete_comment.php' method='post'>
                <input type='hidden' name='id_utilisateur' value='".$comment['id_utilisateur']."'>
                <input type='hidden' name='id_post' value='".$comment['id_post']."'>
                <input type='hidden' name='date' value='".$comment['date']."'>
                <input type='hidden' name='path' value='".$path."'>
                <input type='submit' value='Supprimer'>
                </form>";
            }
        }


    }    

    // Formulaire commentaire
    if (isset($_COOKIE['id_utilisateur'])) {
        echo "<form action='SousPages/comment.php' method='post'>
        <input type='hidden' name='id_post' value='".$row['id_post']."'>
        <input type='hidden' name='id_utilisateur' value='".$_COOKIE['id_utilisateur']."'>
        <input type='hidden' name='path' value='".$path."'>
        <input type='text' name='texte'>
        <input type='submit' value='Commenter'>
        </form>";
    }

?>