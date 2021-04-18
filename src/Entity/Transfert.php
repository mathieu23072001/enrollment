<?php

namespace App\Entity;

use App\Repository\TransfertRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=TransfertRepository::class)
 */
class Transfert
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

   

    /**
     * @ORM\ManyToOne(targetEntity=Electeur::class, inversedBy="transferts")
     */
    private $electeur;

    /**
     * @ORM\ManyToOne(targetEntity=Crv::class, inversedBy="transferts")
     */
    private $crv;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $creatAt;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCrv(): ?Crv
    {
        return $this->crv;
    }

    public function setCrv(?Crv $crv): self
    {
        $this->crv = $crv;

        return $this;
    }

    public function getCreatAt(): ?\DateTimeInterface
    {
        return $this->creatAt;
    }

    public function setCreatAt(\DateTimeInterface $creatAt): self
    {
        $this->creatAt = $creatAt;

        return $this;
    }
}
