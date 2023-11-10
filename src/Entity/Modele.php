<?php

namespace App\Entity;

use App\Entity\Voiture;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ModeleRepository;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: ModeleRepository::class)]
#[ApiResource(normalizationContext: ['groups' => ['read']])]
class Modele
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups('read')]
    private string $nom = "";

    #[ORM\Column]
    #[Groups('read')]
    private ?int $nbrPorte = null;

    #[ORM\Column(length: 255)]
    #[Groups('read')]
    private ?string $image = null;

    #[ORM\OneToMany(mappedBy: 'modele', targetEntity: Voiture::class)]
    private Collection $voitures;

    #[ORM\ManyToOne(inversedBy: 'modeles')]
    #[Groups('read')]
    private ?Type $type = null;

    #[ORM\ManyToOne(inversedBy: 'modeles')]
    #[Groups('read')]
    private ?Marque $marque = null;

    #[ORM\ManyToOne(inversedBy: 'modeles')]
    #[Groups('read')]
    private ?Motorisation $motorisation = null;

    #[Groups('read')]
    #[ORM\Column]
    private ?bool $boiteAuto = null;

    #[Groups('read')]
    #[ORM\Column]
    private ?bool $quatreRouesMotrices = null;

    #[Groups('read')]
    #[ORM\Column]
    private ?int $nombrePlaces = null;

    #[Groups('read')]
    #[ORM\Column]
    private ?int $capaciteCoffre = null;

    #[Groups('read')]
    #[ORM\Column]
    private ?int $tarif = null;

    #[Groups('read')]
    #[ORM\Column]
    private ?int $autonomie = null;

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
        $this->nom = $nom;

        return $this;
    }

    public function getNbrPorte(): ?int
    {
        return $this->nbrPorte;
    }

    public function setNbrPorte(int $nbrPorte): static
    {
        $this->nbrPorte = $nbrPorte;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, Voiture>
     */
    public function getVoitures(): Collection
    {
        return $this->voitures;
    }

    public function addVoiture(Voiture $voiture): static
    {
        if (!$this->voitures->contains($voiture)) {
            $this->voitures->add($voiture);
            $voiture->setModele($this);
        }

        return $this;
    }

    public function removeVoiture(Voiture $voiture): static
    {
        if ($this->voitures->removeElement($voiture)) {
            // set the owning side to null (unless already changed)
            if ($voiture->getModele() === $this) {
                $voiture->setModele("");
            }
        }

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getMarque(): ?Marque
    {
        return $this->marque;
    }

    public function setMarque(?Marque $marque): static
    {
        $this->marque = $marque;

        return $this;
    }


    public function __toString(): string
    {
        return $this->getNom();
    }

    public function getMotorisation(): ?Motorisation
    {
        return $this->motorisation;
    }

    public function setMotorisation(?Motorisation $motorisation): static
    {
        $this->motorisation = $motorisation;

        return $this;
    }

    public function isBoiteAuto(): ?bool
    {
        return $this->boiteAuto;
    }

    public function setBoiteAuto(bool $boiteAuto): static
    {
        $this->boiteAuto = $boiteAuto;

        return $this;
    }

    public function isQuatreRouesMotrices(): ?bool
    {
        return $this->quatreRouesMotrices;
    }

    public function setQuatreRouesMotrices(bool $quatreRouesMotrices): static
    {
        $this->quatreRouesMotrices = $quatreRouesMotrices;

        return $this;
    }

    public function getNombrePlaces(): ?int
    {
        return $this->nombrePlaces;
    }

    public function setNombrePlaces(int $nombrePlaces): static
    {
        $this->nombrePlaces = $nombrePlaces;

        return $this;
    }

    public function getCapaciteCoffre(): ?int
    {
        return $this->capaciteCoffre;
    }

    public function setCapaciteCoffre(int $capaciteCoffre): static
    {
        $this->capaciteCoffre = $capaciteCoffre;

        return $this;
    }

    public function getTarif(): ?int
    {
        return $this->tarif;
    }

    public function setTarif(int $tarif): static
    {
        $this->tarif = $tarif;

        return $this;
    }

    public function getAutonomie(): ?int
    {
        return $this->autonomie;
    }

    public function setAutonomie(int $autonomie): static
    {
        $this->autonomie = $autonomie;

        return $this;
    }
}
