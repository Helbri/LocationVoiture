<?php

namespace App\Controller\Admin;

use App\Entity\Location;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class LocationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Location::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            DateTimeField::new('dateDebut'),
            DateTimeField::new('dateFin'),
            IntegerField::new('kilometrage'),
            AssociationField::new('voiture'), //voiture
            AssociationField::new('client'), //client
        ];
    }
}
