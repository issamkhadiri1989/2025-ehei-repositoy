<?php

// src/Controller/BlogController.php

declare(strict_types=1);

namespace App\Controller;

use App\Domain\Blog\Handler\BlogHandlerInterface;
use App\Domain\Blog\Handler\HttpBlogHandler;
use App\Entity\Blog;
use App\Form\Type\BlogType;
use Symfony\Bridge\Twig\Attribute\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class BlogController extends AbstractController
{
    public function __construct(
//        #[Autowire(service: HttpBlogHandler::class)]
        private readonly BlogHandlerInterface $handler,
    ) {
    }

    #[Route('/blog/new', name: 'app_blog_new')]
    #[Template(template: 'blog/index.html.twig')]
    public function index(Request $request): array|RedirectResponse
    {
        $blog = new Blog();
        // ... on peut ici appeler les modificateurs (setters) pour ajouter des données par défaut
        // ces données seront affichées dans le formulaire simulant une modification

        $form = $this->createForm(BlogType::class, $blog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->handler->add($blog);
            $this->addFlash('success', 'New Blog added.');

            return $this->redirectToRoute('app_blog_edit', ['slug' => $blog->getSlug()]);
        }

        return [
            'form' => $form,
        ];
    }

    #[Route('/blog/{slug}', name: 'app_blog_edit')]
    #[Template(template: 'blog/index.html.twig')]
    public function edit(Request $request, Blog $blog): array|RedirectResponse
    {
        $form = $this->createForm(BlogType::class, $blog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->handler->edit($blog);
            $this->addFlash('success', 'The blog has been edited.');

            return $this->redirectToRoute('app_blog_edit', ['slug' => $blog->getSlug()]);
        }

        return [
            'form' => $form,
            'edition' => true,
        ];
    }
}
