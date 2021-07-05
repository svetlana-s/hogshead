<?php

namespace App\EventListener;

use App\Entity\Chapter;
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
		
		if ($entity instanceof Chapter)
		{
			return;
		}
		
		$entity->setUser($this->security->getUser());
	}	
}