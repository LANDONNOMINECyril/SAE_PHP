<?php

namespace Classes\models;

require_once "Classes/bd/ArtisteBD.php";
require_once "Classes/bd/TypeAlbumBD.php";

use Classes\bd\ArtisteBD;
use Classes\bd\TypeAlbumBD;

class Album
{
    private int $id;
    private string $titre;
    private int $artiste;
    private int $annee;
    private string $genre;
    private string $urlImage = "";

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitre(): string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): void
    {
        $this->titre = $titre;
    }

    public function getArtisteId(): int
    {
        return $this->artiste;
    }

    public function getArtiste(): string
    {
        if(is_string(ArtisteBD::getById($this->artiste))){
            return ArtisteBD::getById($this->artiste);
        }
        return ArtisteBD::getById($this->artiste)->getNom(); // CETTE LIGNE POSE VRAIMENT UN PROBLÈME !!!!!!
        //return "Découvrir l'artiste";
    }

    public function setArtiste(int $artiste): void
    {
        $this->artiste = $artiste;
    }

    public function getAnnee(): int
    {
        return $this->annee;
    }

    public function setAnnee(int $annee): void
    {
        $this->annee = $annee;
    }

    public function getGenre(): string
    {
        $listeGenre = "";
        if(is_array(TypeAlbumBD::getGenresByAlbumId($this->getId()))){
            foreach(TypeAlbumBD::getGenresByAlbumId($this->getId()) as $genre){
                $listeGenre = $listeGenre . " , " . $genre->getNomGenre();
            }
            return $listeGenre;
        }
        return TypeAlbumBD::getGenresByAlbumId($this->getId())->getNomGenre();


    }

    public function setGenre(string $genre): void
    {
        $this->genre = $genre;
    }

    public function getUrlImage(): string
    {
        return $this->urlImage;
    }

    public function setUrlImage(string $urlImage): void
    {
        $this->urlImage = $urlImage;
    }

}