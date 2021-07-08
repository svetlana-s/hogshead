<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Chapter;
use App\Service\UserContentGetter;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Dto\{EntityDto, SearchDto};
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Collection\{FieldCollection, FilterCollection};
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\{AssociationField, IntegerField, TextField, TextEditorField};
use App\Repository\FanficRepository;

class ChapterCrudController extends AbstractCrudController
{
    private UserContentGetter $userContent;

    public function __construct(UserContentGetter $userContent)
    {
        $this->userContent = $userContent;
    }

    public static function getEntityFqcn(): string
    {
        return Chapter::class;
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

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(EntityFilter::new('fanfic'));
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('fanfic')
            ->setRequired(true)
            ->setFormTypeOptions(['query_builder' => function (FanficRepository $em) {
                return $em->createQueryBuilder('f')
                    ->where('f.user = :user')
                    ->orderBy('f.title', 'ASC')
                    ->setParameter('user', $this->getUser())
                    ;
            }]),
            // ->setFormTypeOptions(['query_builder' => function (EntityRepository $em) {
            //     return $em->createQueryBuilder('f')
            //         ->where('f.user = :user')
            //         ->orderBy('f.title', 'ASC')
            //         ->setParameter('user', $this->getUser())
            //         ;
            // }]),
            IntegerField::new('number'),
            TextField::new('title'),
            TextEditorField::new('content'),
        ];
    }
}
