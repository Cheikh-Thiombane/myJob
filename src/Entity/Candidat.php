<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\PreUpdate;
use Doctrine\ORM\Mapping\PrePersist;
use App\Repository\CandidatRepository;

/**
 * @ORM\Entity(repositoryClass=CandidatRepository::class)
 * @ORM\HasLifecycleCallbacks
 */
class Candidat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $fichierCV;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $picture;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateNaiss;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="candidat", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity=Cv::class, mappedBy="candidat", cascade={"persist", "remove"})
     */
    private $cv;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity=OffreEmploi::class, inversedBy="candidats")
     */
    private $offres;

    /**
     * @ORM\OneToOne(targetEntity=Critere::class, mappedBy="candidat", cascade={"persist", "remove"})
     */
    private $critere;

    

    public function __construct()
    {
        $this->offres = new ArrayCollection();
    }

    /**
     * Permet d'initialiser le slug!
     * @ORM\PrePersist
     * @ORM\PreUpdate
     *
     * @return void
     */
    public function initializeSlug(){
        if (empty($this->slug)) {
            $slugify = new Slugify();
            $this->slug = $slugify->slugify($this->user->getFirstName() . ' ' .$this->user->getLastName());
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFichierCV()
    {
        return $this->fichierCV;
    }

    public function setFichierCV($fichierCV): self
    {
        $this->fichierCV = $fichierCV;

        return $this;
    }

    public function getPicture()
    {
        return $this->picture;
    }

    public function setPicture($picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getDateNaiss(): ?\DateTimeInterface
    {
        return $this->dateNaiss;
    }

    public function setDateNaiss(?\DateTimeInterface $dateNaiss): self
    {
        $this->dateNaiss = $dateNaiss;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCv(): ?Cv
    {
        return $this->cv;
    }

    public function setCv(Cv $cv): self
    {
        // set the owning side of the relation if necessary
        if ($cv->getCandidat() !== $this) {
            $cv->setCandidat($this);
        }

        $this->cv = $cv;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection|OffreEmploi[]
     */
    public function getOffres(): Collection
    {
        return $this->offres;
    }

    public function addOffre(OffreEmploi $offre): self
    {
        if (!$this->offres->contains($offre)) {
            $this->offres[] = $offre;
        }

        return $this;
    }

    public function removeOffre(OffreEmploi $offre): self
    {
        $this->offres->removeElement($offre);

        return $this;
    }

    public function getCritere(): ?Critere
    {
        return $this->critere;
    }

    public function setCritere(Critere $critere): self
    {
        // set the owning side of the relation if necessary
        if ($critere->getCandidat() !== $this) {
            $critere->setCandidat($this);
        }

        $this->critere = $critere;

        return $this;
    }






}
