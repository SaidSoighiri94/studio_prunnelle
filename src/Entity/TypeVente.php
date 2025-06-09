<?php

namespace App\Entity;

use App\Repository\TypeVenteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeVenteRepository::class)]
class TypeVente
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nomTypeVente = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @var Collection<int, PriseDeVue>
     */
    #[ORM\OneToMany(targetEntity: PriseDeVue::class, mappedBy: 'typeVente')]
    private Collection $priseDeVues;

    public function __construct()
    {
        $this->priseDeVues = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomTypeVente(): ?string
    {
        return $this->nomTypeVente;
    }

    public function setNomTypeVente(string $nomTypeVente): static
    {
        $this->nomTypeVente = $nomTypeVente;

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
            $priseDeVue->setTypeVente($this);
        }

        return $this;
    }

    public function removePriseDeVue(PriseDeVue $priseDeVue): static
    {
        if ($this->priseDeVues->removeElement($priseDeVue)) {
            // set the owning side to null (unless already changed)
            if ($priseDeVue->getTypeVente() === $this) {
                $priseDeVue->setTypeVente(null);
            }
        }

        return $this;
    }
}
