<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="static/album.css">
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
            <li id="bot1"><a href="#">Déconnexion</a></li>
            <li id="bot2"><a href="#">Quitter l'application</a></li>
            <?php
            session_start();
            $admin = $_SESSION['admin'];

            if ($admin) {
                echo "<li><a href='adminAlbum.php'>Ajouter un album</a></li>";
                echo "<li><a href='adminArtist.php'>Ajouter un artiste</a></li>";
            }
            ?>
        </ul>
    </nav>
</aside>

<main>
    <!-- Contenu principal de votre page -->
    <h2 class="titre-page">Contenu principal</h2>
    <p></p>

    <?php

    require_once 'Classes/Autoloader.php';
    require_once 'Classes/data/bd.php'; // Assurez-vous que ce fichier contient la définition de createBD()

    $dbFilename = 'bdd.sqlite3';

    if (!file_exists($dbFilename)) {
        // La base de données n'existe pas, on peut la créer
        $db = new SQLite3($dbFilename);

        // Ajoutez ici la logique pour créer les tables et autres initialisations si nécessaire
        createBD();

  } 
  Autoloader::register();
  use Classes\bd\AlbumBD;
  use Classes\bd\ArtisteBD;
  use Classes\bd\PlaylistBD;
  use Classes\bd\PlaylistItemBD;
  use Symfony\Component\Yaml\Yaml;

        // Chargez les classes avec les espaces de noms
        // ...


    $user = $_SESSION['user'];

  if(isset($_GET['search_query']) && $_GET['search_query'] !== '') {
      $search_query = $_GET['search_query'];
      $albums = \Classes\bd\AlbumBD::getAlbumsbyQuery($search_query);
  } else {
      $albums = \Classes\bd\AlbumBD::getAllAlbums();
  }

    $artistes = \Classes\bd\ArtisteBD::getAllArtistes();
    //foreach ($artistes as $artiste) {
        //print_r($artiste->getNom());
    }
    ?>


    <div class="liste-artiste">
        <?php foreach ($albums as $album) :
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
                        echo "<a onclick=\"showPopupDelAlb('" . $album->getTitre() . "')\"><p class='test-arrow'>Supprimer</p></a>";
                    }
                    ?>
                </div>
                <form action="ajouter_a_playlist.php" method="post" style="display: inline;">
                    <input type="hidden" name="album_id" value="<?php echo $album->getId(); ?>">
                    <button type="submit" class="heart-button">&#10084;</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</main>
<script type="text/javascript" src = "static/popup.js"></script>
<!-- Inclure Bootstrap JS (jQuery et Popper.js doivent être inclus avant) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>