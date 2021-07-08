<?php

declare(strict_types=1);

namespace App\Service;

use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Dto\{EntityDto, SearchDto};
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Collection\{FieldCollection, FilterCollection};
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserContentGetter extends AbstractCrudController
{
	
	private EntityRepository $entityRepository;

	public function __construct(EntityRepository $entityRepository)
	{
		$this->entityRepository = $entityRepository;
	}

	public static function getEntityFqcn(): string
    {
        return '';
    }

	public function getUserContent(
		SearchDto $searchDto,
        EntityDto $entityDto,
        FieldCollection $fields,
        FilterCollection $filters
    ): QueryBuilder {
        $qb = $this->get(EntityRepository::class)->createQueryBuilder(
        	$searchDto,
        	$entityDto,
        	$fields,
        	$filters
        );
        $qb->andWhere('entity.user = :user');
        $qb->setParameter('user', $this->getUser());
        
        return $qb;
    }
}
