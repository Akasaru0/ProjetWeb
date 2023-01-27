<?php

class Bloc{
    private $nom;
    private $couleur;
    private $cotation;

    public function __construct($nom,$couleur,$cotation)
    {
        $this->nom = $nom;
        $this->couleur = $couleur;
        $this->cotation = $cotation;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }
    public function setCouleur($couleur): ?self
    {
        $this->couleur = $couleur;
        return $this;
    }

    public function getCotation(): ?string
    {
        return $this->cotation;
    }
    public function setCotation($cotation): ?self
    {
        $this->cotation = $cotation;
        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom($nom): ?self
    {
        $this->nom = $nom;
        return $this;
    }
}