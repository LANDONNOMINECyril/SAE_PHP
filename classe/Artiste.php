<?php

namespace classe;

class Artiste
{
    private int $id;
    private string $nom;
    private string $surnom;
    private string $bio;
    private string $urlImage;
    private array $albums;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function getSurnom(): string
    {
        return $this->surnom;
    }

    public function setSurnom(string $surnom): void
    {
        $this->surnom = $surnom;
    }

    public function getBio(): string
    {
        return $this->bio;
    }

    public function setBio(string $bio): void
    {
        $this->bio = $bio;
    }

    public function getUrlImage(): string
    {
        return $this->urlImage;
    }

    public function setUrlImage(string $urlImage): void
    {
        $this->urlImage = $urlImage;
    }

    public function getAlbums(): array
    {
        return $this->albums;
    }

    public function setAlbums(array $albums): void
    {
        $this->albums = $albums;
    }
}

