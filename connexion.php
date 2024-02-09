<?php

session_start();

require_once 'Classes/Autoloader.php';
use Symfony\Component\Yaml\Yaml;

// Connexion à la base de données (assurez-vous de remplacer ces valeurs par vos propres informations de connexion)

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dsn = 'sqlite:bdd.sqlite3';
    $user = $_POST['identifiant'];
    $mdp = $_POST['mdp'];

    try {
        $bdd = new PDO($dsn, $user, $mdp);
    } catch (PDOException $e) {
        echo 'Connexion échouée : ' . $e->getMessage();
    }


    if (!empty($_POST['identifiant']) && !empty($_POST['mdp'])) {
        // Requête pour vérifier les identifiants dans la base de données
        $query = "SELECT * FROM Utilisateurs WHERE nom_utilisateur = :identifiant";
        $stmt = $bdd->prepare($query);
        $stmt->execute(array(':identifiant' => $_POST['identifiant']));
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifier si l'utilisateur existe et si le mot de passe est correct
        if ($user && password_verify($mdp, $user['mot_de_passe'])) {
            print_r("ok");
            // Authentification réussie, rediriger vers la page d'accueil par exemple
            header("Location: connexion.php");
            exit;
        } else {
            // Identifiants invalides, afficher un message d'erreur
            $erreur = "Identifiant ou mot de passe incorrect.";
            print_r($erreur);
        }
    } else {
        // Champs manquants, afficher un message d'erreur
        $erreur = "Veuillez remplir tous les champs.";
        print_r($erreur);
    }
}

?>
