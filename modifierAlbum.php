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
            <li id="bot1"><a href="#">Déconnexion</a></li>
            <li id="bot2"><a href="#">Quitter l'application</a></li>

        </ul>
    </nav>
</aside>

<main>
    <?php
    session_start();

    use Classes\bd\ArtisteBD;

    $admin = $_SESSION['admin'];

    require "Classes/Autoloader.php";
    Autoloader::register();

    $id = $_GET['album_id'];
    $albums = \Classes\bd\AlbumBD::getById($id);

    // Fetch all the artists
    $artists = \Classes\bd\ArtisteBD::getAllArtistes();
    ?>
    <form action="modifierAlbum.php" method="post">
        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" class="form-control" id="titre" name="titre" value="<?php echo $albums->getTitre(); ?>">
        </div>
        <div class="mb-3">
            <label for="artiste" class="form-label">Artiste</label>
            <select name="artiste" id="artiste" class="form-control">
                <?php
                foreach ($artists as $artist) {
                    if ($artist->getId() === $albums->getArtiste()) {
                        echo "<option value=\"{$artist->getId()}\" selected>{$artist->getNom()}</option>";
                    } else {
                        // Create an option for each artist
                        echo "<option value=\"{$artist->getId()}\">{$artist->getNom()}</option>";
                    }
                }
                ?>
            </select>
            <a href="ajoutArtist.php">Ajouter un artiste ...</a>

        </div>
        <div class="mb-3">
            <label for="annee" class="form-label">Année</label>
            <input type="text" class="form-control" id="annee" name="annee" value="<?php echo $albums->getAnnee(); ?>">
        </div>
        <div class="mb-3">
            <label for="genre" class="form-label">Genre</label>
            <input type="text" class="form-control" id="genre" name="genre" value="<?php echo $albums->getGenre(); ?>">
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>


</main>

<!-- Inclure Bootstrap JS (jQuery et Popper.js doivent être inclus avant) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
