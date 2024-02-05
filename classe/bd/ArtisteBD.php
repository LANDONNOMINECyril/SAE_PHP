<?php

namespace classe\bd;

use classe\Artiste;
use PDO;
use PDOException;

class ArtisteBD
{

    public static function createArtistePhp($result): array|Artiste{
        $artiste = array();
        foreach ($result as $row) {
            $artiste = new Artiste();
            $artiste->setId(intval($row['id']));
            $artiste->setNom($row['nom']);
            $artiste->setSurnom($row['surnom']);
            $artiste->setBio($row['bio']);
            $artiste->setUrlImage($row['urlImage']);
            $artiste->setAlbums(AlbumBD::getByArtiste($artiste->getId()));
        }
        return $artiste;
    }
    public static function getAllArtistes(): array
    {
        try {
            $pdo = new PDO('sqlite:music.sqlite3');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $result = $pdo->query('SELECT * FROM ARTISTE');
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
            $pdo = new PDO('sqlite:music.sqlite3');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $result = $pdo->query('SELECT * FROM ARTISTE WHERE id = ' . $id);
            $pdo = null;
            return self::createArtistePhp($result);
        } catch (PDOException $e) {
            echo "Error !: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}