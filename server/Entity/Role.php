<?php

class Role{
    private $nom;

    public function __construct($nom)
    {
        $this->nom = $nom;
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