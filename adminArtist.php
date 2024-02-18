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

    require "Classes/Autoloader.php";
    Autoloader::register();

    use Classes\bd\ArtisteBD;
    use Classes\models\Artiste;
    require_once 'Classes\Action\getImage.php';

    $admin = $_SESSION['admin'];

    $modif = false;

    if ($_GET['type'] === 'modif') {
        $id = $_GET['artiste_id'];
        $artiste = ArtisteBD::getById($id);
        $modif = true;
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nom = $_POST['nom'];
        $surnom = $_POST['surnom'];
        $bio = $_POST['bio'];

        $nartiste = new Artiste();
        $nartiste->setNom($nom);
        $nartiste->setSurnom($surnom);
        $nartiste->setBio($bio);

        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            extracted($nartiste);
        }else{
            $nartiste->setUrlImage($artiste->getUrlImage());
        }

        if($modif) {
            $nartiste->setId($id);
            ArtisteBD::modifierArtiste($nartiste);
            header("Location: pageArtiste.php?artist_id=$id");
        } else {
            ArtisteBD::ajouterArtiste($nartiste);
            header("Location: accueil.php");
        }
        exit();
    }

    if ($modif) {
        echo "<h1>Modifier un artiste</h1>";
    } else {
        echo "<h1>Ajouter un artiste</h1>";
    }

    if($modif) {
        echo "<form action='adminArtist.php?type=modif&artiste_id=$id' method='post' enctype=\"multipart/form-data\">";
    } else {
        echo "<form action='adminArtist.php' method='post' enctype=\"multipart/form-data\">";
    }

    ?>
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" <?php if($modif) {echo "value='{$artiste->getNom()}'";}  ?>>
        </div>
        <div class="mb-3">
            <label for="surnom" class="form-label">Surnom</label>
            <input type="text" class="form-control" id="surnom" name="surnom" <?php if($modif) {echo "value='{$artiste->getSurnom()}'";}  ?>>
        </div>
        <div class="mb-3">
            <label for="bio" class="form-label">Biographie</label>
            <textarea class="form-control" id="bio" name="bio" rows="3">
                <?php if($modif) {echo $artiste->getBio();} ?>
            </textarea>
        </div>
    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <img src="fixtures/images/<?php if ($modif) {
            echo $artiste->getUrlImage();
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
</body>
</html>