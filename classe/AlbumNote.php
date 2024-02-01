<?php

namespace classe;

class AlbumNote
{
    private int $note_id;
    private int $user_id;
    private int $album_id;
    private int $note;

    public function getNoteId(): int
    {
        return $this->note_id;
    }

    public function setNoteId(int $note_id): void
    {
        $this->note_id = $note_id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getAlbumId(): int
    {
        return $this->album_id;
    }

    public function setAlbumId(int $album_id): void
    {
        $this->album_id = $album_id;
    }

    public function getNote(): int
    {
        return $this->note;
    }

    public function setNote(int $note): void
    {
        // Assurez-vous que la note est comprise entre 1 et 10
        if ($note >= 1 && $note <= 10) {
            $this->note = $note;
        } else {
            // Gérer l'erreur ou lancer une exception selon vos besoins
            throw new \InvalidArgumentException("La note doit être comprise entre 1 et 10.");
        }
    }
}
