<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{
    #[Route('/category/{id}', name: 'app_category_view_by_id')]
    public function showCategoryBydId($id): Response
    {
        // ...

        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }

    #[Route('/category/{slug}', name: 'app_category_view_by_slug')]
    public function showCategoryBydSlug($slug): Response
    {
        // ...

        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }

    #[Route(path: "/some/path", name: 'app_some_route')]
    public function someAction(Request $request): Response
    {
        $page = $request->query->get('page'); // http://localhost/some/path?page=1

        $page = $request->query->get('page', 1); // si le paramètre n'est pas envoyé, $page = 1

        $username = $request->request->get('username');

        $username = $request->getPayload()->get('username');

        $parameters = $request->query->all();

        $parameters = $request->request->all();

        die;
        return new Response();
    }


    #[Route(path: "/some/other/path", name: 'app_some_other_route')]
    public function someOtherAction(): Response
    {
        // Réponse JSON
        return new JsonResponse(['username_id' => 1, 'token' => 'xE12341_yTs12...']);

        // on peut faire aussi
        return $this->json(['username_id' => 1, 'token' => 'xE12341_yTs12...']);

        // Redirection vers une route ou même vers une URL externe
        return new RedirectResponse(url: '...');

        return $this->redirectToRoute(route: 'route name');

        return $this->redirect(url: 'https://www.google.com');

        // Téléchargement des fichiers
        // Le fichier dummy.pdf se trouve dans public/attachment/
        return new BinaryFileResponse(
            file: 'attachment/dummy.pdf',
            contentDisposition: ResponseHeaderBag::DISPOSITION_ATTACHMENT, //ResponseHeaderBag::DISPOSITION_INLINE
        );

        // Il existe une fonction raccourcis pour gérer les fichiers
        return $this->file(
            file: 'attachment/dummy.pdf',
            disposition: ResponseHeaderBag::DISPOSITION_INLINE, //ResponseHeaderBag::DISPOSITION_ATTACHMENT
        );

        // on peut passer aussi un paramètre SPLFileInfo
        return $this->file(
            file: new \SplFileInfo('attachment/dummy.pdf'),
        );
    }
}
