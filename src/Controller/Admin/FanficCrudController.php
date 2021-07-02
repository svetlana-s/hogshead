<?php

namespace App\Controller\Admin;

use App\Entity\Fanfic;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class FanficCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Fanfic::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
