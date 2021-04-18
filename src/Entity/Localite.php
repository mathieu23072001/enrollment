<?php

namespace App\Entity;

use App\Repository\LocaliteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LocaliteRepository::class)
 */
class Localite
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
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prefecture;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $region;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $canton;

    /**
     * @ORM\OneToMany(targetEntity=Celi::class, mappedBy="localite")
     */
    private $celies;

    public function __construct()
    {
        $this->celies = new ArrayCollection();
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

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getPrefecture(): ?string
    {
        return $this->prefecture;
    }

    public function setPrefecture(string $prefecture): self
    {
        $this->prefecture = $prefecture;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getCanton(): ?string
    {
        return $this->canton;
    }

    public function setCanton(string $canton): self
    {
        $this->canton = $canton;

        return $this;
    }

    /**
     * @return Collection|Celi[]
     */
    public function getCelies(): Collection
    {
        return $this->celies;
    }

    public function addCely(Celi $cely): self
    {
        if (!$this->celies->contains($cely)) {
            $this->celies[] = $cely;
            $cely->setLocalite($this);
        }

        return $this;
    }

    public function removeCely(Celi $cely): self
    {
        if ($this->celies->contains($cely)) {
            $this->celies->removeElement($cely);
            // set the owning side to null (unless already changed)
            if ($cely->getLocalite() === $this) {
                $cely->setLocalite(null);
            }
        }

        return $this;
    }
}
