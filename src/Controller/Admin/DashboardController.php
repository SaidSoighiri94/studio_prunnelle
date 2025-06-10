<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Adresse;
use App\Entity\Ecole;
use App\Entity\Planche;
use App\Entity\Pochette;
use App\Entity\PriseDeVue;
use App\Entity\Theme;
use App\Entity\TypePriseVue;
use App\Entity\TypeVente;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;


#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    public function index(): Response
    {
        //return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // 1.1) If you have enabled the "pretty URLs" feature:
        // return $this->redirectToRoute('admin_user_index');
        //
        // 1.2) Same example but using the "ugly URLs" that were used in previous EasyAdmin versions:
         $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
         return $this->redirect($adminUrlGenerator->setController(UserCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirectToRoute('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
         //return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Studio Prunelle');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-users', User::class);
        yield MenuItem::linkToCrud('Adresses', 'fas fa-map-marker', Adresse::class);
        yield MenuItem::linkToCrud('Ecoles', 'fas fa-building', Ecole::class);
        yield MenuItem::linkToCrud('Prise de vue', 'fas fa-camera',PriseDeVue::class);
        yield MenuItem::linkToCrud('Thèmes', 'fas fa-paint-brush', Theme::class);
        yield MenuItem::linkToCrud('Types de prise', 'fas fa-camera-retro', TypePriseVue::class);
        yield MenuItem::linkToCrud('Types de vente', 'fas fa-shopping-cart', TypeVente::class);
        yield MenuItem::linkToCrud('Pochettes', 'fas fa-folder', Pochette::class);
        yield MenuItem::linkToCrud('Planches', 'fas fa-images', Planche::class);
        
       
        
 
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
