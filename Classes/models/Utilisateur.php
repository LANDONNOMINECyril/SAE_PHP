<?php

namespace Classes\models;

class Utilisateur
{
    private int $id;
    private string $nom;
    private string $mdp;
    private string $email;
    private string $urlImage;

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

    public function getMdp(): string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): void
    {
        $this->mdp = $mdp;
    }


    public function getUrlImage(): string
    {
        return $this->urlImage;
    }

    public function setUrlImage(string $urlImage): void
    {
        $this->urlImage = $urlImage;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
}

