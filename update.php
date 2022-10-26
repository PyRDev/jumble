<?php
//var_dump($_POST);

$article=$_POST["submit"];
$n = $_POST["article_nom"];
$img = $_POST["article_image"];
$p = $_POST["article_prix"];
//$c = $_POST["article_categorie"];

if (isset($_POST["article_nom"])&&
    $_POST["article_nom"] !=""&&

    isset($_POST["article_prix"])&&
    $_POST["article_prix"] !=""

) {


    require_once 'config.php';

    try {
        $conn=new PDO(DB, USER, PWD);
    }
    catch (PDOException $e){
        die("Failed: ".$e);
    }

    if (isset($_POST['submit'])) {
        $img = file_get_contents($_FILES['article_image']['tmp_name']);
        $img = base64_encode($img);
        $query = <<<EOT
    UPDATE Article
    SET article_nom='$n',article_prix='$p',article_image='$img'
    WHERE
    article_id= $article;
EOT;}


    $res = $conn->query($query);
    if (!$res) die("Failed query: ").$query;

    $conn->query('KILL CONNECTION_ID()');
    $conn=null;

    header("Location: ./articles-admin.php");
} else {
    echo "Il manque un champs";
}


?>
