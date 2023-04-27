# **Runshare : Un projet PHP**
> Réalisé par Gilles MAURER et Clément BRICHET dans le cadre de l'UV WE4A (UTBM)

<br>

## Résumé
**Runshare** est un site permettant aux amateurs de course à pied de partager leurs dernières courses, en indiquant date, lieu, durée et distance, le tout avec une petite description ou commentaire.

Ils peuvent lire les posts des autres, commenter et encourager, ou encore s'abonner à certaines personnes pour être au courant de leurs derniers exploits.

<br>

## Langages utilisés
Le site fonctionne principalement en ; 
* HTML/PHP pour l'affichage des informations
* CSS pour l'apparence du site
* SQL pour les requêtes de base de données
* AJAX pour certains éléments dynamiques *(Exemple : Recherche de blog)*

<br>

## Affichage des posts sur la page d'accueil
Les posts à afficher sont choisis selon deux critères, par ordre chronologique :
* Les posts des personnes auxquelles on est abonné seulement et datant de moins de 10 jours
* Les posts les plus récents de tout le monde (qui n'ont pas déjà été affichés)

<br>

## Version de PHP
Nous travaillons avec deux versions différentes de PHP : **`5.6.18`** et **`8.2.0`**. Le site est compatible avec les deux.

<br>

## Connexion à la base de données
Dans notre fichier de connexion, on utilise en tant que mot de passe soit **`root`** soit rien au moyen d'un **`try catch`**. De cette manière, la connexion peut s'effectuer via XAMPP comme via UWAMP.

<br>

## Sécurisation SQL
Chaque texte que l'utilisateur peut entrer est sécurisé en remplaçant chaque **`'`** par **`\'`**. De cette manière, il est stocké avec l'antislash dans la base de donné, et ne permet donc pas l'injection SQL.

<br>

## Test 
Pour simplifier la phase de test vous pouver utiliser le compte suivant : 
    email : gilles.maurer@utbm.fr
    mdp : gilles 
Ces identifiants vous permettrons d'accéder à un compte contenant déjà plusieurs post et abonnements.

