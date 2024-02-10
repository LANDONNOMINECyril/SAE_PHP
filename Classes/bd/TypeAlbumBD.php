<?php

namespace Classes\bd;

require_once "Classes/models/TypeAlbum.php";

use Classes\models\TypeAlbum;
use PDO;
use PDOException;

date_default_timezone_set('Europe/Paris');

class TypeAlbumBD
{

    public static function createTypeAlbumPhp($result): array|TypeAlbum
    {
        $typesAlbum = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $typeAlbum = new TypeAlbum();
            $typeAlbum->setAlbumId(intval($row['album_id']));
            $typeAlbum->setNomGenre($row['nom_genre']);

            $typesAlbum[] = $typeAlbum;
        }

        if (count($typesAlbum) === 1) {
            return $typesAlbum[0]; // Retourne l'objet TypeAlbum si un seul élément
        } else {
            return $typesAlbum; // Retourne le tableau d'objets TypeAlbum si plusieurs éléments
        }
    }

    public static function getGenresByAlbumId($albumId): array|TypeAlbum
    {
        try {
            $pdo = new PDO('sqlite:bdd.sqlite3');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $result = $pdo->query('SELECT * FROM Types_Albums WHERE album_id = ' . $albumId);
            $pdo = null;
            return self::createTypeAlbumPhp($result);
        } catch (PDOException $e) {
            echo "Error !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public static function getAlbumsByGenre($genre): array|TypeAlbum
    {
        try {
            $pdo = new PDO('sqlite:bdd.sqlite3');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $result = $pdo->query('SELECT * FROM Types_Albums WHERE nom_genre = "' . $genre . '"');
            $pdo = null;
            return self::createTypeAlbumPhp($result);
        } catch (PDOException $e) {
            echo "Error !: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}
