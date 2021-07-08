<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\FandomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class FandomController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(Environment $twig, FandomRepository $fandomRepository): Response
    {
        return new Response($twig->render('hogshead/fandoms.html.twig', [
            'fandoms' => $fandomRepository->findAll(),
        ]));
    }
}
