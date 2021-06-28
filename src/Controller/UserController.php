<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/users', name: 'user')]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/user_list.html.twig', [
            'users' => $userRepository->findAll(),
            'today' => new \DateTime('today'),
        ]);
    }
}
