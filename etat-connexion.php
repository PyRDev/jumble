<?php
session_start();
function is_connected(){
    return !empty($_SESSION['connexion']);
}
?>