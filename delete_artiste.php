<?php

require_once 'Classes/Autoloader.php';
Autoloader::register();

use Classes\bd\ArtisteBD;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $artisteTitle = $_POST['artisteTitle'];
    ArtisteBD::deleteArtiste($artisteTitle);
    echo "Artiste supprimé avec succès.";
}
