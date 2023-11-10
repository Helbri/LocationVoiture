<?php

namespace App\Controller\Admin;

use App\Entity\Modele;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ModeleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Modele::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            AssociationField::new('type'),
            AssociationField::new('marque'),
            AssociationField::new('motorisation'),
            BooleanField::new('boiteAuto'),
            BooleanField::new('quatreRouesMotrices'),
            IntegerField::new('nombrePlaces'),
            IntegerField::new('capaciteCoffre'),
            IntegerField::new('tarif'),
            IntegerField::new('nbrPorte'),
            ImageField::new('image')->setUploadDir('public/assets/images/marque/modele')
                ->setBasePath('assets/images/marque/modele'),
            IntegerField::new('autonomie'),
        ];
    }
}
