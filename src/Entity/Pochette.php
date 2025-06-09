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
    #[ORM\OneToMany(targetEntity: Planche::class, mappedBy: 'pochette')]
    private Collection $planche;

    public function __construct()
    {
        $this->planche = new ArrayCollection();
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
    public function getPlanche(): Collection
    {
        return $this->planche;
    }

    public function addPlanche(Planche $planche): static
    {
        if (!$this->planche->contains($planche)) {
            $this->planche->add($planche);
            $planche->setPochette($this);
        }

        return $this;
    }

    public function removePlanche(Planche $planche): static
    {
        if ($this->planche->removeElement($planche)) {
            // set the owning side to null (unless already changed)
            if ($planche->getPochette() === $this) {
                $planche->setPochette(null);
            }
        }

        return $this;
    }
}
