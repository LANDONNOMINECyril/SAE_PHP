
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Votre Page</title>
  <!-- Inclure Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="index.css">
  <link rel ="stylesheet" href="static/album.css">
</head>
<body>

<header>
    <h3><input type="text" placeholder="Rechercher un album..."></h3>
</header>

<aside>
  <nav>
    <ul>
      <li><a href="index.php">Explorer la liste d'album</a></li>
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

    require_once 'Classes/data/bd.php';
    createBD();

    $db = new SQLite3('bdd.sqlite3');

    require "Classes/Autoloader.php";
    Autoloader::register();
    Autoloader::autoload("bd\AlbumBD");
    use Symfony\Component\Yaml\Yaml;
    $albums = \Classes\bd\AlbumBD::getAllAlbums();

      ?>
    <div class="liste-artiste">
      <?php 
          foreach ($albums as $album) {?>
            <div class="artiste">
              <img src="./Classes/data/IMG/The_Eminem_Show.jpg" alt="artiste1" />
              <div class="contenu">
                <a href=""><h3 class="test-arrow"><span><?php echo $album->getTitre() ?></span></h3></a>
                <p> <?php  echo $album->getArtiste() ?></p>
              </div>
            </div>
          <?php }
      ?>
          </div>
</main>

<!-- Inclure Bootstrap JS (jQuery et Popper.js doivent être inclus avant) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
