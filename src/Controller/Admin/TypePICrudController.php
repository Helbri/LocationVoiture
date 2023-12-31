<?php

namespace App\Controller\Admin;

use App\Entity\TypePI;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TypePICrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TypePI::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
        ];
    }
}
