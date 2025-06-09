<?php

namespace App\Entity;

use App\Repository\PochetteRepository;
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
}
