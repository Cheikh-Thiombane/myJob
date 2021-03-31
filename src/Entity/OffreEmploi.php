<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\OffreEmploiRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=OffreEmploiRepository::class)
 * @ORM\HasLifecycleCallbacks
 */
class OffreEmploi
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $poste;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbPoste;

    /**
     * @ORM\Column(type="text")
     */
    private $descriptionPoste;

    /**
     * @ORM\Column(type="text")
     */
    private $descriptionProfil;

    /**
     * @ORM\Column(type="array")
     */
    private $secteurActivite = [];

    /**
     * @ORM\Column(type="array")
     */
    private $metier = [];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typeContrat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $region;

    /**
     * @ORM\Column(type="integer")
     */
    private $niveauEtude;

    /**
     * @ORM\Column(type="integer")
     */
    private $niveauExperience;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $langues = [];

    /**
     * @ORM\ManyToOne(targetEntity=Entreprise::class, inversedBy="offreEmplois")
     * @ORM\JoinColumn(nullable=false)
     */
    private $entreprise;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="offreEmplois")
     */
    private $users;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity=Candidat::class, mappedBy="offres")
     */
    private $candidats;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->candidats = new ArrayCollection();
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
            $this->slug = $slugify->slugify($this->poste.''.$this->entreprise->getId());
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPoste(): ?string
    {
        return $this->poste;
    }

    public function setPoste(string $poste): self
    {
        $this->poste = $poste;

        return $this;
    }

    public function getNbPoste(): ?int
    {
        return $this->nbPoste;
    }

    public function setNbPoste(int $nbPoste): self
    {
        $this->nbPoste = $nbPoste;

        return $this;
    }

    public function getDescriptionPoste(): ?string
    {
        return $this->descriptionPoste;
    }

    public function setDescriptionPoste(string $descriptionPoste): self
    {
        $this->descriptionPoste = $descriptionPoste;

        return $this;
    }

    public function getDescriptionProfil(): ?string
    {
        return $this->descriptionProfil;
    }

    public function setDescriptionProfil(string $descriptionProfil): self
    {
        $this->descriptionProfil = $descriptionProfil;

        return $this;
    }

    public function getSecteurActivite(): ?array
    {
        return $this->secteurActivite;
    }

    public function setSecteurActivite(?array $secteurActivite): self
    {
        $this->secteurActivite = $secteurActivite;

        return $this;
    }

    public function getMetier(): ?array
    {
        return $this->metier;
    }

    public function setMetier(?array $metier): self
    {
        $this->metier = $metier;

        return $this;
    }


    public function getTypeContrat(): ?string
    {
        return $this->typeContrat;
    }

    public function setTypeContrat(string $typeContrat): self
    {
        $this->typeContrat = $typeContrat;

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

    public function getNiveauEtude(): ?int
    {
        return $this->niveauEtude;
    }

    public function setNiveauEtude(int $niveauEtude): self
    {
        $this->niveauEtude = $niveauEtude;

        return $this;
    }

    public function getNiveauExperience(): ?int
    {
        return $this->niveauExperience;
    }

    public function setNiveauExperience(int $niveauExperience): self
    {
        $this->niveauExperience = $niveauExperience;

        return $this;
    }

    public function getLangues(): ?array
    {
        return $this->langues;
    }

    public function setLangues( $langues): self
    {
        $this->langues = $langues;

        return $this;
    }

    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addOffreEmploi($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeOffreEmploi($this);
        }

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
     * @return Collection|Candidat[]
     */
    public function getCandidats(): Collection
    {
        return $this->candidats;
    }

    public function addCandidat(Candidat $candidat): self
    {
        if (!$this->candidats->contains($candidat)) {
            $this->candidats[] = $candidat;
            $candidat->addOffre($this);
        }

        return $this;
    }

    public function removeCandidat(Candidat $candidat): self
    {
        if ($this->candidats->removeElement($candidat)) {
            $candidat->removeOffre($this);
        }

        return $this;
    }
}
