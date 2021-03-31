<?php

namespace App\Entity;

use App\Repository\CritereRepository;
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
     * @ORM\Column(type="array", nullable=true)
     */
    private $metier = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $mobilite = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $secteurActivite = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $typeContrat;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $renumeration;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $langues = [];

    /**
     * @ORM\Column(type="integer")
     */
    private $disponibilite;

    /**
     * @ORM\OneToOne(targetEntity=Candidat::class, inversedBy="critere", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $candidat;

    

    public function getId(): ?int
    {
        return $this->id;
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

    public function getMobilite(): ?array
    {
        return $this->mobilite;
    }

    public function setMobilite(?array $mobilite): self
    {
        $this->mobilite = $mobilite;

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

    public function getTypeContrat(): ?string
    {
        return $this->typeContrat;
    }

    public function setTypeContrat(?string $typeContrat): self
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

    public function getLangues(): ?array
    {
        return $this->langues;
    }

    public function setLangues(?array $langues): self
    {
        $this->langues = $langues;

        return $this;
    }

    public function getDisponibilite(): ?int
    {
        return $this->disponibilite;
    }

    public function setDisponibilite(int $disponibilite): self
    {
        $this->disponibilite = $disponibilite;

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


}
