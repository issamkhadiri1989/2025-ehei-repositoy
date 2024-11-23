<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PageController extends AbstractController
{
    #[Route('/page', name: 'app_page')]
    public function index(): Response
    {
        return $this->render('page/index.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }

    #[Route('/contact-us', name: 'app_contact_us')]
    public function contactUs(Request $request): Response
    {
        $request->isXmlHttpRequest();

        dump($request->server->all(), $request->headers->get('user_agent'), $request->headers->all());

        if ($request->isMethod(Request::METHOD_POST)) {
            $emailAddress = $request->request->get('email_address');
            dump($emailAddress);
        }

        return $this->render('page/contact_us.html.twig');
    }

    #[Route(path: "/search", name: "app_search")]
    public function search(Request $request): Response
    {
        $term = $request->query->get('term', 'default value');

        dump($term);

        $all = $request->query->all();

        dump($all);

        return $this->render('page/search.html.twig');
    }
}
