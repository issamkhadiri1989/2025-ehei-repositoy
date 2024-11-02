<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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
}
