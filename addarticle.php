<?php


if (
    isset($_POST['article_nom']) &&
    $_POST['article_nom'] != "" &&

    isset($_POST['article_prix']) &&
    $_POST['article_prix'] != "" &&

    isset($_POST['article_categorie']) &&
    $_POST['article_categorie'] != "" &&


    isset($_POST['uploadimg']) &&
    $_POST['uploadimg'] == "Ajouter") {


    $article_nom = $_POST["article_nom"];
    $article_prix = $_POST["article_prix"];
    $article_categorie = $_POST["article_categorie"];

// debut
    require_once 'config.php';

    try {
        $conn = new PDO(DB, USER, PWD);
    } catch (PDOException $e) {
        die("Failed: " . $e);
    }
    //code
    if (isset($_POST['uploadimg'])) {
        $img = file_get_contents($_FILES['img_file']['tmp_name']);
        $img = base64_encode($img);
        $query = "
    INSERT INTO Article (article_nom, article_prix, article_categorie, article_image)
    VALUES('$article_nom', '$article_prix', '$article_categorie', '$img');
";
    }

    $res=$conn->query($query);
    if (!$res) die("failed query: ".$query);




//fin
    $conn->query('KILL CONNECTION_ID()');
    $conn= null;


    header("Location:articles-admin.php");



} else {
    echo "Il manque un champs";
}

?>