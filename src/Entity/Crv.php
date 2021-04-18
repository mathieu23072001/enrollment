<?php

namespace App\Entity;

use App\Repository\CrvRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CrvRepository::class)
 */
class Crv
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
    private $nom;

    /**
     * @ORM\Column(type="float")
     */
    private $longitude;

    /**
     * @ORM\Column(type="float")
     */
    private $latitude;

    /**
     * @ORM\ManyToOne(targetEntity=Celi::class, inversedBy="Crvs")
     */
    private $celi;

    /**
     * @ORM\OneToMany(targetEntity=OperateurSaisi::class, mappedBy="crv")
     */
    private $operateurSaisis;

    /**
     * @ORM\OneToMany(targetEntity=Electeur::class, mappedBy="crv")
     */
    private $electeurs;

    /**
     * @ORM\OneToMany(targetEntity=Transfert::class, mappedBy="crv")
     */
    private $transferts;

    public function __construct()
    {
        $this->operateurSaisis = new ArrayCollection();
        $this->electeurs = new ArrayCollection();
        $this->transferts = new ArrayCollection();
    }

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getCeli(): ?Celi
    {
        return $this->celi;
    }

    public function setCeli(?Celi $celi): self
    {
        $this->celi = $celi;

        return $this;
    }

    /**
     * @return Collection|OperateurSaisi[]
     */
    public function getOperateurSaisis(): Collection
    {
        return $this->operateurSaisis;
    }

    public function addOperateurSaisi(OperateurSaisi $operateurSaisi): self
    {
        if (!$this->operateurSaisis->contains($operateurSaisi)) {
            $this->operateurSaisis[] = $operateurSaisi;
            $operateurSaisi->setCrv($this);
        }

        return $this;
    }

    public function removeOperateurSaisi(OperateurSaisi $operateurSaisi): self
    {
        if ($this->operateurSaisis->contains($operateurSaisi)) {
            $this->operateurSaisis->removeElement($operateurSaisi);
            // set the owning side to null (unless already changed)
            if ($operateurSaisi->getCrv() === $this) {
                $operateurSaisi->setCrv(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Electeur[]
     */
    public function getElecteurs(): Collection
    {
        return $this->electeurs;
    }

    public function addElecteur(Electeur $electeur): self
    {
        if (!$this->electeurs->contains($electeur)) {
            $this->electeurs[] = $electeur;
            $electeur->setCrv($this);
        }

        return $this;
    }

    public function removeElecteur(Electeur $electeur): self
    {
        if ($this->electeurs->contains($electeur)) {
            $this->electeurs->removeElement($electeur);
            // set the owning side to null (unless already changed)
            if ($electeur->getCrv() === $this) {
                $electeur->setCrv(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Transfert[]
     */
    public function getTransferts(): Collection
    {
        return $this->transferts;
    }

    public function addTransfert(Transfert $transfert): self
    {
        if (!$this->transferts->contains($transfert)) {
            $this->transferts[] = $transfert;
            $transfert->setCrv($this);
        }

        return $this;
    }

    public function removeTransfert(Transfert $transfert): self
    {
        if ($this->transferts->contains($transfert)) {
            $this->transferts->removeElement($transfert);
            // set the owning side to null (unless already changed)
            if ($transfert->getCrv() === $this) {
                $transfert->setCrv(null);
            }
        }

        return $this;
    }

   
    

    
}
