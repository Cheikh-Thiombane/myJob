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
 * 
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

    /**
     * @ORM\ManyToOne(targetEntity=Region::class, inversedBy="offreEmplois")
     */
    private $region;

    /**
     * @ORM\ManyToMany(targetEntity=Langue::class, inversedBy="offreEmplois")
     */
    private $langues;

    /**
     * @ORM\ManyToMany(targetEntity=SecteurActivite::class, inversedBy="offreEmplois")
     */
    private $secteurActivites;

    /**
     * @ORM\ManyToOne(targetEntity=Metier::class, inversedBy="offreEmplois")
     */
    private $metier;

    /**
     * @ORM\ManyToOne(targetEntity=NiveauEtude::class, inversedBy="offreEmplois")
     */
    private $niveauEtude;

    /**
     * @ORM\ManyToOne(targetEntity=NiveauExperience::class, inversedBy="offreEmplois")
     */
    private $niveauExperience;

    /**
     * @ORM\ManyToOne(targetEntity=TypeContrat::class, inversedBy="offreEmplois")
     */
    private $typeContrat;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $renumeration;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="offre", orphanRemoval=true)
     */
    private $comments;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $endDate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $startDate;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->candidats = new ArrayCollection();
        $this->langues = new ArrayCollection();
        $this->secteurActivites = new ArrayCollection();
        $this->comments = new ArrayCollection();
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

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setRegion(?Region $region): self
    {
        $this->region = $region;

        return $this;
    }

    /**
     * @return Collection|Langue[]
     */
    public function getLangues(): Collection
    {
        return $this->langues;
    }

    public function addLangue(Langue $langue): self
    {
        if (!$this->langues->contains($langue)) {
            $this->langues[] = $langue;
        }

        return $this;
    }

    public function removeLangue(Langue $langue): self
    {
        $this->langues->removeElement($langue);

        return $this;
    }

    /**
     * @return Collection|SecteurActivite[]
     */
    public function getSecteurActivites(): Collection
    {
        return $this->secteurActivites;
    }

    public function addSecteurActivite(SecteurActivite $secteurActivite): self
    {
        if (!$this->secteurActivites->contains($secteurActivite)) {
            $this->secteurActivites[] = $secteurActivite;
        }

        return $this;
    }

    public function removeSecteurActivite(SecteurActivite $secteurActivite): self
    {
        $this->secteurActivites->removeElement($secteurActivite);

        return $this;
    }

    public function getMetier(): ?Metier
    {
        return $this->metier;
    }

    public function setMetier(?Metier $metier): self
    {
        $this->metier = $metier;

        return $this;
    }

    public function getNiveauEtude(): ?NiveauEtude
    {
        return $this->niveauEtude;
    }

    public function setNiveauEtude(?NiveauEtude $niveauEtude): self
    {
        $this->niveauEtude = $niveauEtude;

        return $this;
    }

    public function getNiveauExperience(): ?NiveauExperience
    {
        return $this->niveauExperience;
    }

    public function setNiveauExperience(?NiveauExperience $niveauExperience): self
    {
        $this->niveauExperience = $niveauExperience;

        return $this;
    }

    public function getTypeContrat(): ?TypeContrat
    {
        return $this->typeContrat;
    }

    public function setTypeContrat(?TypeContrat $typeContrat): self
    {
        $this->typeContrat = $typeContrat;

        return $this;
    }

    public function getRenumeration(): ?int
    {
        return $this->renumeration;
    }

    public function setRenumeration(?int $renumeration): self
    {
        $this->renumeration = $renumeration;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setOffre($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getOffre() === $this) {
                $comment->setOffre(null);
            }
        }

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getStartDate(): ?string
    {
        return $this->startDate;
    }

    public function setStartDate(?string $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }
}
