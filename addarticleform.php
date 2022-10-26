<?php
session_start();
require_once 'etat-connexion.php';
if ($_SESSION['admin'] == NULL){
    header('Location:connectform.php');
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Ajouter Article </title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>
<header>
    <div class="container-header">
        <h1><a href="index.php">Jumble</a></h1>
        <nav class="menu">
            <ul class="container-menu">
                <li><a href="./index.php">Accueil</a></li>
                <li><a href="./articles.php">Articles</a></li>
                <li><a href="./panier.php">Panier</a></li>
                <?php
                require_once 'etat-connexion.php';
                if (is_connected()) {
                    echo '<li><a href="./deconnect.php">Deconnexion</a></li>';
                } else {
                    echo '<li><a href="./connectform.php">Connexion</a></li>';
                }
                ?>
            </ul>
        </nav>
    </div>
</header>
<main>
    <h2 class="title"> Ajouter un article </h2>
    <form enctype="multipart/form-data" method="post" action="addarticle.php" class="form-fullpage">
        <label for="article_nom">Nom</label>
        <input type="text" name="article_nom" id="article_nom" required>
        <br>
        <label for="article_prix">Prix</label>
        <input type="number" step="0.01" name="article_prix" id="article_prix" required>
        <br>

        <label for="article_categorie">Catégorie</label>
        <select name="article_categorie" id="article_categorie">
            <option value="alimentaire">Alimentaire</option>
            <option value="numerique">Numérique</option>
            <option value="vetement">Vêtements</option>
            <option value="fournitures">Fournitures</option>
            <option value="outils">Outils</option>
        </select>
        <br>
        <label for="article_image">nouvelle image</label>
        <input type="file" name="img_file" id="article_image">
        <br>
        <input type="submit" name="uploadimg" value="Ajouter">
    </form>
    <br>
    <br>
</main>
<footer>
    <div class="footer-coordonnee">
        <ul>
            <li>® Jumble</li>
            <li>jumble@contact.fr</li>
            <li>Useless Bay, Washington, États-Unis</li>
        </ul>
    </div>
    <div class="footer-nav">
        <nav>
            <a href="">Mentions Légales</a>
            <a href="">Contacts</a>
        </nav>
    </div>
    <div class="footer-auteurs">
        <ul>
            <li>Pierre Lamandé</li>
            <li>Alexis Romand</li>
            <li>Ysée Troubat</li>
        </ul>
    </div>
    <div class="footer-bas">
        <p>MMI 2022</p>
    </div>
</footer>
</body>
</html>