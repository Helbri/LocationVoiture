<?php

namespace App\Controller\Admin;

use App\Entity\Voiture;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class VoitureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Voiture::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('numImmat'),
            DateField::new('dernierControle'),
            DateField::new('derniereRevision'),
            TextField::new('couleur'),
            AssociationField::new('modele'),
            // AssociationField::new('motorisation'),
            /*AssociationField::new('modele')->renderAsEmbeddedForm(string $Type)*//*'Type' ,*/
            // TextField::new('type'),
            //AssociationField::new('location'), location
            AssociationField::new('statut'),
            IntegerField::new('kilometrage'),
        ];
    }
}
