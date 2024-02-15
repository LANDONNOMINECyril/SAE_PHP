<?php 
    require_once 'Classes/Autoloader.php';
    Autoloader::register();
    $dbFilename = 'bdd.sqlite3';

if (file_exists($dbFilename)) {
    // La base de données n'existe pas, on peut la créer
    require_once 'Classes/data/bd.php';
    createBD();
  } 
  header('Location: login.php?res=debut');
?>

