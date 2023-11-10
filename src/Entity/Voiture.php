<?php

namespace App\Entity;

use App\Entity\Modele;
use App\Entity\Location;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
// use Doctrine\DBAL\Types\Types;
use App\Repository\VoitureRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;
// use Doctrine\Common\Collections\Collection;
// use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: VoitureRepository::class)]
#[ApiResource(normalizationContext: ['groups' => ['read']])]
#[ApiFilter(SearchFilter::class, properties: ['modele' => 'exact', 'marque' => 'exact', 'type' => 'exact'])]
class Voiture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('read')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups('read')]
    private string $numImmat;

    #[ORM\ManyToOne(inversedBy: 'voitures')]
    #[Groups('read')]
    private Modele $modele;

    #[ORM\ManyToOne(inversedBy: 'voitures')]
    #[Groups('read')]
    private ?Statut $statut = null;

    #[ORM\Column(length: 255)]
    #[Groups('read')]
    private ?string $couleur = null;

    #[ORM\Column]
    #[Groups('read')]
    private ?int $kilometrage = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    #[Groups('read')]
    private ?\DateTimeInterface $derniereRevision = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    #[Groups('read')]
    private ?\DateTimeInterface $dernierControle = null;

    #[ORM\OneToMany(mappedBy: 'voiture', targetEntity: Location::class)]
    #[Groups('read')]
    private Collection $locations;

    public function __construct()
    {
        $this->locations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumImmat(): string
    {
        return $this->numImmat;
    }

    public function setNumImmat(string $numImmat): static
    {
        $this->numImmat = $numImmat;

        return $this;
    }

    /*     public function getDernContrTech(): ?string
    {
        return $this->dernContrTech;
    }

    public function setDernContrTech(string $dernContrTech): static
    {
        $this->dernContrTech = $dernContrTech;

        return $this;
    } */


    public function getModele(): Modele
    {
        return $this->modele;
    }

    public function setModele(Modele $modele): static
    {
        $this->modele = $modele;

        return $this;
    }
    public function __toString()
    {
        return $this->getNumImmat() . " - " . $this->getModele() . " - " . $this->getCouleur();
    }

    public function getStatut(): ?Statut
    {
        return $this->statut;
    }

    public function setStatut(?Statut $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): static
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getKilometrage(): ?int
    {
        return $this->kilometrage;
    }

    public function setKilometrage(int $kilometrage): static
    {
        $this->kilometrage = $kilometrage;

        return $this;
    }

    public function getDerniereRevision(): ?\DateTimeInterface
    {
        return $this->derniereRevision;
    }

    public function setDerniereRevision(?\DateTimeInterface $derniereRevision): static
    {
        $this->derniereRevision = $derniereRevision;

        return $this;
    }

    public function getDernierControle(): ?\DateTimeInterface
    {
        return $this->dernierControle;
    }

    public function setDernierControle(?\DateTimeInterface $dernierControle): static
    {
        $this->dernierControle = $dernierControle;

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
            $location->setVoiture($this);
        }

        return $this;
    }

    public function removeLocation(Location $location): static
    {
        if ($this->locations->removeElement($location)) {
            // set the owning side to null (unless already changed)
            if ($location->getVoiture() === $this) {
                $location->setVoiture(null);
            }
        }

        return $this;
    }
}
