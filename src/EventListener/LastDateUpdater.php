<?php

namespace App\EventListener;

use App\Entity\User;
use Doctrine\ORM\Event\LifecycleEventArgs;

class LastDateUpdater
{
	public function prePersist(LifecycleEventArgs $args)
	{
		$entity = $args->getEntity();

		if ($entity instanceof User)
		{
			return;
		}

        $entity->setLastDateUpdate(new \DateTime());
	}	
}