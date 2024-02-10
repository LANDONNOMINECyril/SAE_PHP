<?php
require_once 'Classes/data/bd.php';
createBD();

session_start();

require_once "Classes/Autoloader.php";
Autoloader::register();

// Chargez les classes avec les espaces de noms
use Classes\bd\AlbumBD;
use Classes\bd\ArtisteBD;
use Symfony\Component\Yaml\Yaml;

$erreur = ""; // Initialiser la variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dsn = 'sqlite:bdd.sqlite3';
    $user = $_POST['identifiant'];
    $mdp = $_POST['mdp'];
    $email = $_POST['email'];

    try {
        $bdd = new PDO($dsn, $user, $mdp);
    } catch (PDOException $e) {
        echo 'Échec de la connexion : ' . $e->getMessage();
        exit;
    }

    if (!empty($user) && !empty($mdp) && !empty($email)) {
        // Utiliser des requêtes préparées pour éviter les injections SQL
        $query = "SELECT nom_utilisateur FROM Utilisateurs WHERE nom_utilisateur = :identifiant and mot_de_passe = :mdp and email = :email";
        $stmt = $bdd->prepare($query);
        $stmt->bindParam(':identifiant', $user);
        $stmt->bindParam(':mdp', $mdp);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($res == null) {
            // Hasher le mot de passe avant de le stocker

            $query = "INSERT INTO Utilisateurs (nom_utilisateur, mot_de_passe, email) VALUES (:a, :b, :c)";
            $stmt = $bdd->prepare($query);
            $stmt->bindParam(':a', $_REQUEST['identifiant']);
            $stmt->bindParam(':b', $_REQUEST["mdp"]);
            $stmt->bindParam(':c', $_REQUEST['email']);
            //$stmt->execute();
            
            // Ajouter cette ligne pour voir les messages d'erreur lors de l'exécution de la requête
            if (!$stmt->execute()) {
                print_r($stmt->errorInfo());
                exit;
            }
            
            header("Location: validation.php");
            exit;
        } else {
            $erreur = "Votre compte existe déjà, connectez-vous avec vos identifiants.";
        }
    } else {
        $erreur = "Veuillez remplir tous les champs.";
    }
}
?>

<!DOCTYPE html>
<link rel="stylesheet" href="signup.css">
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Application spotify</title>
</head>
<body>
<main>
    <div id="centre">
        <?php if($erreur == "Veuillez remplir tous les champ"){?>
            <button type="button" class="button" onclick="window.location.href='inscription.php'">Retour</button>
        <?php }
        else{?>
        <button type="button" class="button" onclick="window.location.href='login.php'">Retour</button>
        <?php } ?>
    </div>
</main>
</body>
</html>