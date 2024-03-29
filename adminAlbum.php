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

    use Classes\bd\AlbumBD;
    use Classes\bd\ArtisteBD;
    use Classes\models\Album;
    require_once 'Classes\Action\getImage.php';


    $admin = $_SESSION['admin'];

    require "Classes/Autoloader.php";
    Autoloader::register();

    $modif = false;

    if ($_GET['type'] === 'modif') {
        $id = $_GET['album_id'];
        $albums = \Classes\bd\AlbumBD::getById($id);
        $modif = true;
    }


    /**
     * @param Album $nalbum
     * @return void
     */

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $titre = $_POST['titre'];
        $artiste = $_POST['artiste'];
        $annee = $_POST['annee'];
        $genre = $_POST['genre'];
//        $urlImage = $_POST['image'];

//        $artiste = ArtisteBD::getIdName($artiste);
        echo $artiste;

        // Create an Album object
        $nalbum = new Album();
        if($modif){
            $nalbum->setId($id);
        }
        $nalbum->setTitre($titre);
        $nalbum->setArtiste($artiste);
        $nalbum->setAnnee($annee);
        $nalbum->setGenre($genre);


        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            extracted($nalbum);
        } else {
            $nalbum->setUrlImage($albums->getUrlImage());
        }

        if($modif){
            AlbumBD::updateAlbum($nalbum);
            header("Location: album.php?album_id=$id");
        }else{
            AlbumBD::ajouterAlbum($nalbum);
            header("Location: accueil.php");
        }
        exit();
    }

    if($modif) {
        echo "<h1>Modifier un album</h1>";
    } else {
        echo "<h1>Ajouter un album</h1>";
    }

    // Fetch all the artists
    $artists = \Classes\bd\ArtisteBD::getAllArtistes();

    if ($modif) {
        echo "<form action=\"adminAlbum.php?type=modif&album_id=$id\" method=\"post\" enctype=\"multipart/form-data\">";
    }else{
        echo "<form action=\"adminAlbum.php\" method=\"post\" enctype=\"multipart/form-data\">";
    }

    ?>
        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" class="form-control" id="titre" name="titre" <?php if ($modif) {
                echo "value='{$albums->getTitre()}'";
            } ?>>
        </div>
        <div class="mb-3">
            <label for="artiste" class="form-label">Artiste</label>
            <select name="artiste" id="artiste" class="form-control">
                <?php
                foreach ($artists as $artist) {
                    if ($modif) {
                        if ($artist->getId() === $albums->getArtiste()) {
                            echo "<option value=\"{$artist->getId()}\" selected>{$artist->getNom()}</option>";
                        } else {
                            // Create an option for each artist
                            echo "<option value=\"{$artist->getId()}\">{$artist->getNom()}</option>";
                        }
                    }else {
                        // Create an option for each artist
                        echo "<option value=\"{$artist->getId()}\">{$artist->getNom()}</option>";
                    }
                }
                ?>
            </select>
            <a href="adminArtist.php">Ajouter un artiste ...</a>

        </div>
        <div class="mb-3">
            <label for="annee" class="form-label">Année</label>
            <input type="text" class="form-control" id="annee" name="annee" <?php if ($modif) {
                echo "value='{$albums->getAnnee()}'";
            } ?>">
        </div>
        <div class="mb-3">
            <label for="genre" class="form-label">Genre</label>
            <input type="text" class="form-control" id="genre" name="genre" <?php if ($modif) {
                echo "value='{$albums->getGenre()}'";
            } ?>">
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <img src="fixtures/images/<?php if ($modif) {
                echo $albums->getUrlImage();
            } else {
                echo "default.jpg";
            } ?>" alt="Current Album Image" style="width: 100px; height: 100px;">
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <?php
         if($modif){
             echo "<button type=\"submit\" class=\"btn btn-primary\">Modifier</button>";
         }else{
                echo "<button type=\"submit\" class=\"btn btn-primary\">Ajouter</button>";
         }


        ?>
    </form>


</main>

<!-- Inclure Bootstrap JS (jQuery et Popper.js doivent être inclus avant) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
