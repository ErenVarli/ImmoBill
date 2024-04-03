<?php

namespace App\Entity;

class BienSearch{
    private ?int $surface = null;
    private ?int $prixMax = null;
    private ?string $ville = null;

    

    /**
     * Get the value of surface
     */
    public function getSurface(): ?int
    {
        return $this->surface;
    }

    /**
     * Set the value of surface
     */
    public function setSurface(?int $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    /**
     * Get the value of prixMax
     */
    public function getPrixMax(): ?int
    {
        return $this->prixMax;
    }

    /**
     * Set the value of prixMax
     */
    public function setPrixMax(?int $prixMax): self
    {
        $this->prixMax = $prixMax;

        return $this;
    }

    /**
     * Get the value of ville
     */
    public function getVille(): ?string
    {
        return $this->ville;
    }

    /**
     * Set the value of ville
     */
    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }
}