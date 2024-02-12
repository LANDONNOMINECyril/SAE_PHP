<?php

namespace Classes\bd;

require_once "Classes/models/Artiste.php";

use Classes\models\Artiste;
use PDO;
use PDOException;

class ArtisteBD
{
    public static function createArtistePhp($result): array|Artiste
    {
        $artistes = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $artiste = new Artiste();
            $artiste->setId(intval($row['artist_id']));
            $artiste->setNom($row['nom']);
            $artiste->setSurnom($row['artist_name']);
            if (isset($row['bio'])) {
                $artiste->setBio($row['bio']);
            } else {
                $artiste->setBio("Aucune biographie disponible");
            }
            if (isset($row['image_url'])) {
                $artiste->setUrlImage($row['image_url']);
            }
            $artiste->setAlbums(AlbumBD::getByArtiste($artiste->getId()));
            $artistes[] = $artiste;
        }
        if (count($artistes) === 1) {
            return $artistes[0]; // Retourne l'objet Album si un seul élément
        } else {
            return $artistes; // Retourne le tableau d'objets Album si plusieurs éléments
        }
    }


    public static function getAllArtistes(): array|Artiste
    {
        try {
            $pdo = new PDO('sqlite:bdd.sqlite3');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $result = $pdo->query('SELECT * FROM Artistes');
            $pdo = null;

            return self::createArtistePhp($result);
        } catch (PDOException $e) {
            echo "Error !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public static function getById($id): string|Artiste
    {
        try {
            $pdo = new PDO('sqlite:bdd.sqlite3');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare('SELECT nom FROM Artistes WHERE artist_id = :id');
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $artiste = $stmt->fetch(PDO::FETCH_ASSOC);
            $pdo = null;

            if ($artiste) {
                if (array_key_exists('nom', $artiste)) {
                    return $artiste['nom'];
                } else {
                    return "Nom d'artiste manquant dans le résultat de la requête";
                }
            } else {
                return "Artiste non trouvé";
            }
        } catch (PDOException $e) {
            echo "Error !: " . $e->getMessage() . "<br/>";
            die();
        }
    }


}