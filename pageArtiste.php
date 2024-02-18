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
    Autoloader::autoload("bd\ArtisteBD");
    use Symfony\Component\Yaml\Yaml;
    $artiste = \Classes\bd\ArtisteBD::getById($_GET['artist_id']);

    $debut = "fixtures/images/";
    $url = "";
    if ($artiste->getUrlImage() != "" && $artiste->getUrlImage() != "img.jpg") {
        $url = $debut . $artiste->getUrlImage();

    }

    if ($artiste->getUrlImage() === "") {
        $artiste->setUrlImage("default.jpg");
        $url = $debut . $artiste->getUrlImage();
    }



    echo "<img src='" . $url . "' alt='Image de l'album' />";
    echo "<h2>Artiste : " . $artiste->getNom() . "</h2>";
    echo "<h3>" . $artiste->getBio() . "</h3>";
    if ($admin) {
        echo "<a href='adminArtist.php?type=modif&artiste_id=" . $artiste->getId() . "'>Modifier</a>";
        echo "<a onclick=\"showPopupDelArt('" . $artiste->getNom() . "')\"><p class='test-arrow'>Supprimer</p></a>";
    }
    ?>
</main>

<script type="text/javascript" src = "static/popup.js"></script>
<!-- Inclure Bootstrap JS (jQuery et Popper.js doivent être inclus avant) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
