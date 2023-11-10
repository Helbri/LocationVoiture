<?php

namespace App\Entity;

use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ClientRepository;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
#[ApiResource]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 60)]
    private ?string $prenom = null;

    #[ORM\Column(length: 12)]
    private ?string $numPermis = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $dateNaissance = null;


    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 10)]
    private ?string $telephone = null;

    #[ORM\Column(length: 15)]
    private ?string $numeroAssurance = null;

    #[ORM\Column(length: 14)]
    private ?string $numPI = null;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: Location::class)]
    private Collection $locations;

    #[ORM\ManyToOne(inversedBy: 'clients')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypePI $typePI = null;

    public function __construct()
    {
        $this->locations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = strtoupper($nom);

        return $this;
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

    public function getNumPermis(): ?string
    {
        return $this->numPermis;
    }

    public function setNumPermis(string $numPermis): static
    {
        $this->numPermis = $numPermis;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeImmutable
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeImmutable $dateNaissance): static
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function fullName(): ?string
    {
        return $this->getPrenom() . " " . $this->getNom();
    }

    public function age(): string
    {
        $now = new DateTime();
        $birth = $this->getDateNaissance();
        $interval = $birth->diff($now);

        return $interval->format("%y");
    }

    // Création de deux objets DateTimeImmutable représentant deux moments dans le temps.
    //$dateTime1 = new DateTimeImmutable('2023-10-18 08:00:00');
    //date plus ancienne, valeurs plus petites.
    //$dateTime2 = new DateTimeImmutable('2023-10-18 10:30:00');
    //date plus récente, valeurs plus grandes.
    // Calcul de la différence entre les deux moments
    // $interval = $dateTime1->diff($dateTime2);
    //on présente ici la date la plus ancienne devant, et la plus récente ensuite.
    // Affichage de la différence sous forme de texte
    public function __toString()
    {
        return (string) $this->getId() . " " . $this->getPrenom() . " " . $this->getNom();
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

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getNumeroAssurance(): ?string
    {
        return $this->numeroAssurance;
    }

    public function setNumeroAssurance(string $numeroAssurance): static
    {
        $this->numeroAssurance = $numeroAssurance;

        return $this;
    }

    public function getNumPI(): ?string
    {
        return $this->numPI;
    }

    public function setNumPI(string $numPI): static
    {
        $this->numPI = $numPI;

        return $this;
    }

    /**
     * @return Collection<int, Location>
     */
    public function getLocations(): Collection
    {
        return $this->locations;
    }

    public function addLocation(Location $location): static
    {
        if (!$this->locations->contains($location)) {
            $this->locations->add($location);
            $location->setClient($this);
        }

        return $this;
    }

    public function removeLocation(Location $location): static
    {
        if ($this->locations->removeElement($location)) {
            // set the owning side to null (unless already changed)
            if ($location->getClient() === $this) {
                $location->setClient(null);
            }
        }

        return $this;
    }

    public function getTypePI(): ?TypePI
    {
        return $this->typePI;
    }

    public function setTypePI(?TypePI $typePI): static
    {
        $this->typePI = $typePI;

        return $this;
    }
}
