<?php


// debut
require_once 'config.php';

try {
    $conn = new PDO(DB, USER, PWD);
} catch (PDOException $e) {
    die("Failed: " . $e);
}

$query = file_get_contents('db.sql');
$res = $conn->query($query);
if (!$res) die("Failed query: " . $query);
//fin
$conn->query('KILL CONNECTION_ID()');
$conn = null;

?>