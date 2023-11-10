<?php

namespace App\Entity;

use App\Entity\Modele;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\MotorisationRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MotorisationRepository::class)]
#[ApiResource]
class Motorisation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups('read')]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'motorisation', targetEntity: Modele::class)]
    private Collection $modeles;

    public function __construct()
    {
        $this->modeles = new ArrayCollection();
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
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, Modele>
     */
    public function getModeles(): Collection
    {
        return $this->modeles;
    }

    public function addModele(Modele $modele): static
    {
        if (!$this->modeles->contains($modele)) {
            $this->modeles->add($modele);
            $modele->setMotorisation($this);
        }

        return $this;
    }

    public function removeModele(Modele $modele): static
    {
        if ($this->modeles->removeElement($modele)) {
            // set the owning side to null (unless already changed)
            if ($modele->getMotorisation() === $this) {
                $modele->setMotorisation(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getNom();
    }
}
