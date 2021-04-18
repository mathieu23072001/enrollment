<?php

namespace App\Entity;

use App\Repository\ModificationRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=ModificationRepository::class)
 */
class Modification
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
    private $Crv;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $creatAt;

    /**
     * @ORM\ManyToOne(targetEntity=Electeur::class, inversedBy="modifications")
     */
    private $electeur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCrv(): ?string
    {
        return $this->Crv;
    }

    public function setCrv(?string $Crv): self
    {
        $this->Crv = $Crv;

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

    public function getElecteur(): ?Electeur
    {
        return $this->electeur;
    }

    public function setElecteur(?Electeur $electeur): self
    {
        $this->electeur = $electeur;

        return $this;
    }
}
