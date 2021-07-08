<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Comment;
use App\Service\UserContentGetter;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Dto\{EntityDto, SearchDto};
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Collection\{FieldCollection, FilterCollection};
use EasyCorp\Bundle\EasyAdminBundle\Config\{Crud, Filters};
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\{AssociationField, TextEditorField, DateTimeField};

class CommentCrudController extends AbstractCrudController
{
    private UserContentGetter $userContent;

    public function __construct(UserContentGetter $userContent)
    {
        $this->userContent = $userContent;
    }

    public static function getEntityFqcn(): string
    {
        return Comment::class;
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
            ->setDefaultSort(['lastDateUpdate' => 'DESC']);
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(EntityFilter::new('fanfic'));
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('fanfic'),
            TextEditorField::new('content', 'Your comment'),
            DateTimeField::new('lastDateUpdate')->setFormat('dd-MM-Y HH:mm')->onlyOnIndex(),
        ];
    }
}
