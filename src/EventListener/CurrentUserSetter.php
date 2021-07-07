<?php

namespace App\EventListener;

use App\Entity\User;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Security;

class CurrentUserSetter
{
	private $security;

	public function __construct(Security $security)
	{
        $this->security = $security;
    }

	public function prePersist(LifecycleEventArgs $args)
	{
		$entity = $args->getEntity();
		
		if ($entity instanceof User)
		{
			return;
		}
		
		$entity->setUser($this->security->getUser());
	}	
}