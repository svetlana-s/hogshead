<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Fanfic;
use App\Service\UserContentGetter;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Dto\{EntityDto, SearchDto};
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Collection\{FieldCollection, FilterCollection};
use EasyCorp\Bundle\EasyAdminBundle\Config\{Crud, Filters};
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\{AssociationField, TextField};

class FanficCrudController extends AbstractCrudController
{
    private UserContentGetter $userContent;

    public function __construct(UserContentGetter $userContent)
    {
        $this->userContent = $userContent;
    }

    public static function getEntityFqcn(): string
    {
        return Fanfic::class;
    }

    public function createIndexQueryBuilder(
        SearchDto $searchDto,
        EntityDto $entityDto,
        FieldCollection $fields,
        FilterCollection $filters
    ): QueryBuilder {
        $qb = $this->userContent->getUserContent(
            $searchDto,
            $entityDto,
            $fields,
            $filters
        );
        
        return $qb;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setSearchFields(['fandom.name', 'title']);
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(EntityFilter::new('fandom'));
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('fandom'),
            TextField::new('title'),
            AssociationField::new('chapters', 'Number of chapters')->onlyOnIndex(),
        ];
    }
}
