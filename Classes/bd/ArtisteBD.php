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

    foreach ($result as $row) {
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
        print_r($artistes);
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

    public static function getById($id): Artiste
    {
        try {
            $pdo = new PDO('sqlite:bdd.sqlite3');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $result = $pdo->query('SELECT DISTINCT * FROM Artistes WHERE artist_id = ' . $id);

            $pdo = null;
            return self::createArtistePhp($result);
        } catch (PDOException $e) {
            echo "Error !: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}