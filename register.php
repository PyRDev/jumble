<?php

if (
    isset($_POST['user_login']) &&
    $_POST['user_login'] != "" &&

    isset($_POST['user_email']) &&
    $_POST['user_email'] != "" &&

    isset($_POST['user_mdp']) &&
    $_POST['user_mdp'] != "" &&

    isset($_POST['confirm_mdp']) &&
    $_POST['confirm_mdp'] != "" &&

    isset($_POST['ok']) &&
    $_POST['ok'] == "Créer un compte") {

    if ($_POST['confirm_mdp'] != $_POST['user_mdp']){
        echo 'Le mot de passe ne correspond pas';
        header('Location : .registerform.php' );
    }


    $user_login = $_POST["user_login"];
    $user_email = $_POST["user_email"];
    $user_mdp = $_POST["user_mdp"];
    /* hashage mdp */
    $user_mdp=sha1($user_mdp);

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
    WHERE usr_login = '{$user_login}';
EOT;
    $res=$conn->query($query);
    if (!$res) die("failed query: ".$query);
    $rows = $res->fetchAll();
    if (sizeof($rows) == 0) {
        $query = "
    INSERT INTO User (usr_login, usr_email, usr_mdp)
    VALUES('$user_login', '$user_email', '$user_mdp');
"; header('Location:./connectform.php');


    } else {
        echo "
        <link rel='stylesheet' type='text/css' href='./css/style.css'>
        <p> Identifiant éxistant, veuillez en saisir un autre</p>
        <button class='btn-error'><a href='registerform.php'>Réessayer<a></button>
        ";
    }

    $res=$conn->query($query);
    if (!$res) die("failed query: ".$query);


//fin
    $conn->query('KILL CONNECTION_ID()');
    $conn= null;


} else {
    echo "Il manque un champs";
}

?>
