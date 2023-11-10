<?php

namespace App\Controller\Admin;

use App\Entity\Type;
use App\Entity\Client;
use App\Entity\Marque;
use App\Entity\Modele;
use App\Entity\Statut;
use App\Entity\TypePI;
use App\Entity\Voiture;
use App\Entity\Location;
use App\Entity\Motorisation;
use Symfony\Component\HttpFoundation\Response;
use App\Controller\Admin\VoitureCrudController;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(VoitureCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('LocationVoiture');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        yield MenuItem::linkToCrud('Client', 'fas fa-list', Client::class);
        yield MenuItem::linkToCrud('Location', 'fas fa-list', Location::class);
        yield MenuItem::linkToCrud('Marque', 'fas fa-list', Marque::class);
        yield MenuItem::linkToCrud('Modele', 'fas fa-list', Modele::class);
        yield MenuItem::linkToCrud('Statut', 'fas fa-list', Statut::class);
        yield MenuItem::linkToCrud('Type', 'fas fa-list', Type::class);
        yield MenuItem::linkToCrud('TypePI', 'fas fa-list', TypePI::class);
        yield MenuItem::linkToCrud('Motorisation', 'fas fa-list', Motorisation::class);
        yield MenuItem::linkToCrud('Voiture', 'fas fa-list', Voiture::class);
    }
}
