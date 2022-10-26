<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Connexion </title>
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
    <h2 class="title">Connexion</h2>
    <form method="post" action="connect.php" class="form-fullpage" id="login-form">
        <fieldset>
            <div>
                <div class="form-item">
                    <label for="login">login</label>
                    <input type="text" name="login" id="login" required>
                </div>
                <div class="form-item">
                    <label for="mdp">password</label>
                    <input type="password" name="mdp" id="mdp" required>
                </div>
                <input type="submit" name="submit" value="Connexion">
            </div>
        </fieldset>
    </form>
    <div class="btn-register">
        <p> Vous n'avez pas de compte ? <a href="registerform.php">Inscrivez-vous !</a></p>
    </div>
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