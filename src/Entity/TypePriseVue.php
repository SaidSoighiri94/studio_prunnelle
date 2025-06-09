<?php

namespace App\Entity;

use App\Repository\TypePriseVueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypePriseVueRepository::class)]
class TypePriseVue
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 35)]
    private ?string $nomTypePrise = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @var Collection<int, PriseDeVue>
     */
    #[ORM\OneToMany(targetEntity: PriseDeVue::class, mappedBy: 'typeDePrise')]
    private Collection $priseDeVues;

    public function __construct()
    {
        $this->priseDeVues = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomTypePrise(): ?string
    {
        return $this->nomTypePrise;
    }

    public function setNomTypePrise(string $nomTypePrise): static
    {
        $this->nomTypePrise = $nomTypePrise;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeImmutable
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeImmutable $createAt): static
    {
        $this->createAt = $createAt;

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
            $priseDeVue->setTypeDePrise($this);
        }

        return $this;
    }

    public function removePriseDeVue(PriseDeVue $priseDeVue): static
    {
        if ($this->priseDeVues->removeElement($priseDeVue)) {
            // set the owning side to null (unless already changed)
            if ($priseDeVue->getTypeDePrise() === $this) {
                $priseDeVue->setTypeDePrise(null);
            }
        }

        return $this;
    }
}
