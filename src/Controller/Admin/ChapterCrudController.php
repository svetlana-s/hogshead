<?php

namespace App\Controller\Admin;

use App\Entity\Chapter;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class ChapterCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Chapter::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('fanfic'),
            IntegerField::new('number'),
            TextField::new('title'),
            TextEditorField::new('content'),
        ];
    }
}
