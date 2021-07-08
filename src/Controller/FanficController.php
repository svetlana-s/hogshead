<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Fandom;
use App\Repository\FanficRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class FanficController extends AbstractController
{
    #[Route('/fandom/{name}', name: 'fanfics')]
    public function index(Environment $twig, FanficRepository $fanficRepository, Fandom $fandom): Response
    {
        return new Response($twig->render('hogshead/fanfics.html.twig', [
            'fandom' => $fandom,
            'fanfics' => $fanficRepository->findBy(['fandom' => $fandom]),
        ]));
    }
}
