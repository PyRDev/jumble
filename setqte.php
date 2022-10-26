<?php


if (isset($_POST["quantite"])&&
    $_POST["quantite"] !=""&&

    isset($_POST["valider"])&&
    $_POST["valider"] !=""

) {

    $qte=$_POST['quantite'];
    $article=$_POST['valider'];
    require_once 'config.php';

    try {
        $conn=new PDO(DB, USER, PWD);
    }
    catch (PDOException $e){
        die("Failed: ".$e);
    }

    $query =<<<EOT
    UPDATE Commandes
    SET cmd_qte='{$qte}'
    WHERE
    cmd_id='$article';
EOT;

    $res = $conn->query($query);
    if (!$res) die("Failed query: ").$query;

    $conn->query('KILL CONNECTION_ID()');
    $conn=null;

    header("Location: ./panier.php");

} else {
    echo 'Erreur';
}





?>
