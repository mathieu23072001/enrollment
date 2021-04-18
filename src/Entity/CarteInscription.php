<?php

namespace App\Entity;

use App\Repository\CarteInscriptionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Range;

/**
 * @ORM\Entity(repositoryClass=CarteInscriptionRepository::class)
 */
class CarteInscription
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
    private $numeroCarte;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomCarte;

    /**
     * @ORM\Column(type="datetime")
     *  @Assert\Range(
     *    min = "01/01/1918 00:00:00",
     *    max = "now",
     *    notInRangeMessage = "Date invalide",
     * )
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\Range(
     *    min = "01/01/2021 00:00:00",
     *    max = "01/01/2030 00:00:00",
     *    notInRangeMessage = "Date invalide",
     * )
     */
    private $dateExpiration;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroCarte(): ?string
    {
        return $this->numeroCarte;
    }

    public function setNumeroCarte(string $numeroCarte): self
    {
        $this->numeroCarte = $numeroCarte;

        return $this;
    }

    public function getNomCarte(): ?string
    {
        return $this->nomCarte;
    }

    public function setNomCarte(string $nomCarte): self
    {
        $this->nomCarte = $nomCarte;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getDateExpiration(): ?\DateTimeInterface
    {
        return $this->dateExpiration;
    }

    public function setDateExpiration(\DateTimeInterface $dateExpiration): self
    {
        $this->dateExpiration = $dateExpiration;

        return $this;
    }
}
