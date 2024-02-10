<?php

namespace Classes\bd;

require_once "Classes/models/Album.php";

use Classes\models\Album;
use PDO;
use PDOException;

date_default_timezone_set('Europe/Paris');

class AlbumBD
{

    public static function createAlbumPhp($result): array|Album
    {
        $albums = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $album = new Album();
            $album->setId(intval($row['album_id']));
            $album->setTitre($row['titre']);
            $album->setArtiste($row['artist_id']);
            $album->setAnnee(intval($row['annee']));
            $album->setGenre($row['genre']);
    
            if (isset($row['image_url'])) {
                $album->setUrlImage($row['image_url']);
            }
    
            $albums[] = $album;
            //print_r($albums);
        }
    
        if (count($albums) === 1) {
            return $albums[0]; // Retourne l'objet Album si un seul élément
        } else {
            return $albums; // Retourne le tableau d'objets Album si plusieurs éléments
        }
    }
    
    
    public static function getAllAlbums(): array
    {
        try {
            $pdo = new PDO('sqlite:bdd.sqlite3');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $result = $pdo->query('SELECT * FROM Albums');
            $pdo = null;
            return self::createAlbumPhp($result);
        } catch (PDOException $e) {
            echo "Error !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public static function getById($id): Album
    {
        try {
            $pdo = new PDO('sqlite:bdd.sqlite3');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $result = $pdo->query('SELECT * FROM Albums WHERE album_id = ' . $id);
            $pdo = null;
            return self::createAlbumPhp($result);
        } catch (PDOException $e) {
            echo "Error !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public static function getByGenre($genre): array|Album
    {
        try {
            $pdo = new PDO('sqlite:bdd.sqlite3');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $result = $pdo->query('SELECT * FROM Albums WHERE genre = "' . $genre . '"');
            $pdo = null;
            return self::createAlbumPhp($result);
        } catch (PDOException $e) {
            echo "Error !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public static function getByAnnee($annee): array|Album
    {
        try {
            $pdo = new PDO('sqlite:bdd.sqlite3');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $result = $pdo->query('SELECT * FROM Albums WHERE annee = ' . $annee);
            $pdo = null;
            return self::createAlbumPhp($result);
        } catch (PDOException $e) {
            echo "Error !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public static function getByArtiste($artisteId): array|Album
    {
        try {
            $pdo = new PDO('sqlite:bdd.sqlite3');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $result = $pdo->query('SELECT * FROM Albums WHERE artist_id = "' . $artisteId . '"');
            $pdo = null;
            return self::createAlbumPhp($result);
        } catch (PDOException $e) {
            echo "Error !: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}