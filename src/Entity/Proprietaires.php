<?php

namespace App\Entity;

use App\Repository\ProprietairesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProprietairesRepository::class)]
class Proprietaires
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $mail = null;

    #[ORM\Column(length: 255)]
    private ?string $tel = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\OneToMany(targetEntity: Bien::class, mappedBy: 'proprietaire', orphanRemoval: true)]
    private Collection $lesBiens;

    public function __construct()
    {
        $this->lesBiens = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): static
    {
        $this->mail = $mail;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): static
    {
        $this->tel = $tel;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function __toString(){
        return $this->nom." , ".$this->getMail();
    }

    /**
     * @return Collection<int, Bien>
     */
    public function getLesBiens(): Collection
    {
        return $this->lesBiens;
    }

    public function addLesBien(Bien $lesBien): static
    {
        if (!$this->lesBiens->contains($lesBien)) {
            $this->lesBiens->add($lesBien);
            $lesBien->setProprietaire($this);
        }

        return $this;
    }

    public function removeLesBien(Bien $lesBien): static
    {
        if ($this->lesBiens->removeElement($lesBien)) {
            // set the owning side to null (unless already changed)
            if ($lesBien->getProprietaire() === $this) {
                $lesBien->setProprietaire(null);
            }
        }

        return $this;
    }
}

