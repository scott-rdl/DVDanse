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

<head>
    <title>Commandes DVD</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="include/style.css" type="text/css"/>
    <link rel="stylesheet" href="include/font-awesome-4.5.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="include/bootstrap-3.3.6-dist/css/bootstrap.min.css"/>
    <script type="text/javascript" src="include/jquery.js"></script>
</head>