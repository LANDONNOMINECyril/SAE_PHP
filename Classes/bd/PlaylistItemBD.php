<?php

namespace Classes\bd;

require_once "Classes/models/PlaylistItem.php";

use Classes\models\PlaylistItem;
use PDO;
use PDOException;

date_default_timezone_set('Europe/Paris');
session_start();

class PlaylistItemBD
{

    public static function createPlaylistItemPhp($albumId): array | string | PlaylistItem
    {
        try {
            $pdo = new PDO('sqlite:bdd.sqlite3');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $playlistId = $_SESSION['id'];
            $albumId = intval($albumId);
            $ordre = intval(1);
    
            $stmt = $pdo->prepare('INSERT INTO Playlist_items (playlist_id, album_id, ordre) VALUES (:playlist_id, :album_id, :ordre)');
            $stmt->bindParam(':playlist_id', $playlistId, PDO::PARAM_INT);
            $stmt->bindParam(':album_id', $albumId, PDO::PARAM_INT);
            $stmt->bindParam(':ordre', $ordre, PDO::PARAM_INT);
    
            $result = $stmt->execute();
    
            $pdo = null;
    
            return $result;
        } catch (PDOException $e) {
            echo "Error !: " . $e->getMessage() . "<br/>";
            die();
        }
    }
    
    public static function getById($id_user): array | PlaylistItem | string
{
    try {
        $pdo = new PDO('sqlite:bdd.sqlite3');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare('SELECT album_id FROM Playlist_items WHERE playlist_id = :id_user');
        $stmt->bindParam(':id_user', $id_user);
        $stmt->execute();

        $playlistItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $pdo = null;

        if ($playlistItems) {
            $result = array();
            foreach ($playlistItems as $item) {
                if (array_key_exists('album_id', $item)) {
                    $result[] = $item['album_id'];
                } else {
                    return "id de playlist_Item manquant dans le résultat de la requête";
                }
            }
            return $result;
        } else {
            return "Aucun item trouvé";
        }
    } catch (PDOException $e) {
        echo "Error !: " . $e->getMessage() . "<br/>";
        die();
    }
}

    
}