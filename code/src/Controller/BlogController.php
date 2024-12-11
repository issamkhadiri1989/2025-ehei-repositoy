<?php

// src/Controller/BlogController.php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\Blog;
use App\Form\Type\BlogType;
use Symfony\Bridge\Twig\Attribute\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class BlogController extends AbstractController
{
    #[Route('/blog/new', name: 'app_blog_new')]
    #[Template(template: 'blog/index.html.twig')]
    public function index(Request $request): array
    {
        $blog = new Blog();
        // ... on peut ici  appeler les modificateurs (setters) pour ajouter des données par défaut
        // ces données seront affichées dans le formulaire simulant une modification

        $form = $this->createForm(BlogType::class, $blog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($form->getData());
            dump($blog);
        }

        return [
            'form' => $form,
        ];
    }
}
