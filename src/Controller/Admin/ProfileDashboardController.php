<?php

namespace App\Controller\Admin;

use App\Entity\Fanfic;
use App\Entity\Chapter;
use App\Entity\Comment;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileDashboardController extends AbstractDashboardController
{
    /**
     * @Route("/profile", name="profile")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();
        $url = $routeBuilder->setController(FanficCrudController::class)->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('hogshead.com');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoRoute('Back to the website', 'fas fa-home', 'homepage');
        yield MenuItem::linkToCrud('Fanfics', 'fas fa-book', Fanfic::class);
        yield MenuItem::linkToCrud('Chapters', 'fa fa-file-text', Chapter::class);
        yield MenuItem::linkToCrud('Comments', 'fas fa-comments', Comment::class);
    }
}
