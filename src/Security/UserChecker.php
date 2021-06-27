<?php

namespace App\Security;

use App\Entity\User;
use Symfony\Component\Security\Core\Exception\LockedException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;

class UserChecker implements UserCheckerInterface
{
    public function checkPreAuth(UserInterface $user)
    {
        if ($user->isVerified()) {
            return;
        }

        if (!$user->isVerified()) {
            throw new CustomUserMessageAuthenticationException('Before you can login, you need to confirm your email address.');
        }
    }

    public function checkPostAuth(UserInterface $user)
    {
    }
}