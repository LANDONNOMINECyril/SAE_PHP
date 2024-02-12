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
        $query = "SELECT type_uti ,user_id FROM Utilisateurs WHERE nom_utilisateur = :identifiant and mot_de_passe = :mdp";
        $stmt = $bdd->prepare($query);
        $stmt->bindParam(':identifiant', $user);
        $stmt->bindParam(':mdp', $mdp);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        $_SESSION['user'] = $user;
        $_SESSION['admin'] = !($res['type_uti'] == 1);
        // Vérifier si l'utilisateur existe et si le mot de passe est correct
        if ($res==null) {  
            header("Location: login.php?res=identifiants_invalides");
            exit;

        } else {
            header("Location: accueil.php");
            exit;
        }
    } else {
        // Champs manquants, afficher un message d'erreur
        header("Location: login.php?res=identifiants_manquants");
        exit;
    }
}
?>
