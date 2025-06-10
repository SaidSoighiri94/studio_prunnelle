<?php

namespace App\Entity;

use App\Repository\PriseDeVueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PriseDeVueRepository::class)]
class PriseDeVue
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $datePriseVue = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $cratedAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column]
    private ?int $nbEleve = null;

    #[ORM\Column]
    private ?int $nb_classe = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 0)]
    private ?string $prixEcole = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 0, nullable: true)]
    private ?string $prixParent = null;

    #[ORM\ManyToOne(inversedBy: 'priseDeVue')]
    private ?Ecole $ecole = null;

    #[ORM\ManyToOne(inversedBy: 'priseDeVues')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $photographe = null;

    #[ORM\ManyToOne(inversedBy: 'priseDeVues')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypePriseVue $typeDePrise = null;

    #[ORM\ManyToOne(inversedBy: 'priseDeVues')]
    private ?TypeVente $typeVente = null;

    #[ORM\ManyToOne(inversedBy: 'priseDeVues')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Theme $theme = null;

    /**
     * @var Collection<int, Pochette>
     */
    #[ORM\ManyToMany(targetEntity: Pochette::class, inversedBy: 'priseDeVues')]
    private Collection $pochette;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Commentaires = null;

    public function __construct()
    {
        $this->pochette = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatePriseVue(): ?\DateTimeImmutable
    {
        return $this->datePriseVue;
    }

    public function setDatePriseVue(\DateTimeImmutable $datePriseVue): static
    {
        $this->datePriseVue = $datePriseVue;

        return $this;
    }

    public function getCratedAt(): ?\DateTimeImmutable
    {
        return $this->cratedAt;
    }

    public function setCratedAt(\DateTimeImmutable $cratedAt): static
    {
        $this->cratedAt = $cratedAt;

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

    public function getNbEleve(): ?int
    {
        return $this->nbEleve;
    }

    public function setNbEleve(int $nbEleve): static
    {
        $this->nbEleve = $nbEleve;

        return $this;
    }

    public function getNbClasse(): ?int
    {
        return $this->nb_classe;
    }

    public function setNbClasse(int $nb_classe): static
    {
        $this->nb_classe = $nb_classe;

        return $this;
    }

    public function getPrixEcole(): ?string
    {
        return $this->prixEcole;
    }

    public function setPrixEcole(string $prixEcole): static
    {
        $this->prixEcole = $prixEcole;

        return $this;
    }

    public function getPrixParent(): ?string
    {
        return $this->prixParent;
    }

    public function setPrixParent(?string $prixParent): static
    {
        $this->prixParent = $prixParent;

        return $this;
    }

    public function getEcole(): ?Ecole
    {
        return $this->ecole;
    }

    public function setEcole(?Ecole $ecole): static
    {
        $this->ecole = $ecole;

        return $this;
    }

    public function getPhotographe(): ?User
    {
        return $this->photographe;
    }

    public function setPhotographe(?User $photographe): static
    {
        $this->photographe = $photographe;

        return $this;
    }

    public function getTypeDePrise(): ?TypePriseVue
    {
        return $this->typeDePrise;
    }

    public function setTypeDePrise(?TypePriseVue $typeDePrise): static
    {
        $this->typeDePrise = $typeDePrise;

        return $this;
    }

    public function getTypeVente(): ?TypeVente
    {
        return $this->typeVente;
    }

    public function setTypeVente(?TypeVente $typeVente): static
    {
        $this->typeVente = $typeVente;

        return $this;
    }

    public function getTheme(): ?Theme
    {
        return $this->theme;
    }

    public function setTheme(?Theme $theme): static
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * @return Collection<int, Pochette>
     */
    public function getPochette(): Collection
    {
        return $this->pochette;
    }

    public function addPochette(Pochette $pochette): static
    {
        if (!$this->pochette->contains($pochette)) {
            $this->pochette->add($pochette);
        }

        return $this;
    }

    public function removePochette(Pochette $pochette): static
    {
        $this->pochette->removeElement($pochette);

        return $this;
    }

    public function getCommentaires(): ?string
    {
        return $this->Commentaires;
    }

    public function setCommentaires(?string $Commentaires): static
    {
        $this->Commentaires = $Commentaires;

        return $this;
    }
}
