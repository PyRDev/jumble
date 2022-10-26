<?php
session_start();
require_once 'etat-connexion.php';
if ($_SESSION['admin'] == NULL) {
    header('Location:connectform.php');
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title> Administrateur </title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <link rel="stylesheet" type="text/css" href="./lib/accordion/dist/accordion.css">
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
    <h2 class="title"> Articles </h2>
    <div class="container-btn-add">
        <button class="btn-add"><a href="addarticleform.php">Ajouter un article</a></button>
    </div>

    <div class="container-tris">
        <div class="nav-tri">
            <p> Trier par </p>
            <button data-sort=".article-id" class="active"> Par défaut </button>
            <button data-sort=".article-prix"> Prix </button>
            <button data-sort=".article-nom"> Nom </button>
        </div>
        <div class="nav-categorie filter-controls">
            <p> Filtrer </p>
            <button class="active" data-filter="*"> Voir tout </button>
            <button data-filter="alimentaire"> Alimentaire </button>
            <button data-filter="numerique"> Numérique </button>
            <button data-filter="vetement"> Vetements </button>
            <button data-filter="fournitures">Fournitures</button>
            <button data-filter="outils"> Outils </button>
        </div>
    </div>
    <div class="grid filter-list">
        <?php

        // connexion DB
        require_once 'config.php';

        try {
            $conn = new PDO(DB, USER, PWD);
        } catch (PDOException $e) {
            die("Failed: " . $e);
        }

        // Code
        $query = "SELECT * FROM Article";
        $res = $conn->query($query);
        if (!$res) die("Failed query: " . $query);
        $rows = $res->fetchAll();

        $nbrows = sizeof($rows);
        for ($k = 0; $k < $nbrows; $k++) {
            $infos= $rows[$k];
            $img = ($infos["article_image"]);
            echo <<<EOT


<div class="grid-item {$infos["article_categorie"]}">
     <div class="img-wrapper">
        <img src="data:image/jpg;base64,{$img}" alt="image de l'article {$infos["article_id"]}" width="100%">
            <div class="btn-hover">
                 <form method="post" action="./delete.php">
                    <button type="submit" value="{$infos["article_id"]}" name="article" class="btn-suppr"> Supprimer </button>
                 </form>
             </div>
    </div>   
    <h2 class="article-nom"> {$infos["article_nom"]} </h2>
    <p class="article-prix"> {$infos["article_prix"]} €</p>
    <p class="hidden article-id">{$infos["article_id"]}</p>
    
    <div class="form-update accordion-container">
        <div class="ac">
        
            <h2 class="ac-header">
                <button class="ac-trigger"> Modifier </button>
            </h2>
            
            <div class="ac-panel">
                <form method="post" enctype="multipart/form-data"   action="./update.php">
                    <label for="article_nom">nouveau nom</label>
                    <input type="text" name="article_nom" id="article_nom">
                    <br>
                    <label for="article_prix">nouveau prix</label>
                    <input type="number" name="article_prix" id="article_prix">
                    <br>
                    <label for="article_image">nouvelle image</label>
                    <input type="file" name="article_image" id="article_image">
                    <br>
                    <button type="submit" name="submit" value="{$infos["article_id"]}"> Modifier </button>                   
                </form>  
            </div>
            
              
        </div>
    </div>
</div>

EOT;
        }
        //deconnexion DB
        $conn->query('KILL CONNECTION_ID()');
        $conn = null;
        ?>
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

<!-- Scripts pour Accordeon formulaire update -->
<script src="./lib/accordion/dist/accordion.js"></script>
<script src="./js/accordion.js"></script>

<!-- Script Filtre par catégorie -->
<script src="./js/filtre.js"></script>

<!-- Tri javascript -->
<script src="./lib/tinysort.js"></script>
<script src="./js/tri.js"></script>


</body>
</html>