<?php

namespace Classes\bd;

require_once "Classes/models/Album.php";

use Classes\models\Album;
use PDO;
use PDOException;

date_default_timezone_set('Europe/Paris');

class AlbumBD
{

    public static function createAlbumPhp($result): array {
        $albums = array();
        foreach ($result as $row) {
            $album = new Album();
            $album->setId(intval($row['album_id']));
            $album->setTitre($row['titre']);
            $album->setArtiste($row['artist_id']);
            $album->setAnnee(intval($row['annee']));
            
            if (isset($row['image_url'])) {
                $album->setUrlImage($row['image_url']);
            }
            
            $albums[] = $album;
        }
        return $albums;
    }
    

    
public static function getAlbumsbyQuery($search_query): array {
    try {
        $pdo = new PDO('sqlite:bdd.sqlite3');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Première requête pour rechercher par titre
        $stmt = $pdo->prepare("SELECT * FROM Albums WHERE titre LIKE :search_query");
        $stmt->bindValue(':search_query', '%' . $search_query . '%', PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Deuxième requête pour rechercher par genre
        $stmt = $pdo->prepare("SELECT * FROM Albums NATURAL JOIN Types_Albums WHERE nom_genre LIKE :search_query");
        $stmt->bindValue(':search_query', '%' . $search_query . '%', PDO::PARAM_STR);
        $stmt->execute();
        $result2 = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Requête pour rechercher par année
        $stmt = $pdo->prepare("SELECT * FROM Albums WHERE annee LIKE :search_query");
        $stmt->bindValue(':search_query', '%' . $search_query . '%', PDO::PARAM_STR);
        $stmt->execute();
        $result4 = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Requête pour rechercher par artiste
        $stmt = $pdo->prepare("SELECT artist_id FROM Artistes WHERE nom LIKE :search_query");
        $stmt->bindValue(':search_query', '%' . $search_query . '%', PDO::PARAM_STR);
        $stmt->execute();
        $resultintermediaire = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = $pdo->prepare("SELECT * FROM Albums WHERE artist_id = :id");
        $stmt->bindValue(':id', $resultintermediaire[0]["artist_id"], PDO::PARAM_STR);
        $stmt->execute();
        $result3 = $stmt->fetchAll(PDO::FETCH_ASSOC); 


        // Fusion des résultats
        $merged_results = array_merge($result, $result2, $result3, $result4);

        // Fermeture de la connexion
        $pdo = null;

        // Création des objets Album à partir des résultats fusionnés
        return self::createAlbumPhp($merged_results);
    } catch (PDOException $e) {
        echo "Error !: " . $e->getMessage() . "<br/>";
        die();
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
}