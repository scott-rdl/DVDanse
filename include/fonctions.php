<?php 
    function bdd() {
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=cmd_dvd;charset=utf8', 'root', '');
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        return $bdd;
    }
   
?>