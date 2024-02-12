<?php
// pageArtiste.php

// Assurez-vous de gérer correctement les erreurs, validations, et d'inclure vos dépendances

$artistId = $_GET['artist_id'];

// Chargez les informations de l'artiste à partir de la base de données en utilisant $artistId
// ...

// Affichez les informations sur la page
echo "<h1>Informations sur l'artiste</h1>", $artistId;
// Affichez les autres détails de l'artiste
?>