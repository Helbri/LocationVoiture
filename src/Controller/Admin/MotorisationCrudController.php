<?php

namespace App\Controller\Admin;

use App\Entity\Motorisation;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MotorisationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Motorisation::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
        ];
    }
}
