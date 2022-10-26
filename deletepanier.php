<?php

$article=$_POST["delete_panier"];


require_once 'config.php';

try {
    $conn=new PDO(DB, USER, PWD);
}
catch (PDOException $e){
    die("Failed: ".$e);
}
var_dump($article); 


$query=<<<EOT
    DELETE FROM Commandes 
    WHERE cmd_id = $article;
EOT;
$res=$conn->query($query);
if (!$res) die("Failed query: ").$query;

$conn->query('KILL CONNECTION_ID()');
$conn=null;

header('Location:./panier.php');
?>