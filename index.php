<?php 

$dbFilename = 'bdd.sqlite3';
require_once 'Classes/Autoloader.php';
Autoloader::register();

require_once 'Classes/data/bd.php';
require_once 'login.php';

if (!file_exists($dbFilename)) {
  // La base de données n'existe pas, on peut la créer
  $db = new SQLite3($dbFilename);
  createBD();

    // Ajoutez ici la logique pour créer les tables et autres initialisations si nécessaire
    
    
    // Chargez les classes avec les espaces de noms
    // ...
    

  } 
?>
