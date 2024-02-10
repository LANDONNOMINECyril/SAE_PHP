<?php

session_start();

require_once 'Classes/Autoloader.php';

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
        $query = "SELECT * FROM Utilisateurs WHERE nom_utilisateur = :identifiant and mot_de_passe = :mdp";
        $stmt = $bdd->prepare($query);
        $stmt->bindParam(':identifiant', $user);
        $stmt->bindParam(':mdp', $mdp);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        // Vérifier si l'utilisateur existe et si le mot de passe est correct
        if ($res==null) {
            // Identifiants invalides, afficher un message d'erreur

            $erreur = "Identifiant ou mot de passe incorrect.";
            print_r($erreur);

        } else {
            $_SESSION['id'] = $res['user_id'];
            // Authentification réussie, rediriger vers la page d'accueil par exemple
            header("Location: accueil.php");
            exit;       
        }
    } else {
        // Champs manquants, afficher un message d'erreur
        $erreur = "Veuillez remplir tous les champs.";
        print_r($erreur);
    }
}
?>
<!DOCTYPE html>
<link rel="stylesheet" href="connexion.css">
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Application spotify</title>
</head>
<body>
<main>
    <div id="centre">
        <button type="button" class="button" onclick="window.location.href='login.php'">Retour</button>
    </div>
</main>
</body>
</html>