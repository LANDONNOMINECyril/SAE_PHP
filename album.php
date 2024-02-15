<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Page Album</title>
  <!-- le bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="index.css">
</head>
<body>



<aside>
  <nav>
    <ul>
      <li><a href="accueil.php">Explorer la liste d'album</a></li>
      <li><a href="#">Mes favoris</a></li>        
      <li><a href="#">Mon historique</a></li>
      <li><a href="#">Mon Compte</a></li>
      <li id="bot1" ><a href="#">Déconnexion</a></li>
      <li id="bot2" ><a href="#">Quitter l'application</a></li>

    </ul>
  </nav>
</aside>

<main>
    <?php
    session_start();

    $admin = $_SESSION['admin'];

    require "Classes/Autoloader.php";
    Autoloader::register();
    Autoloader::autoload("bd\AlbumBD");
    use Symfony\Component\Yaml\Yaml;

    $id = $_GET['album_id'];
    $albums = \Classes\bd\AlbumBD::getById($id);
    echo "<img src='fixtures/images/" . $albums->getUrlImage() . "' alt='Image de l'album' />";
    echo "<h2>Artiste : " . $albums->getArtiste() . "</h2>";
    echo "<h2>" . $albums->getTitre() . "</h2>";
    echo "<h2>Genre : " . $albums->getGenre() . "</h2>";
    echo "<h2>Date de sortie : " . $albums->getAnnee() . "</h2>";
    if ($admin) {
        echo "<a href='adminAlbum.php?type=modif&album_id=" . $albums->getId() . "'>Modifier</a>";
    }
    ?>
</main>

<!-- Inclure Bootstrap JS (jQuery et Popper.js doivent être inclus avant) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
