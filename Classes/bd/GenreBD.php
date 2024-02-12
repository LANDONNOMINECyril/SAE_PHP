<?php

namespace Classes\bd;

require_once "Classes/models/Genre.php";

use Classes\models\Genre;
use PDO;
use PDOException;

date_default_timezone_set('Europe/Paris');

class GenreBD
{

    public static function createGenrePhp($result): array|Genre
    {
        $genres = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $genre = new Genre();
            $genre->setNomGenre($row['nom_genre']);

            $genres[] = $genre;
        }

        if (count($genres) === 1) {
            return $genres[0]; // Retourne l'objet Genre si un seul élément
        } else {
            return $genres; // Retourne le tableau d'objets Genre si plusieurs éléments
        }
    }

    public static function getAllGenres(): array
    {
        try {
            $pdo = new PDO('sqlite:bdd.sqlite3');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $result = $pdo->query('SELECT * FROM Genre');
            $pdo = null;
            return self::createGenrePhp($result);
        } catch (PDOException $e) {
            echo "Error !: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}
