<?php

namespace App\Entity;

use App\Repository\ThemeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ThemeRepository::class)]
class Theme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 35)]
    private ?string $nomTheme = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'themes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $createur = null;

    /**
     * @var Collection<int, PriseDeVue>
     */
    #[ORM\OneToMany(targetEntity: PriseDeVue::class, mappedBy: 'theme')]
    private Collection $priseDeVues;

    public function __construct()
    {
        $this->priseDeVues = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomTheme(): ?string
    {
        return $this->nomTheme;
    }

    public function setNomTheme(string $nomTheme): static
    {
        $this->nomTheme = $nomTheme;

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

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

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
            $priseDeVue->setTheme($this);
        }

        return $this;
    }

    public function removePriseDeVue(PriseDeVue $priseDeVue): static
    {
        if ($this->priseDeVues->removeElement($priseDeVue)) {
            // set the owning side to null (unless already changed)
            if ($priseDeVue->getTheme() === $this) {
                $priseDeVue->setTheme(null);
            }
        }

        return $this;
    }
    public function __toString(): string
    {
        return $this->nomTheme;
    }
}
