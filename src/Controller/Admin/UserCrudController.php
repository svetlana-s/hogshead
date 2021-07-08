<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\{Filters, Action, Actions, Crud};
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\{IdField, EmailField, TextField, BooleanField, ChoiceField};

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('status')
            ->add('isVerified')
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', '#')->hideOnForm(),
            EmailField::new('email'),
            TextField::new('name'),
            BooleanField::new('status'),
            BooleanField::new('isVerified'),
            ChoiceField::new('roles', 'Is Admin')->setChoices([
                'admin' => 'ROLE_ADMIN',
                'user' => 'ROLE_USER'
            ])->allowMultipleChoices(),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->remove(Crud::PAGE_INDEX, Action::NEW);
    }
}
