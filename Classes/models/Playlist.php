<?php

namespace Classes\models;

class Playlist
{
    private int $playlist_id;
    private string $user_id;
    private string $nom;

    public function getId(): int
    {
        return $this->playlist_id;
    }

    public function setId(int $id): void
    {
        $this->playlist_id = $id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function getIdUtilisateur(): int
    {
        return $this->user_id;
    }

}

