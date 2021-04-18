<?php

namespace App\Entity;

use App\Repository\CeliRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CeliRepository::class)
 */
class Celi
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
     * @ORM\ManyToOne(targetEntity=Localite::class, inversedBy="celies")
     * @ORM\JoinColumn(nullable=false)
     */
    private $localite;

    /**
     * @ORM\OneToMany(targetEntity=Crv::class, mappedBy="celi")
     */
    private $Crvs;

    public function __construct()
    {
        $this->Crvs = new ArrayCollection();
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

    public function getLocalite(): ?Localite
    {
        return $this->localite;
    }

    public function setLocalite(?Localite $localite): self
    {
        $this->localite = $localite;

        return $this;
    }

    /**
     * @return Collection|Crv[]
     */
    public function getCrvs(): Collection
    {
        return $this->Crvs;
    }

    public function addCrv(Crv $crv): self
    {
        if (!$this->Crvs->contains($crv)) {
            $this->Crvs[] = $crv;
            $crv->setCeli($this);
        }

        return $this;
    }

    public function removeCrv(Crv $crv): self
    {
        if ($this->Crvs->contains($crv)) {
            $this->Crvs->removeElement($crv);
            // set the owning side to null (unless already changed)
            if ($crv->getCeli() === $this) {
                $crv->setCeli(null);
            }
        }

        return $this;
    }
}
