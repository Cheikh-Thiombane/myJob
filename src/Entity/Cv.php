<?php

namespace App\Entity;

use App\Repository\CvRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CvRepository::class)
 */
class Cv
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Candidat::class, inversedBy="cv", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $candidat;

    /**
     * @ORM\Column(type="integer")
     */
    private $niveauEtude;

    /**
     * @ORM\OneToMany(targetEntity=Experience::class, mappedBy="cv", orphanRemoval=true)
     */
    private $experiences;

    /**
     * @ORM\OneToMany(targetEntity=Formation::class, mappedBy="cv", orphanRemoval=true)
     */
    private $formations;

    /**
     * @ORM\Column(type="integer")
     */
    private $niveauExperience;

    public function __construct()
    {
        $this->experiences = new ArrayCollection();
        $this->formations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNiveauEtude(): ?int
    {
        return $this->niveauEtude;
    }

    public function setNiveauEtude(int $niveauEtude): self
    {
        $this->niveauEtude = $niveauEtude;

        return $this;
    }

    /**
     * @return Collection|Experience[]
     */
    public function getExperiences(): Collection
    {
        return $this->experiences;
    }

    public function addExperience(Experience $experience): self
    {
        if (!$this->experiences->contains($experience)) {
            $this->experiences[] = $experience;
            $experience->setCv($this);
        }

        return $this;
    }

    public function removeExperience(Experience $experience): self
    {
        if ($this->experiences->removeElement($experience)) {
            // set the owning side to null (unless already changed)
            if ($experience->getCv() === $this) {
                $experience->setCv(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Formation[]
     */
    public function getFormations(): Collection
    {
        return $this->formations;
    }

    public function addFormation(Formation $formation): self
    {
        if (!$this->formations->contains($formation)) {
            $this->formations[] = $formation;
            $formation->setCv($this);
        }

        return $this;
    }

    public function removeFormation(Formation $formation): self
    {
        if ($this->formations->removeElement($formation)) {
            // set the owning side to null (unless already changed)
            if ($formation->getCv() === $this) {
                $formation->setCv(null);
            }
        }

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
}
