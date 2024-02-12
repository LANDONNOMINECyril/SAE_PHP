<?php

require_once 'Classes/Autoloader.php';
Autoloader::register();

use Classes\bd\AlbumBD;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $albumTitle = $_POST['albumTitle'];
    AlbumBD::deleteAlbum($albumTitle);
    echo "Album deleted successfully.";
}