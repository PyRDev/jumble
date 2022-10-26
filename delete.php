<?php

$article=$_POST["article"];


require_once 'config.php';

try {
    $conn=new PDO(DB, USER, PWD);
}
catch (PDOException $e){
    die("Failed: ".$e);
}



$query=<<<EOT
    DELETE FROM Article
    WHERE article_id = $article;
EOT;
$res=$conn->query($query);
if (!$res) die("Failed query: ").$query;

$conn->query('KILL CONNECTION_ID()');
$conn=null;

header('Location:./articles-admin.php');
?>
