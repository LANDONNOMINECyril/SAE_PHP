<?php

namespace Classes\models;

class TypeAlbum
{
    private int $albumId;
    private string $nomGenre;

    public function getAlbumId(): int
    {
        return $this->albumId;
    }

    public function setAlbumId(int $albumId): void
    {
        $this->albumId = $albumId;
    }

    public function getNomGenre(): string
    {
        return $this->nomGenre;
    }

    public function setNomGenre(string $nomGenre): void
    {
        $this->nomGenre = $nomGenre;
    }
}
