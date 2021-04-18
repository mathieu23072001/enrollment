<?php

namespace App\Entity;

use App\Repository\ContentieuxRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=ContentieuxRepository::class)
 */
class Contentieux
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomPlaignant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenomPlaignant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adressePlaignant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $professionPlaignant;

    /**
     * @ORM\Column(type="text")
     */
    private $descriptionPlainte;

    /**
     * @ORM\ManyToOne(targetEntity=Electeur::class, inversedBy="contentieuxes")
     */
    private $electeur;

    /**
     * 
     * @ORM\ManyToOne(targetEntity=OperateurSaisi::class, inversedBy="contentieuxes")
     */
    private $operat;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $creatAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPlaignant(): ?string
    {
        return $this->nomPlaignant;
    }

    public function setNomPlaignant(string $nomPlaignant): self
    {
        $this->nomPlaignant = $nomPlaignant;

        return $this;
    }

    public function getPrenomPlaignant(): ?string
    {
        return $this->prenomPlaignant;
    }

    public function setPrenomPlaignant(string $prenomPlaignant): self
    {
        $this->prenomPlaignant = $prenomPlaignant;

        return $this;
    }

    public function getAdressePlaignant(): ?string
    {
        return $this->adressePlaignant;
    }

    public function setAdressePlaignant(string $adressePlaignant): self
    {
        $this->adressePlaignant = $adressePlaignant;

        return $this;
    }

    public function getProfessionPlaignant(): ?string
    {
        return $this->professionPlaignant;
    }

    public function setProfessionPlaignant(string $professionPlaignant): self
    {
        $this->professionPlaignant = $professionPlaignant;

        return $this;
    }

    public function getDescriptionPlainte(): ?string
    {
        return $this->descriptionPlainte;
    }

    public function setDescriptionPlainte(string $descriptionPlainte): self
    {
        $this->descriptionPlainte = $descriptionPlainte;

        return $this;
    }

    public function getElecteur(): ?Electeur
    {
        return $this->electeur;
    }

    public function setElecteur(?Electeur $electeur): self
    {
        $this->electeur = $electeur;

        return $this;
    }

    public function getOperat(): ?OperateurSaisi
    {
        return $this->operat;
    }

    public function setOperat(?OperateurSaisi $operat): self
    {
        $this->operat = $operat;

        return $this;
    }

    public function getCreatAt(): ?\DateTimeInterface
    {
        return $this->creatAt;
    }

    public function setCreatAt(?\DateTimeInterface $creatAt): self
    {
        $this->creatAt = $creatAt;

        return $this;
    }
}
