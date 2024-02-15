<?php
require_once 'Classes/Autoloader.php';
require_once 'Classes/data/bd.php';

Autoloader::register();
  use Classes\bd\AlbumBD;
  use Classes\bd\ArtisteBD;
  use Classes\bd\PlaylistBD;
  use Classes\bd\PlaylistItemBD;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérez l'ID de l'album depuis le formulaire
    $albumId = $_POST['album_id'];

    // Appelez la fonction createPlaylistItemPhp avec l'ID de l'album
    $result = PlaylistItemBD::createPlaylistItemPhp($albumId);
    header("Location: accueil.php");

    exit();
}
?>
