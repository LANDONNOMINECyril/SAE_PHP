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
      <li><a href="mesFavoris.php">Mes favoris</a></li>        
      <li><a href="#">Mon historique</a></li>
      <li><a href="#">Mon Compte</a></li>
      <li id="bot1" ><a href="index.php">Déconnexion</a></li>
      <li id="bot2" ><a href="#">Quitter l'application</a></li>

    </ul>
  </nav>
</aside>

<main>
    <?php
    require_once 'Classes/data/bd.php';
    
    require_once "Classes/Autoloader.php";
    Autoloader::register();
    
    // Chargez les classes avec les espaces de noms
    use Classes\bd\AlbumBD;
    use Classes\bd\ArtisteBD;
    use Classes\bd\UtilisateurBD;
    use Symfony\Component\Yaml\Yaml;

    session_start();
  


  // Get the user account information
  $account = \Classes\bd\UtilisateurBD::getById($_SESSION['id']);

  echo "<h1>Mon Compte</h1>";
  echo "<h2>Utilisateur : " . $account->getNom() . "</h2>";

    ?>
  
</main>

<!-- Inclure Bootstrap JS (jQuery et Popper.js doivent être inclus avant) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>