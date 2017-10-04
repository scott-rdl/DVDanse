<?php 
    $host = "localhost";
    $base = "dvdanse";
    $logindb = "root";
    $passdb = "";
    
    try {
        $bdd = new PDO("mysql:host=$host;dbname=$base;charset=utf8;", $logindb, $passdb);
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
?>