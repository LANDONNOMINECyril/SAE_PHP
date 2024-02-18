<?php

namespace Classes\models;

class NotesAlbums
{
    private int $noteId;
    private int $userId;
    private int $albumId;
    private int $note;

    public function getNoteId(): int
    {
        return $this->noteId;
    }

    public function setNoteId(int $noteId): void
    {
        $this->noteId = $noteId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getAlbumId(): int
    {
        return $this->albumId;
    }

    public function setAlbumId(int $albumId): void
    {
        $this->albumId = $albumId;
    }

    public function getNote(): int
    {
        return $this->note;
    }

    public function setNote(int $note): void
    {
        // Ensure the note is between 1 and 10
        if ($note >= 1 && $note <= 10) {
            $this->note = $note;
        } else {
            // Handle invalid note values (you can throw an exception or handle it in your own way)
            throw new \InvalidArgumentException('Note must be between 1 and 10.');
        }
    }
}
