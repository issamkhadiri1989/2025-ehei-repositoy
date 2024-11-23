<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{
    #[Route('/default', name: 'app_default', stateless: true)]
    public function index(Request $request): Response
    {
        $session = $request->getSession();

        $username = 'anonymous';
        if ($session->has('username')) {
            $username = $session->get('username');
        } else {
            $session->set('username', 'Issam');
        }

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    #[Route(path: '/about-the-company', name: 'about_the_company')]
    public function aboutUs(): Response
    {
        return $this->render('default/about_us.html.twig');
    }

    #[Route(name: 'app_contact_us', path: '/contact-us')]
    public function contactUs(): Response
    {
        return $this->render('default/contact_us.html.twig');
    }

    #[Route(path: '/terms-and-conditions', name: 'app_terms_and_conditions')]
    public function policies(): Response
    {
        return $this->render('default/policies.html.twig');
    }
}
