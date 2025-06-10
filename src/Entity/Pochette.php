<?php

namespace App\Entity;

use App\Repository\PochetteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PochetteRepository::class)]
class Pochette
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 35)]
    private ?string $nomPochette = null;

    #[ORM\ManyToOne(inversedBy: 'pochettes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $createur = null;

    /**
     * @var Collection<int, Planche>
     */
    #[ORM\ManyToMany(targetEntity: Planche::class, mappedBy: 'pochettes')]
    private Collection $planches;

    /**
     * @var Collection<int, PriseDeVue>
     */
    #[ORM\ManyToMany(targetEntity: PriseDeVue::class, mappedBy: 'pochette')]
    private Collection $priseDeVues;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    public function __construct()
    {
        $this->planches = new ArrayCollection();
        $this->priseDeVues = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPochette(): ?string
    {
        return $this->nomPochette;
    }

    public function setNomPochette(string $nomPochette): static
    {
        $this->nomPochette = $nomPochette;

        return $this;
    }

    public function getCreateur(): ?User
    {
        return $this->createur;
    }

    public function setCreateur(?User $createur): static
    {
        $this->createur = $createur;

        return $this;
    }

    /**
     * @return Collection<int, Planche>
     */
    public function getPlanches(): Collection
    {
        return $this->planches;
    }

    public function addPlanche(Planche $planche): static
    {
        if (!$this->planches->contains($planche)) {
            $this->planches->add($planche);
            $planche->addPochette($this);
        }

        return $this;
    }

    public function removePlanche(Planche $planche): static
    {
        if ($this->planches->removeElement($planche)) {
            // set the owning side to null (unless already changed)
             $planche->removePochette($this); 
        }

        return $this;
    }

    /**
     * @return Collection<int, PriseDeVue>
     */
    public function getPriseDeVues(): Collection
    {
        return $this->priseDeVues;
    }

    public function addPriseDeVue(PriseDeVue $priseDeVue): static
    {
        if (!$this->priseDeVues->contains($priseDeVue)) {
            $this->priseDeVues->add($priseDeVue);
            $priseDeVue->addPochette($this);
        }

        return $this;
    }

    public function removePriseDeVue(PriseDeVue $priseDeVue): static
    {
        if ($this->priseDeVues->removeElement($priseDeVue)) {
            $priseDeVue->removePochette($this);
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }
    public function __toString(): string
    {
        return $this->nomPochette ?: 'Pochette sans nom';
    }
}
