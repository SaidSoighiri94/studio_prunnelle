<?php

namespace App\Entity;

use App\Repository\PlancheRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: PlancheRepository::class)]
class Planche
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 35)]
    private ?string $nomPlanche = null;

    #[ORM\ManyToOne(inversedBy: 'planches')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $createur = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @var Collection<int, Pochette>
     */

    #[ORM\ManyToMany(targetEntity: Pochette::class, inversedBy: 'planches')]
    private Collection $pochettes;

    public function __construct()
    {
        $this->pochettes = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPlanche(): ?string
    {
        return $this->nomPlanche;
    }

    public function setNomPlanche(string $nomPlanche): static
    {
        $this->nomPlanche = $nomPlanche;

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
     * @return Collection<int, Pochette>
     */
    public function getPochettes(): Collection
    {
        return $this->pochettes;
    }

    public function addPochette(Pochette $pochette): static
    {
        if (!$this->pochettes->contains($pochette)) {
            $this->pochettes->add($pochette);
        }

        return $this;
    }

    public function removePochette(Pochette $pochette): static
    {
        $this->pochettes->removeElement($pochette);

        return $this;
    }
}
