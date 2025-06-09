<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 35)]
    private ?string $prenom = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @var Collection<int, Theme>
     */
    #[ORM\OneToMany(targetEntity: Theme::class, mappedBy: 'createur')]
    private Collection $themes;

    /**
     * @var Collection<int, Pochette>
     */
    #[ORM\OneToMany(targetEntity: Pochette::class, mappedBy: 'createur')]
    private Collection $pochettes;

    /**
     * @var Collection<int, Planche>
     */
    #[ORM\OneToMany(targetEntity: Planche::class, mappedBy: 'createur')]
    private Collection $planches;

    #[ORM\Column(length: 35)]
    private ?string $nom = null;

    /**
     * @var Collection<int, PriseDeVue>
     */
    #[ORM\OneToMany(targetEntity: PriseDeVue::class, mappedBy: 'photographe')]
    private Collection $priseDeVues;

    public function __construct()
    {
        $this->themes = new ArrayCollection();
        $this->pochettes = new ArrayCollection();
        $this->planches = new ArrayCollection();
        $this->priseDeVues = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

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
     * @return Collection<int, Theme>
     */
    public function getThemes(): Collection
    {
        return $this->themes;
    }

    public function addTheme(Theme $theme): static
    {
        if (!$this->themes->contains($theme)) {
            $this->themes->add($theme);
            $theme->setCreateur($this);
        }

        return $this;
    }

    public function removeTheme(Theme $theme): static
    {
        if ($this->themes->removeElement($theme)) {
            // set the owning side to null (unless already changed)
            if ($theme->getCreateur() === $this) {
                $theme->setCreateur(null);
            }
        }

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
            $pochette->setCreateur($this);
        }

        return $this;
    }

    public function removePochette(Pochette $pochette): static
    {
        if ($this->pochettes->removeElement($pochette)) {
            // set the owning side to null (unless already changed)
            if ($pochette->getCreateur() === $this) {
                $pochette->setCreateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Planche>
     */
    public function getPlanches(): Collection
    {
        return $this->planches;
    }

    public function addPlanch(Planche $planch): static
    {
        if (!$this->planches->contains($planch)) {
            $this->planches->add($planch);
            $planch->setCreateur($this);
        }

        return $this;
    }

    public function removePlanch(Planche $planch): static
    {
        if ($this->planches->removeElement($planch)) {
            // set the owning side to null (unless already changed)
            if ($planch->getCreateur() === $this) {
                $planch->setCreateur(null);
            }
        }

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

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
            $priseDeVue->setPhotographe($this);
        }

        return $this;
    }

    public function removePriseDeVue(PriseDeVue $priseDeVue): static
    {
        if ($this->priseDeVues->removeElement($priseDeVue)) {
            // set the owning side to null (unless already changed)
            if ($priseDeVue->getPhotographe() === $this) {
                $priseDeVue->setPhotographe(null);
            }
        }

        return $this;
    }
}
