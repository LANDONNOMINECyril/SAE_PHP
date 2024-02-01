<?php

namespace classe\bd;

use classe\Artiste;
use PDO;
use PDOException;

class ArtisteBD
{
    public static function getAllArtistes(): array
    {
        try {
            $pdo = new PDO('sqlite:music.sqlite3');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $result = $pdo->query('SELECT * FROM ARTISTE');
            $artistes = array();
            foreach ($result as $row) {
                $artiste = new Artiste();
                $artiste->setId(intval($row['id']));
                $artiste->setNom($row['nom']);
                $artiste->setSurnom($row['surnom']);
                $artiste->setBio($row['bio']);
                $artiste->setUrlImage($row['urlImage']);
                $artistes[] = $artiste;
            }
            $pdo = null;
            return $artistes;
        } catch (PDOException $e) {
            echo "Error !: " . $e->getMessage() . "<br/>";
            die();
        }
    }



}