<?php

namespace Classes\models;

//require_once "Classes/bd/ArtisteBD.php";

//use Classes\bd\ArtisteBD;

class Genre
{
    private string $nom_genre;

    public function __construct(string $nom_genre)
    {
        $this->nom_genre = $nom_genre;
    }

    // Getter for nom_genre
    public function getNomGenre(): string
    {
        return $this->nom_genre;
    }

    // Setter for nom_genre
    public function setNomGenre(string $nom_genre): void
    {
        $this->nom_genre = $nom_genre;
    }
}
