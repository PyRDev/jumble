<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Inscription </title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <link rel="stylesheet" href="./lib/formvalidation/dist/css/formValidation.css" />
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
    <h2 class="title"> Inscrivez-vous </h2>
    <form method="post" action="register.php" class="form-fullpage" id="register-form">
        <fieldset>
            <div>
                <div class="form-item">
                    <label for="user_login">login</label>
                    <input type="text" name="user_login" id="user_login">
                </div>
                <div class="form-item">
                    <label for="user_email">email</label>
                    <input type="email" name="user_email" id="user_email">
                </div>
                <div class="form-item">
                    <label for="user_mdp">Mot de passe</label>
                    <input type="password" name="user_mdp" id="user_mdp">
                </div>
                <div class="form-item">
                    <label for="confirm_mdp">Confirmation du mot de passe</label>
                    <input type="password" name="confirm_mdp" id="confirm_mdp">
                </div>
                <input type="submit" name="ok" value="Créer un compte">
            </div>
        </fieldset>
    </form>
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
<!-- Script validation formulaire -->
<script src="./lib/formvalidation/dist/js/FormValidation.full.js"></script>
<script src="./lib/formvalidation/dist/js/locales/fr_FR.js"></script>
<script src="./js/register_form_validation.js"></script>
</body>
</html>