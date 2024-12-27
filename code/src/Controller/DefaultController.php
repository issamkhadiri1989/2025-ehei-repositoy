<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Blog;
use App\Repository\BlogRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{
    #[Route('/default', name: 'app_default', /*stateless: true*/)]
    public function index(Request $request, EntityManagerInterface $manager): Response
    {
        $session = $request->getSession();

        $username = 'anonymous';
        if ($session->has('username')) {
            $username = $session->get('username');
        } else {
            $session->set('username', 'Issam');
        }

        // get *all* blog instances
        /** @var BlogRepository $blogs */
        $repository = $manager->getRepository(Blog::class);
        $blogs = $repository->getPublishedBlogs('Doctrine');

        dump($blogs);

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    #[Route(path: '/about-the-company', name: 'about_the_company')]
    public function aboutUs(): Response
    {
        // enable this to redirect to my Github repository
//        return new RedirectResponse("https://github.com/issamkhadiri1989");

        // this is equivalent to the above code
//        return $this->redirect("https://github.com/issamkhadiri1989");

        return new RedirectResponse(
            status: Response::HTTP_MOVED_PERMANENTLY,
            url: "https://github.com/issamkhadiri1989",
        );

//        return $this->render('default/about_us.html.twig');
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

    #[Route(path: '/api/me', name: 'app_expose_my_profile')]
    public function exposeApi(): JsonResponse
    {
        // get the content of the json file
        $content = \file_get_contents('file.json');

        return new JsonResponse(data: $content, json: true, /*status: Response::HTTP_OK*/);

        // here we need to pass an array to make if work.
//        return $this->json(data: \json_decode($content), );
    }
}
