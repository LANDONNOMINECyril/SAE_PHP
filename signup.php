<?php

session_start();

require_once 'Classes/Autoloader.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dsn = 'sqlite:bdd.sqlite3';
    $user = $_POST['identifiant'];
    $mdp = $_POST['mdp'];
    $email = $_POST['email'];

    try {
        $bdd = new PDO($dsn, $user, $mdp);
    } catch (PDOException $e) {
        echo 'Connexion échouée : ' . $e->getMessage();
    }

    if(!empty($user) && !empty($mdp) && !empty($email)) {
        $query = "SELECT nom_utilisateur FROM Utilisateurs WHERE nom_utilisateur = :identifiant and mot_de_passe = :mdp and email = :email";
        $stmt = $bdd->prepare($query);
        $stmt->bindParam(':identifiant', $user);
        $stmt->bindParam(':mdp', $mdp);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($res==null){
            $type_uti = 1;
            $query="INSERT INTO Utilisateurs (nom_utilisateur, mot_de_passe, email, type_uti) VALUES (:a, :b, :c, :d)";
            $stmt = $bdd->prepare($query);
            $stmt->bindParam(':a', $_POST['identifiant']);
            $stmt->bindParam(':b', $_POST['mdp']);
            $stmt->bindParam(':c', $_POST['email']);
            $stmt->bindParam(':d', $type_uti);
            $stmt->execute();
            header("Location: inscription.php?res=valide");
            exit;
            
        } else {
            header("Location: inscription.php?res=identifiants_existants ");
        }
    }
    else{
        header("Location: inscription.php?res=identifiants_manquants");
    }
}