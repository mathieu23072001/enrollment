<?php

namespace App\Entity;

use App\Repository\ElecteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints\DateTime;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Range;


/**
 * @Vich\Uploadable
 * @ORM\Entity(repositoryClass=ElecteurRepository::class)
 */
class Electeur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

     /**
     * @ORM\Column(type="string", length=255,nullable=true)
     * @var string
     */
    private $image;

     /**
     * @Vich\UploadableField(mapping="electeurs", fileNameProperty="image")
     * @var File
     */
    private $imageFile;


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
    private $pere;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mere;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\Range(
     *    min = "01/01/1900 00:00:00",
     *    max = "01/01/2002 00:00:00",
     *    notInRangeMessage = " Date invalide",
     * )
     */
    private $dateNaissance;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lieuNaissance;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $profession;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     *  @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     * 
     */
    private $dateInscription;

    

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sexe;

    

    

    /**
     * @ORM\ManyToOne(targetEntity=OperateurSaisi::class, inversedBy="electeurs")
     */
    private $operat;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $carteInscription;

    /**
     * @ORM\OneToMany(targetEntity=Contentieux::class, mappedBy="electeur")
     */
    private $contentieuxes;

    /**
     * @ORM\ManyToOne(targetEntity=Crv::class, inversedBy="electeurs")
     */
    private $crv;

    /**
     * @ORM\OneToMany(targetEntity=Transfert::class, mappedBy="electeur")
     */
    private $transferts;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updateAt;

    /**
     * @ORM\OneToOne(targetEntity=CarteInscription::class, cascade={"persist", "remove"})
     */
    private $piece;

    /**
     * @ORM\OneToOne(targetEntity=CarteElecteur::class, cascade={"persist", "remove"})
     */
    private $carteElec;

    /**
     * @ORM\OneToMany(targetEntity=Modification::class, mappedBy="electeur")
     */
    private $modifications;

    /**
     * @ORM\Column(type="binary", nullable=true)
     */
    private $etat;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $rad;

    public function __construct()
    {
        $this->contentieuxes = new ArrayCollection();
        $this->transferts = new ArrayCollection();
        $this->modifications = new ArrayCollection();
        
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

    public function getPere(): ?string
    {
        return $this->pere;
    }

    public function setPere(string $pere): self
    {
        $this->pere = $pere;

        return $this;
    }

    public function getMere(): ?string
    {
        return $this->mere;
    }

    public function setMere(string $mere): self
    {
        $this->mere = $mere;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getLieuNaissance(): ?string
    {
        return $this->lieuNaissance;
    }

    public function setLieuNaissance(string $lieuNaissance): self
    {
        $this->lieuNaissance = $lieuNaissance;

        return $this;
    }

    public function getProfession(): ?string
    {
        return $this->profession;
    }

    public function setProfession(string $profession): self
    {
        $this->profession = $profession;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->dateInscription;
    }

   
   /* public function setDateInscription(\DateTimeInterface $dateInscription): self
    {
        $this->dateInscription = $dateInscription;

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

   
  
   

   
    public function getOperat(): ?OperateurSaisi
    {
        return $this->operat;
    }

    public function setOperat(?OperateurSaisi $operat): self
    {
        $this->operat = $operat;

        return $this;
    }

    public function getCarteInscription(): ?string
    {
        return $this->carteInscription;
    }

    public function setCarteInscription(string $carteInscription): self
    {
        $this->carteInscription = $carteInscription;

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
            $contentieux->setElecteur($this);
        }

        return $this;
    }

    public function removeContentieux(Contentieux $contentieux): self
    {
        if ($this->contentieuxes->contains($contentieux)) {
            $this->contentieuxes->removeElement($contentieux);
            // set the owning side to null (unless already changed)
            if ($contentieux->getElecteur() === $this) {
                $contentieux->setElecteur(null);
            }
        }

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
            $transfert->setElecteur($this);
        }

        return $this;
    }

    public function removeTransfert(Transfert $transfert): self
    {
        if ($this->transferts->contains($transfert)) {
            $this->transferts->removeElement($transfert);
            // set the owning side to null (unless already changed)
            if ($transfert->getElecteur() === $this) {
                $transfert->setElecteur(null);
            }
        }

        return $this;
    }


    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->updateAt;
    }

    public function setUpdateAt(?\DateTimeInterface $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    public function getPiece(): ?CarteInscription
    {
        return $this->piece;
    }

    public function setPiece(?CarteInscription $piece): self
    {
        $this->piece = $piece;

        return $this;
    }

    public function getCarteElec(): ?CarteElecteur
    {
        return $this->carteElec;
    }

    public function setCarteElec(?CarteElecteur $carteElec): self
    {
        $this->carteElec = $carteElec;

        return $this;
    }

    /**
     * @return Collection|Modification[]
     */
    public function getModifications(): Collection
    {
        return $this->modifications;
    }

    public function addModification(Modification $modification): self
    {
        if (!$this->modifications->contains($modification)) {
            $this->modifications[] = $modification;
            $modification->setElecteur($this);
        }

        return $this;
    }

    public function removeModification(Modification $modification): self
    {
        if ($this->modifications->contains($modification)) {
            $this->modifications->removeElement($modification);
            // set the owning side to null (unless already changed)
            if ($modification->getElecteur() === $this) {
                $modification->setElecteur(null);
            }
        }

        return $this;
    }

    public function getEtat()
    {
        return $this->etat;
    }

    public function setEtat($etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getRad(): ?bool
    {
        return $this->rad;
    }

    public function setRad(?bool $rad): self
    {
        $this->rad = $rad;

        return $this;
    }

   

}
