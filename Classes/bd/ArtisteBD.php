<?php

namespace Classes\bd;

require_once "Classes/models/Artiste.php";

use Classes\models\Artiste;
use PDO;
use PDOException;

class ArtisteBD
{
    public static function createArtistePhp($result): Artiste|array
{
    $artistes = array();

    if (is_array($result) && count($result) > 0) {
        foreach ($result as $row) {
            $artiste = new Artiste();
            $artiste->setId(intval($row['artist_id']) ? $row['artist_id'] : 15);
            
            $artiste->setNom(isset($row['nom']) ? $row['nom'] : "");
            $artiste->setSurnom(isset($row['artist_name']) ? $row['artist_name'] : "");

            if (isset($row['bio'])) {
                $artiste->setBio($row['bio']);
            } else {
                $artiste->setBio("Aucune biographie disponible");
            }

            if (isset($row['image_url'])) {
                $artiste->setUrlImage($row['image_url']);
            }

            $artiste->setAlbums(AlbumBD::getByArtiste($artiste->getId()));
            print_r($artistes);
            $artistes[] = $artiste;
        }
    } else {
        // Créer un artiste avec des données vides
        $artiste = new Artiste();
        $artiste->setId(15);
        $artiste->setNom("");
        $artiste->setSurnom("");
        $artiste->setBio("Aucune biographie disponible");
        $artiste->setAlbums([]);

        $artistes[] = $artiste;
    }

    if (count($artistes) === 1) {
        return $artistes[0]; // Retourne l'objet Artiste si un seul élément
    } else {
        return $artistes; // Retourne le tableau d'objets Artiste si plusieurs éléments
    }
}

    



    public static function getAllArtistes(): array
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
    
    public static function getById($id): Artiste|string
    {
        try {
            $pdo = new PDO('sqlite:bdd.sqlite3');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $result = $pdo->query('SELECT DISTINCT * FROM Artistes WHERE artist_id = ' . $id);
            $rows = $result->fetchAll(PDO::FETCH_ASSOC);
    
            $pdo = null;
    
            if ($rows && count($rows) > 0) {
                return self::createArtistePhp($rows);
            } else {
                return "Artiste non trouvé";
            }
        } catch (PDOException $e) {
            echo "Error !: " . $e->getMessage() . "<br/>";
            die();
        }
    }
    
    
    
}