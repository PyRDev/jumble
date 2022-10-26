<?php
session_start();
if (
    isset($_POST['login']) &&
    $_POST['login'] != "" &&

    isset($_POST['mdp']) &&
    $_POST['mdp'] != "" &&

    isset($_POST['submit']) &&
    $_POST['submit'] == "Connexion"
)

{

    $login = $_POST["login"];
    $mdp = $_POST["mdp"];
    $mdp = sha1($mdp);

// debut
    require_once 'config.php';

    try{
        $conn = new PDO(DB, USER,PWD);
    } catch (PDOException $e) {
        die("Failed: ".$e);
    }

//code
    $query = <<<EOT
    SELECT * FROM User 
    WHERE usr_login = '{$login}' AND usr_mdp = '{$mdp}';
EOT;
    $res=$conn->query($query);
    if (!$res) die("failed query: ".$query);
    $rows = $res->fetchAll();
    if (sizeof($rows) == 1) {
        $_SESSION['id'] = $rows[0]["usr_id"];
        $_SESSION['login'] = $rows[0]["usr_login"];
        $_SESSION['mdp'] = $rows[0]["usr_mdp"];
        $_SESSION['email'] = $rows[0]["usr_email"];
        $_SESSION['admin']=$rows[0]["usr_admin"];
        $_SESSION['connexion']=1;
        header("Location:index.php");
    } else {
        echo "
        <link rel='stylesheet' type='text/css' href='./css/style.css'>
        <p> Identifiant ou mot de passe incorrect </p>
        <button class='btn-error'><a href='connectform.php'>Réessayer<a></button>
        ";
    }


//fin
    $conn->query('KILL CONNECTION_ID()');
    $conn= null;

} else {
    echo "Il manque un champs";
}


?>