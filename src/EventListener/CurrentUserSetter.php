<?php

namespace App\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Security;

class CurrentUserSetter
{
	private $currentUser;
	private $security;

	public function __construct(Security $security)
	{
        $this->security = $security;
    }

	public function prePersist(LifecycleEventArgs $args)
	{
		$entity = $args->getEntity();
		$entity->setUser($this->security->getUser());
	}	
}