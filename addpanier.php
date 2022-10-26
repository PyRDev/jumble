<?php

$article = $_POST["article"];
session_start();
// debut
require_once 'config.php';
require_once 'etat-connexion.php';
if (!(is_connected())){
    header("Location:connectform.php");
} else {
    try{
        $conn = new PDO(DB, USER,PWD);
    } catch (PDOException $e) {
        die("Failed: ".$e);
    }

    //code
 $query1 = <<<EOT
    select * from Commandes where (cmd_article = {$article} and cmd_usr={$_SESSION['id']}); 
  EOT;
    $res = $conn->query($query1);
    if (!$res) die("Failed query: " . $query1);
    $rows = $res->fetchAll();
    if (sizeof($rows)>0){
            $query2 = <<<EOT
        UPDATE Commandes
        SET cmd_qte= {$rows[0]['cmd_qte']} + 1
        WHERE
        (cmd_article= {$article} and cmd_usr={$_SESSION['id']});
    EOT;
        $res=$conn->query($query2);
        if (!$res) die("failed query: ".$query2);

    } else {
        $query3 = <<<EOT
    INSERT INTO Commandes 
    (cmd_usr, cmd_article, cmd_qte)
    VALUES 
    ({$_SESSION['id']}, {$article}, 1)
EOT;
     $res=$conn->query($query3);
     if (!$res) die("failed query: ".$query3);
 }

    //fin
    $conn->query('KILL CONNECTION_ID()');
    $conn= null;
    header("Location:articles.php");

}

?>