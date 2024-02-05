<?php

namespace Classes\bd;

require "Classes/models/Utilisateur.php";

use Classes\models\Utilisateur;
use PDO;
use PDOException;

class UtilisateurBD
{
    public static function createUtilisateurPhp($result): array|Utilisateur
    {
        $utilisateur = array();
        foreach ($result as $row) {
            $utilisateur = new Utilisateur();
            $utilisateur->setId(intval($row['user_id']));
            $utilisateur->setNom($row['nom_utilisateur']);
            $utilisateur->setMdp($row['mot_de_passe']);
            $utilisateur->setEmail($row['email']);
            if (isset($row['image_url'])) {
                $utilisateur->setUrlImage($row['image_url']);
            }
        }
        return $utilisateur;
    }

    public static function getById($id): Utilisateur
    {
        try {
            $pdo = new PDO('sqlite:bdd.sqlite3');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $result = $pdo->query('SELECT * FROM Utilisateurs WHERE user_id = ' . $id);
            $pdo = null;
            return self::createUtilisateurPhp($result);
        } catch (PDOException $e) {
            echo "Error !: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}
