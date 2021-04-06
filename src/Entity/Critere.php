<?php

namespace App\Entity;

use App\Repository\CritereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CritereRepository::class)
 */
class Critere
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $renumeration;


    /**
     * @ORM\OneToOne(targetEntity=Candidat::class, inversedBy="critere", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $candidat;

    /**
     * @ORM\ManyToMany(targetEntity=SecteurActivite::class, inversedBy="criteres")
     */
    private $secteurActivites;

    /**
     * @ORM\ManyToOne(targetEntity=Metier::class, inversedBy="criteres")
     */
    private $metier;

    /**
     * @ORM\ManyToMany(targetEntity=Langue::class, inversedBy="criteres")
     */
    private $langues;

    /**
     * @ORM\ManyToMany(targetEntity=Region::class, inversedBy="criteres")
     */
    private $mobilites;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $disponiblilite;

    /**
     * @ORM\ManyToMany(targetEntity=TypeContrat::class, inversedBy="critere")
     */
    private $typeContrats;

    

    public function __construct()
    {
        $this->secteurActivites = new ArrayCollection();
        $this->langues = new ArrayCollection();
        $this->mobilites = new ArrayCollection();
        $this->typeContrats = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
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



    public function getCandidat(): ?Candidat
    {
        return $this->candidat;
    }

    public function setCandidat(Candidat $candidat): self
    {
        $this->candidat = $candidat;

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
     * @return Collection|Region[]
     */
    public function getMobilites(): Collection
    {
        return $this->mobilites;
    }

    public function addMobilite(Region $mobilite): self
    {
        if (!$this->mobilites->contains($mobilite)) {
            $this->mobilites[] = $mobilite;
        }

        return $this;
    }

    public function removeMobilite(Region $mobilite): self
    {
        $this->mobilites->removeElement($mobilite);

        return $this;
    }

    public function getDisponiblilite(): ?string
    {
        return $this->disponiblilite;
    }

    public function setDisponiblilite(?string $disponiblilite): self
    {
        $this->disponiblilite = $disponiblilite;

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

    /**
     * @return Collection|TypeContrat[]
     */
    public function getTypeContrats(): Collection
    {
        return $this->typeContrats;
    }

    public function addTypeContrat(TypeContrat $typeContrat): self
    {
        if (!$this->typeContrats->contains($typeContrat)) {
            $this->typeContrats[] = $typeContrat;
        }

        return $this;
    }

    public function removeTypeContrat(TypeContrat $typeContrat): self
    {
        $this->typeContrats->removeElement($typeContrat);

        return $this;
    }

}
