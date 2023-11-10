<?php

namespace App\Entity;

use App\Entity\Statut;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\LocationRepository;
use Doctrine\ORM\Event\PostPersistEventArgs;

#[ORM\Entity(repositoryClass: LocationRepository::class)]
#[ORM\HasLifecycleCallbacks] //on active les listeners sur l'entité "Location"
#[ApiResource]
class Location
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateFin = null;

    #[ORM\Column]
    private ?int $kilometrage = null;

    #[ORM\ManyToOne(inversedBy: 'locations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Voiture $voiture = null;

    #[ORM\ManyToOne(inversedBy: 'locations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $client = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): static
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): static
    {
        $this->dateFin = $dateFin;

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

    // public function __toString()
    // {
    //     return (string) $this->getId();
    // }

    public function getVoiture(): ?Voiture
    {
        return $this->voiture;
    }

    public function setVoiture(?Voiture $voiture): static
    {
        $this->voiture = $voiture;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): static
    {
        $this->client = $client;

        return $this;
    }

    #[ORM\PostPersist] //On crée un listener à déclencher après une création.
    public function postPersist(PostPersistEventArgs $args): void
    {
        //on récupère l'entity manager / gestionnaire d'entité
        $entityManager = $args->getObjectManager();

        //on récupère le statut "Location"
        $statut = $entityManager->getRepository(Statut::class)->find(1);

        //on récupère la voiture liée à cette location
        $voiture = $this->getVoiture();

        //on change le statut de la voiture
        $voiture->setStatut($statut);

        //on sauve dans la base. 1ère ligne, préparation de la requête, 2ème ligne, envoi de la requête.
        $entityManager->persist($voiture);
        $entityManager->flush();
    }
}
