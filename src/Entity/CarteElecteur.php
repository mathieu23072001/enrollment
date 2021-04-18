<?php

namespace App\Entity;

use App\Repository\CarteElecteurRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=CarteElecteurRepository::class)
 */
class CarteElecteur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numeroForm;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numeroCarte;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $creatAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroForm(): ?string
    {
        return $this->numeroForm;
    }

    public function setNumeroForm(?string $numeroForm): self
    {
        $this->numeroForm = $numeroForm;

        return $this;
    }

    public function getNumeroCarte(): ?string
    {
        return $this->numeroCarte;
    }

    public function setNumeroCarte(?string $numeroCarte): self
    {
        $this->numeroCarte = $numeroCarte;

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
