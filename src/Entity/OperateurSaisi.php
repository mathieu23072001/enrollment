<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\OperateurSaisiRepository;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=OperateurSaisiRepository::class)
 */
class OperateurSaisi
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
    private $prenom;

   

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $CreatAt;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $sexe;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="operateurSaisis",cascade={"persist"})
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Crv::class, inversedBy="operateurSaisis")
     */
    private $crv;

    /**
     * @ORM\OneToMany(targetEntity=Electeur::class, mappedBy="operat")
     */
    private $electeurs;

    /**
     * @ORM\OneToMany(targetEntity=Contentieux::class, mappedBy="operat")
     */
    private $contentieuxes;

    public function __construct()
    {
        $this->electeurs = new ArrayCollection();
        $this->contentieuxes = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

  
   
    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getCreatAt(): ?\DateTimeInterface
    {
        return $this->CreatAt;
    }

  /*  public function setCreatAt(\DateTimeInterface $CreatAt): self
    {
        $this->CreatAt = $CreatAt;

        return $this;
    }*/

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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
            $electeur->setOperat($this);
        }

        return $this;
    }

    public function removeElecteur(Electeur $electeur): self
    {
        if ($this->electeurs->contains($electeur)) {
            $this->electeurs->removeElement($electeur);
            // set the owning side to null (unless already changed)
            if ($electeur->getOperat() === $this) {
                $electeur->setOperat(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Contentieux[]
     */
    public function getContentieuxes(): Collection
    {
        return $this->contentieuxes;
    }

    public function addContentieux(Contentieux $contentieux): self
    {
        if (!$this->contentieuxes->contains($contentieux)) {
            $this->contentieuxes[] = $contentieux;
            $contentieux->setOperat($this);
        }

        return $this;
    }

    public function removeContentieux(Contentieux $contentieux): self
    {
        if ($this->contentieuxes->contains($contentieux)) {
            $this->contentieuxes->removeElement($contentieux);
            // set the owning side to null (unless already changed)
            if ($contentieux->getOperat() === $this) {
                $contentieux->setOperat(null);
            }
        }

        return $this;
    }
}
