<?php

declare(strict_types=1);

namespace App\Security;

use App\Entity\User;
use Symfony\Component\Security\Core\Exception\LockedException;
use Symfony\Component\Security\Core\User\{UserInterface, UserCheckerInterface};
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;

class UserChecker implements UserCheckerInterface
{
    public function checkPreAuth(UserInterface $user)
    {
        if ($user->isVerified() && $user->getStatus()) {
            return;
        }

        if (!$user->isVerified()) {
            throw new CustomUserMessageAuthenticationException('Before you can login, you need to confirm your email address.');
        }

        if (!$user->getStatus()) {
            throw new CustomUserMessageAuthenticationException('Your account has been locked. Contact the admin at hogshead@gmail.com to unlock it.');
        }
    }

    public function checkPostAuth(UserInterface $user)
    {
    }
}