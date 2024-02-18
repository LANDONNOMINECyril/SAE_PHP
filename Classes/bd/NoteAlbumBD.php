<?php

namespace Classes\bd;

require_once "Classes/models/NoteAlbum.php";

use Classes\models\NotesAlbums;
use PDO;
use PDOException;

session_start();

class NoteAlbumBD
{

    public static function createNotesAlbumPhp($result): array|NotesAlbums
    {
        $notesAlbums = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $noteAlbum = new NotesAlbums();
            $noteAlbum->setNoteId(intval($row['note_id']));
            $noteAlbum->setUserId(intval($row['user_id']));
            $noteAlbum->setAlbumId(intval($row['album_id']));
            $noteAlbum->setNote(intval($row['note']));

            $notesAlbums[] = $noteAlbum;
        }

        if (count($notesAlbums) === 1) {
            return $notesAlbums[0]; // Return the NotesAlbums object if only one element
        } else {
            return $notesAlbums; // Return the array of NotesAlbums objects if multiple elements
        }
    }

    public static function getNotesByAlbumId($albumId): array|NotesAlbums
    {
        try {
            $pdo = new PDO('sqlite:bdd.sqlite3');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $result = $pdo->query('SELECT * FROM Notes_Albums WHERE album_id = ' . $albumId);
            $pdo = null;
            return self::createNotesAlbumPhp($result);
        } catch (PDOException $e) {
            echo "Error !: " . $e->getMessage() . "<br/>";
            die();
        }
    }


    public static function ajouterNote($note, $album_id){
        try {
            $pdo = new PDO('sqlite:bdd.sqlite3');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            // Assume that you have the user ID and album ID available
            $user_id = $_SESSION['id'];
    
            // Check if a note already exists for the user and album
            $existingNoteStmt = $pdo->prepare('SELECT * FROM Notes_Albums WHERE user_id = :user_id AND album_id = :album_id');
            $existingNoteStmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $existingNoteStmt->bindParam(':album_id', $album_id, PDO::PARAM_INT);
            $existingNoteStmt->execute();
            $existingNote = $existingNoteStmt->fetch(PDO::FETCH_ASSOC);
    
            if ($existingNote) {
                // If a note already exists, update it
                $updateStmt = $pdo->prepare('UPDATE Notes_Albums SET note = :note WHERE user_id = :user_id AND album_id = :album_id');
                $updateStmt->bindParam(':note', $note, PDO::PARAM_INT);
                $updateStmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $updateStmt->bindParam(':album_id', $album_id, PDO::PARAM_INT);
                $result = $updateStmt->execute();
                //return self::createNotesAlbumPhp($result);
            } else {
                // If no note exists, insert a new one
                $insertStmt = $pdo->prepare('INSERT INTO Notes_Albums (user_id, album_id, note) VALUES (:user_id, :album_id, :note)');
                $insertStmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $insertStmt->bindParam(':album_id', $album_id, PDO::PARAM_INT);
                $insertStmt->bindParam(':note', $note, PDO::PARAM_INT);
                $result = $insertStmt->execute();
                //return self::createNotesAlbumPhp($result);
            }
    
            $pdo = null;
    
            return $result;
        } catch (PDOException $e) {
            echo "Error !: " . $e->getMessage() . "<br/>";
            die();
        }
    }
    

    // You can implement other methods similar to the ones in TypeAlbumBD as needed.
}
