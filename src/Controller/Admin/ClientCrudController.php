<?php

namespace App\Controller\Admin;

use App\Entity\Client;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ClientCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Client::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            TextField::new('prenom'),
            TextField::new('numPermis'),
            DateField::new('dateNaissance')->hideOnIndex(),
            TextField::new('age')->hideOnForm(),
            TextField::new('numPI'),
            AssociationField::new('typePI'),
            EmailField::new('email'),
            TextField::new('telephone'),
            TextField::new('numeroAssurance'),
        ];
    }
}
