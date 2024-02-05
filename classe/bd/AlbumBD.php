<?php

namespace classe\bd;

use classe\Album;
use PDO;
use PDOException;

date_default_timezone_set('Europe/Paris');

class AlbumBD
{

    public static function createArtistePhp($result): array|Album
    {
        $album = array();
        foreach ($result as $row) {
            $album = new Album();
            $album->setId(intval($row['id']));
            $album->setTitre($row['titre']);
            $album->setArtiste($row['artiste']);
            $album->setAnnee(intval($row['annee']));
            $album->setGenre($row['genre']);
            $album->setUrlImage($row['urlImage']);
        }
        return $album;
    }

    public static function getAllAlbums(): array
    {
        try {
            $pdo = new PDO('sqlite:music.sqlite3');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $result = $pdo->query('SELECT * FROM ALBUM');
            $pdo = null;
            return self::createArtistePhp($result);
        } catch (PDOException $e) {
            echo "Error !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public static function getById($id): Album
    {
        try {
            $pdo = new PDO('sqlite:music.sqlite3');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $result = $pdo->query('SELECT * FROM ALBUM WHERE id = ' . $id);
            $pdo = null;
            return self::createArtistePhp($result);
        } catch (PDOException $e) {
            echo "Error !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public static function getByGenre($genre): array|Album
    {
        try {
            $pdo = new PDO('sqlite:music.sqlite3');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $result = $pdo->query('SELECT * FROM ALBUM WHERE genre = "' . $genre . '"');
            $pdo = null;
            return self::createArtistePhp($result);
        } catch (PDOException $e) {
            echo "Error !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public static function getByAnnee($annee): array|Album
    {
        try {
            $pdo = new PDO('sqlite:music.sqlite3');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $result = $pdo->query('SELECT * FROM ALBUM WHERE annee = ' . $annee);
            $pdo = null;
            return self::createArtistePhp($result);
        } catch (PDOException $e) {
            echo "Error !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public static function getByArtiste($artiste): array|Album
    {
        try {
            $pdo = new PDO('sqlite:music.sqlite3');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $result = $pdo->query('SELECT * FROM ALBUM WHERE artiste = "' . $artiste . '"');
            $pdo = null;
            return self::createArtistePhp($result);
        } catch (PDOException $e) {
            echo "Error !: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}