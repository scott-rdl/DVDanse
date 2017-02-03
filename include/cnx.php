<?php 
    $host = "localhost";
    $base = "cmd_dvd";
    $logindb = "root";
    $passdb = "";
    
    try {
        $bdd = new PDO("mysql:host=$host;dbname=$base;charset=utf8;", $logindb, $passdb);
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
?>