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
    use Classes\models\Artiste;


    $admin = $_SESSION['admin'];

    require "Classes/Autoloader.php";
    Autoloader::register();

    $id = $_GET['album_id'];
    $albums = \Classes\bd\AlbumBD::getById($id);

    /**
     * @param Album $nalbum
     * @return void
     */
    function extracted(Album|Artiste $nalbum): void
    {
        $tmp_name = $_FILES['image']['tmp_name'];
        // basename() may prevent filesystem traversal attacks;
        // further validation/sanitation of the filename may be appropriate
        $name = basename($_FILES['image']['name']);
        $target_dir = "fixtures/images/";
        $target_file = $target_dir . $name;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($tmp_name, $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
            $nalbum->setUrlImage($name);
        } else {
            echo "Failed to upload image.";
        }
    }


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
        $nalbum->setId($id);
        $nalbum->setTitre($titre);
        $nalbum->setArtiste($artiste);
        $nalbum->setAnnee($annee);
        $nalbum->setGenre($genre);


        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            extracted($nalbum);
        }else{
            $nalbum->setUrlImage($albums->getUrlImage());
        }
        AlbumBD::updateAlbum($nalbum);

        header("Location: album.php?album_id=$id");
        exit();
    }

    // Fetch all the artists
    $artists = \Classes\bd\ArtisteBD::getAllArtistes();
    ?>
    <form action=<?php echo "modifierAlbum.php?album_id=$id"?> method="post" enctype="multipart/form-data">
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
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <img src="fixtures/images/<?php echo $albums->getUrlImage(); ?>" alt="Current Album Image" style="width: 100px; height: 100px;">
            <input type="file" class="form-control" id="image" name="image" value="<?php echo $albums->getUrlImage(); ?>">
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>


</main>

<!-- Inclure Bootstrap JS (jQuery et Popper.js doivent être inclus avant) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
