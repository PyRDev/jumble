<?php
session_start();
    require_once 'etat-connexion.php';
    if (!(is_connected())){
        header('Location:connectform.php');
    }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Panier</title>
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
    <h2 class="title">Panier</h2>
    <div class="table">
    <table>
        <tr class="theader">
            <th class="ttitle">Article</th>
            <th class="ttitle">Quantité</th>
            <th class="ttitle">Prix</th>
            <th class="ttitle">Supprimer</th>
        </tr>
    <tbody>
<?php
// connexion DB
require_once 'config.php';

try {
    $conn = new PDO(DB, USER, PWD);
} catch (PDOException $e) {
    die("Failed: " . $e);
}

//code
$query = "SELECT cmd_id, cmd_article, cmd_qte, cmd_usr, article_nom, article_prix, article_image, (article_prix*cmd_qte) as prix FROM Commandes
JOIN Article on (cmd_article = article_id)
WHERE cmd_usr ='{$_SESSION['id']}'                                                                                                                   
GROUP BY article_id;
";

$res = $conn->query($query);
if (!$res) die("Failed query: " . $query);
$rows = $res->fetchAll();
$nbrows = sizeof($rows);
$prix_final=0;
for ($k = 0; $k < $nbrows; $k++) {
    $infos= $rows[$k];
    $img = ($infos["article_image"]);
    $prix = sprintf('%1.1f', $infos['prix']);
    $prix_final+=$prix;

    echo <<<EOT
<tr class="table-ligne">
    <td class="table-article">
       <img src="data:image/jpg;base64,{$img}" alt="image de l'article {$infos["article_id"]}" width="200px">
       <p>{$infos['article_nom']}</p>
    </td>
    <td class="table-qte">
        <p class="qte"> Quantité actuelle : {$infos['cmd_qte']}</p>
        <button class="modif-qte"><a href="#form{$infos["cmd_id"]}">Modifier</a></button>
        <form method="post" action="setqte.php" class="form-modif-qte" id="form{$infos["cmd_id"]}">
            <label for="quantite">Quantité souhaitée</label>
            <input type="number" id="quantite" name="quantite" class="input-modif-qte" required="" min="1">
            <button type="submit" value="{$infos['cmd_id']}" name="valider" class="valid-modif">Valider</button>
        </form>
    </td>
    <td class="form-prix">
        <p>{$prix} €</p>
    </td>
    <td class="form-suppr">
        <form action="deletepanier.php" method="post">
          <button type="submit" value="{$infos['cmd_id']}" name="delete_panier" class="btn-suppr-panier">Supprimer</button>
        </form>
    </td>
</tr>
EOT;
}
echo <<<EOT
</tbody>
</table>
<div class="btn-commande">
    <a href=""><button class="btn-commande">Commander ({$prix_final} €)</button></a>
</div>
EOT;


//deconnexion DB
$conn->query('KILL CONNECTION_ID()');
$conn = null;
?>
        </tbody>
    </table>
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

<script src="./js/btn-modifqte.js"></script>
</body>
</html>
