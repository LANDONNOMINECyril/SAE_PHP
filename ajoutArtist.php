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
    use Classes\models\Artiste;

    $admin = $_SESSION['admin'];


    require "Classes/Autoloader.php";
    Autoloader::register();

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
            $nartiste->setUrlImage("default.jpg");
        }

        ArtisteBD::ajouterArtiste($nartiste);

        header("Location: accueil.php");
        exit();

    }

    ?>
    <form action="accueil.php" method="post">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom">
        </div>
        <div class="mb-3">
            <label for="surnom" class="form-label">Surnom</label>
            <input type="text" class="form-control" id="surnom" name="surnom">
        </div>
        <div class="mb-3">
            <label for="bio" class="form-label">Biographie</label>
            <textarea class="form-control" id="bio" name="bio" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">URL de l'image</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>

</main>
</body>
</html>