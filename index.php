<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Accueil</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <link rel="stylesheet" type="text/css" href="./lib/splide/dist/css/splide.min.css">
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
<!-- Carrousel -->
<div id="slider1" class="splide" role="group" aria-label="Splide Basic HTML Example">
    <div class="splide__track">
        <div class="splide__list">
            <div class="splide__slide"><img src="./img/slider1.png" alt="image 1" width="100%"></div>
            <div class="splide__slide"><img src="./img/slider2.png" alt="image 2" width="100%"></div>
            <div class="splide__slide"><img src="./img/slider3.png" alt="image 3" width="100%"></div>
        </div>
    </div>
</div>

<?php
require_once 'etat-connexion.php';
require_once 'config.php';
if (is_connected()) {
    echo "
<h2 class='hello'>Bienvenue <span>{$_SESSION['login']}</span></h2>
";
} else {
    echo "<h2 class='hello'>Bienvenue</h2>";
}


try {
    $conn=new PDO(DB, USER, PWD);
}
catch (PDOException $e){
    die("Failed: ".$e);
}
?>
<div class="container-about">
    <div class="about">
        <div class="text-about">
            <p>
                Bienvenue sur <span>Jumble</span> ! Une boutique mettant la priorité sur la <span>qualité et le luxe</span>, spécialement conçue pour les pièces uniques. Ici, vous trouverez tout ce dont vous avez besoin à l'unité. Fini le gaspillage des achats en lots !
            </p>
            <p>
                Nous vous garantissons le meilleur raport qualité/prix. Nos produits sont conçus à partir de matériaux au <span>design pointu, de qualité et éco-responsables</span>.
            </p>
            <p>
                De plus, un compte <span>administrateur</span> vous permet de proposer de nouveaux produits à la vente. Pour que chacun puisse participer à la gestion de la boutique.
            </p>
            <p>
                Nous vous souhaitons un bon shopping sur <span>Jumble</span> !
            </p>
        </div>
        <div class="img-about">
            <img class="about-img" src="./img/forest.png" alt="bannière forêt">
        </div>
    </div>
</div>

<!-- ARTICLES PAS CHER -->

<div class="titre-slider">
    <h3>Articles les moins chers</h3>
</div>
<div class="container-slider">
    <div id="slider2" class="splide" role="group" aria-label="Splide Basic HTML Example">
        <div class="splide__track">
            <div class="splide__list">
<?php
$query=<<<EOT
    SELECT * FROM Article
    ORDER BY article_prix;
EOT;
$res=$conn->query($query);
if (!$res) die("Failed query: ").$query;
$rows=$res->fetchAll();

//afficher les 9 premiers articles les moins cher
for ($k=0; $k<=9; $k++) {
    $infos=$rows[$k];
    $img=$infos['article_image'];
    echo <<<EOT
                <div class="splide__slide">
                    <div class="img-wrapper">
                        <img src="data:image/jpg;base64,{$img}" alt="image de l'article {$infos['article_id']}" width="300px">
                        <div class="btn-hover">
                            <form method="post" action="addpanier.php">
                                <button type="submit" value="{$infos["article_id"]}" name="article"> Panier </button>
                            </form>
                        </div>
                    </div>
                    <h4 class="title-slide">{$infos['article_nom']} <span>{$infos['article_prix']}€</span></h4>
               </div>
EOT;
}
?>
            </div>
        </div>
    </div>
</div>


<!-- ARTICLES RECENTS -->

<div class="titre-slider">
    <h3>Articles récents</h3>
</div>
<div class="container-slider">
    <div id="slider3" class="splide" role="group" aria-label="Splide Basic HTML Example">
        <div class="splide__track">
            <div class="splide__list">
                <?php
                $query2=<<<EOT
SELECT * FROM Article
ORDER BY article_id desc;
EOT;
                $res=$conn->query($query2);
                if (!$res) die("Failed query: ").$query2;
                $rows=$res->fetchAll();

                //afficher les 9 premiers articles les moins cher
                for ($k=0; $k<=9; $k++) {
                    $infos=$rows[$k];
                    $img=$infos['article_image'];
                    echo <<<EOT
            <div class="splide__slide">
                <div class="img-wrapper">
                    <img src="data:image/jpg;base64,{$img}" alt="image de l'article {$infos['article_id']}" width="300px">
                    <div class="btn-hover">
                        <form method="post" action="addpanier.php">
                            <button type="submit" value="{$infos["article_id"]}" name="article"> Panier </button>
                        </form>
                    </div>
                </div>
                <h4 class="title-slide">{$infos['article_nom']} <span>{$infos['article_prix']}€</span></h4>
           </div>
EOT;
                }
                $conn->query('KILL CONNECTION_ID()');
                $conn=null;
                ?>
            </div>
        </div>
    </div>
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
<script src="./lib/splide/dist/js/splide.min.js"></script>
<script src="./js/slider.js"></script>
</body>
</html>