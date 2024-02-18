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

    public static function getById($id): artiste
    {
        try {
            $pdo = new PDO('sqlite:bdd.sqlite3');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $result = $pdo->query('SELECT * FROM Artistes WHERE artist_id = ' . $id);
            $pdo = null;
            return self::createArtistePhp($result);
        } catch (PDOException $e) {
            echo "Error !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public static function getIdName($name): int
    {
        try {
            $pdo = new PDO('sqlite:bdd.sqlite3');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare('SELECT artist_id FROM Artistes WHERE nom = :name');
            $stmt->bindParam(':name', $name);
            $stmt->execute();

            $artiste = $stmt->fetch(PDO::FETCH_ASSOC);
            $pdo = null;

            if ($artiste) {
                if (array_key_exists('artist_id', $artiste)) {
                    return $artiste['artist_id'];
                } else {
                    return 0;
                }
            } else {
                return 0;
            }
        } catch (PDOException $e) {
            echo "Error !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public static function ajouterArtiste($artiste): void
    {
        try {
            $pdo = new PDO('sqlite:bdd.sqlite3');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare('INSERT INTO Artistes (nom, artist_name, bio, image_url) VALUES (:nom, :surnom, :bio, :image)');
            $stmt->bindParam(':nom', $artiste->getNom());
            $stmt->bindParam(':surnom', $artiste->getSurnom());
            $stmt->bindParam(':bio', $artiste->getBio());
            $stmt->bindParam(':image', $artiste->getUrlImage());
            $stmt->execute();

            $pdo = null;
        } catch (PDOException $e) {
            echo "Error !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public static function modifierArtiste($artiste): void
    {
        try {
            $pdo = new PDO('sqlite:bdd.sqlite3');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare('UPDATE Artistes SET nom = :nom, artist_name = :surnom, bio = :bio, image_url = :image WHERE artist_id = :id');
            $stmt->bindParam(':nom', $artiste->getNom());
            $stmt->bindParam(':surnom', $artiste->getSurnom());
            $stmt->bindParam(':bio', $artiste->getBio());
            $stmt->bindParam(':image', $artiste->getUrlImage());
            $stmt->bindParam(':id', $artiste->getId());
            $stmt->execute();

            $pdo = null;
        } catch (PDOException $e) {
            echo "Error !: " . $e->getMessage() . "<br/>";
            die();
        }
    }


    public static function deleteArtiste($name): void
    {
        try {
            $pdo = new PDO('sqlite:bdd.sqlite3');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec('DELETE FROM Artistes WHERE nom = "' . $name . '"');
            $pdo = null;
        } catch (PDOException $e) {
            echo "Error !: " . $e->getMessage() . "<br/>";
            die();
        }

    }
}