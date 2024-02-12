
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Votre Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="index.css">
  <link rel ="stylesheet" href="static/album.css">
</head>
<body>

<header>
    <form action="" method="GET">
        <input type="text" name="search_query" placeholder="Rechercher un album...">
        <button type="submit">Rechercher</button>
    </form>
</header>


<aside>
  <nav>
    <ul>
      <li><a href="accueil.php">Explorer la liste d'album</a></li>
      <li><a href="#">Mes favoris</a></li>
      <li><a href="#">Mon historique</a></li>
      <li><a href="monCompte.php">Mon Compte</a></li>
      <li id="bot1" ><a href="#">Déconnexion</a></li>
      <li id="bot2" ><a href="#">Quitter l'application</a></li>
    </ul>
  </nav>
</aside>

<main>
  <!-- Contenu principal de votre page -->
  <h2 class="titre-page">Contenu principal</h2>
  <p></p>

<?php

session_start();

require_once 'Classes/Autoloader.php';
require_once 'Classes/data/bd.php'; // Assurez-vous que ce fichier contient la définition de createBD()

$dbFilename = 'bdd.sqlite3';

  Autoloader::register();
  use Classes\bd\AlbumBD;
  use Classes\bd\ArtisteBD;
  use Symfony\Component\Yaml\Yaml;

  if(isset($_GET['search_query']) && $_GET['search_query'] !== '') {
      $search_query = $_GET['search_query'];
      $albums = \Classes\bd\AlbumBD::getAlbumsbyQuery($search_query);
  } else {
      $albums = \Classes\bd\AlbumBD::getAllAlbums();
  }
    

    
    $artistes = \Classes\bd\ArtisteBD::getAllArtistes();
    foreach ($artistes as $artiste){
      //print_r($artiste->getNom());
    }
?>

<div class="liste-artiste">
    <?php foreach ($albums as $album) :
    $debut = "fixtures/images/";
    $url ="";
    if($album->getUrlImage() != "" && $album->getUrlImage() != "img.jpg"){
      $url = $debut . $album->getUrlImage();

    }

    if($album->getUrlImage() === ""){
      $album->setUrlImage("default.jpg");
      $url = $debut . $album->getUrlImage();
    }


                    //print_r($album) // TESTTTT
      //print_r($album->getArtiste()) ?>
        <div class="artiste">
            <img src="<?php echo $url; ?>" alt="artiste1" />

            <div class="contenu">
            <a href="album.php?album_id=<?php echo $album->getId(); ?>">  <h3 class="test-arrow"><span><?php echo $album->getTitre(); ?></span></h3> </a>
      
                <a href="pageArtiste.php?artist_id=<?php echo $album->getArtiste(); ?>">  <p class="test-arrow"><?php echo $album->getArtiste(); ?></p></a>
            </div>
        </div>
    <?php endforeach; ?>
</div>
</main>

<!-- Inclure Bootstrap JS (jQuery et Popper.js doivent être inclus avant) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
