<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\TypeRepository;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: TypeRepository::class)]
#[ApiResource]
class Type
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]

    #[Groups('read')]
    //////marche pas
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'type', targetEntity: Modele::class)]
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
            $modele->setType($this);
        }

        return $this;
    }

    public function removeModele(Modele $modele): static
    {
        if ($this->modeles->removeElement($modele)) {
            // set the owning side to null (unless already changed)
            if ($modele->getType() === $this) {
                $modele->setType(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->getNom();
    }
}
