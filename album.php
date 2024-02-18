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
    require "Classes/Autoloader.php";
    Autoloader::register();
    use Classes\bd\AlbumBD;
    use Classes\bd\NoteAlbumBD;
    use Symfony\Component\Yaml\Yaml;

    $id = $_GET['album_id'];
    $album = \Classes\bd\AlbumBD::getById($id);
    $notes = \Classes\bd\NoteAlbumBD::getNotesByAlbumId($id);
    $noteMoyenne = 0;
    if (is_array($notes)) {
      if(count($notes) ===0){
        $noteMoyenne = "Aucune notation pour cette album";
      }else{
        foreach($notes as $note){
          $noteMoyenne += $note->getNote();
        }
        $noteMoyenne = "la note moyenne est de : " . $noteMoyenne / count($notes) . "/10";
      }
  }else{
    $noteMoyenne ="la note moyenne est de : " . $notes->getNote() . "/10";
  }

    echo "<img src='fixtures/images/" . $album->getUrlImage() . "' alt='Image de l'album' />";
    echo "<h2>Artiste : " . $album->getArtiste() . "</h2>";
    echo "<h2>" . $album->getTitre() . "</h2>";
    echo "<h2>Genre : " . $album->getGenre() . "</h2>";
    echo "<h2>Date de sortie : " . $album->getAnnee() . "</h2>";
    echo "<h2>" . $noteMoyenne . "</h2>"; ?>
<form action="" method="POST">
    <input type="text" name="notation" placeholder="Noter un album...">
    <button type="submit">Ajouter</button>
</form>
<?php
    if(isset($_POST['notation']) && $_POST['notation'] !== '') {
        $notation = $_POST['notation'];
        \Classes\bd\NoteAlbumBD::ajouterNote($notation, intval($id));
        header("Location: album.php?album_id=".$id);
    }
?>

</main>

<!-- Inclure Bootstrap JS (jQuery et Popper.js doivent être inclus avant) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
