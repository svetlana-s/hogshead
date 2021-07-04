<?php

namespace App\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;

class LastDateUpdater
{
	public function prePersist(LifecycleEventArgs $args)
	{
		$entity = $args->getEntity();
		$date = new \DateTime();
        $entity->setLastDateUpdate($date);
	}	
}