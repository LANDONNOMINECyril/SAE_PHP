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
            //$album->setGenre($row['genre']);
    
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

    // public static function getByGenre($genre): array|Album
    // {
    //     try {
    //         $pdo = new PDO('sqlite:bdd.sqlite3');
    //         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //         $result = $pdo->query('SELECT * FROM Albums WHERE Genre = "' . $genre . '"');
    //         $pdo = null;
    //         return self::createAlbumPhp($result);
    //     } catch (PDOException $e) {
    //         echo "Error !: " . $e->getMessage() . "<br/>";
    //         die();
    //     }
    // }

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

    public static function deleteAlbum($title): void
    {
        try {
            $pdo = new PDO('sqlite:bdd.sqlite3');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec('DELETE FROM Albums WHERE titre = "' . $title . '"');
            $pdo = null;
        } catch (PDOException $e) {
            echo "Error !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public static function updateAlbum($album): void
    {
        try{
            $pdo = new PDO('sqlite:bdd.sqlite3');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo->prepare('UPDATE Albums SET titre = :titre, artist_id = :artiste, annee = :annee, image_url = :image WHERE album_id = :id');
            $stmt->bindParam(':titre', $album->getTitre());
            $stmt->bindParam(':artiste', $album->getArtisteId());
            $stmt->bindParam(':annee', $album->getAnnee());
            $stmt->bindParam(':image', $album->getUrlImage());
            $stmt->bindParam(':id', $album->getId());
            $stmt->execute();
            $pdo = null;
        } catch (PDOException $e) {
            echo "Error !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public static function ajouterAlbum($nalbum): void
    {
        try{
            $pdo = new PDO('sqlite:bdd.sqlite3');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo->prepare('INSERT INTO Albums (titre, artist_id, annee, image_url) VALUES (:titre, :artiste, :annee, :image)');
            $stmt->bindParam(':titre', $nalbum->getTitre());
            $stmt->bindParam(':artiste', $nalbum->getArtisteId());
            $stmt->bindParam(':annee', $nalbum->getAnnee());
            $stmt->bindParam(':image', $nalbum->getUrlImage());
            $stmt->execute();
            $pdo = null;
        } catch (PDOException $e) {
            echo "Error !: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}