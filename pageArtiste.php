<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Page Album</title>
  <!-- le bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="index.css">
  <link rel="stylesheet" href="static/album.css">
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
    Autoloader::autoload("bd\AlbumBD");
    use Symfony\Component\Yaml\Yaml;
    $artiste = \Classes\bd\ArtisteBD::getById($_GET['artist_id']);
    $albums = \Classes\bd\AlbumBD::getByArtiste($_GET['artist_id']);

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
        echo "<a href='modifierArtiste.php?artiste_id=" . $artiste->getId() . "'>Modifier</a>";
    }

    echo "<h2> Liste des albums de " . $artiste->getNom() . " :</h2>";
    ?>
    <?php
    if(!is_array($albums)){ ?>
                <div class="artiste">
                <img src="<?php echo $url; ?>" alt="artiste1"/>

                <div class="contenu">
                    <a href="album.php?album_id=<?php echo $album->getId(); ?>"><h3 class="test-arrow">
                            <span><?php echo $album->getTitre(); ?></span></h3></a>

                    <a href="pageArtiste.php?artist_id=<?php echo $album->getArtisteId(); ?>"><p
                                class="test-arrow"><?php echo $album->getArtiste(); ?></p></a>
                    <?php
                    if ($admin) {
                        echo "<a href='adminAlbum.php?type=modif&album_id=" . $album->getId() . "'><p class='test-arrow'>Modifier</p></a>";
                        echo "<a onclick=\"showPopupDel('" . $album->getTitre() . "')\"><p class='test-arrow'>Supprimer</p></a>";
                    }
                    ?>
                </div>
            </div>
            
       <?php }
        
    foreach ($albums as $album) :
            $debut = "fixtures/images/";
            $url = "";
            if ($album->getUrlImage() != "" && $album->getUrlImage() != "img.jpg") {
                $url = $debut . $album->getUrlImage();

            }

            if ($album->getUrlImage() === "") {
                $album->setUrlImage("default.jpg");
                $url = $debut . $album->getUrlImage();
            }

            //print_r($album) // TESTTTT
            //print_r($album->getArtiste())
            ?>
            <div class="artiste">
                <img src="<?php echo $url; ?>" alt="artiste1"/>

                <div class="contenu">
                    <a href="album.php?album_id=<?php echo $album->getId(); ?>"><h3 class="test-arrow">
                            <span><?php echo $album->getTitre(); ?></span></h3></a>

                    <a href="pageArtiste.php?artist_id=<?php echo $album->getArtisteId(); ?>"><p
                                class="test-arrow"><?php echo $album->getArtiste(); ?></p></a>
                    <?php
                    if ($admin) {
                        echo "<a href='adminAlbum.php?type=modif&album_id=" . $album->getId() . "'><p class='test-arrow'>Modifier</p></a>";
                        echo "<a onclick=\"showPopupDel('" . $album->getTitre() . "')\"><p class='test-arrow'>Supprimer</p></a>";
                    }
                    ?>
                </div>
            </div>
        <?php endforeach; ?>
</main>

<!-- Inclure Bootstrap JS (jQuery et Popper.js doivent être inclus avant) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
