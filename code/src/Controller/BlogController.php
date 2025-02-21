<?php

// src/Controller/BlogController.php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\Blog;
use App\Entity\Blog as BlogEntity;
use App\Entity\User;
use App\Form\Type\BlogType;
use App\Repository\BlogRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bridge\Twig\Attribute\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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

    #[Template(template: 'blog/all.html.twig')]
    #[Route(name: "app_blogs_all", path: "/blogs")]
    public function all(EntityManagerInterface $manager, Request $request): array
    {
        $tag = $request->query->get('tag', '');

        /** @var BlogRepository $blogs */
        $repository = $manager->getRepository(BlogEntity::class);

        /** @var BlogEntity[] $blogs */
        $blogs = $repository->getPublishedBlogs($tag);

        return [
            'blogs' => $blogs,
        ];
    }

    #[Route(path: "/blogs/create", name: "app_blog_create")]
    public function addNewBlog(EntityManagerInterface $manager): Response
    {
        $blog = new BlogEntity();
        $blog->setContent('This is a content')
            ->setTitle('I love Symfony')
            ->setCreatedAt(new \DateTimeImmutable())
            ->setTags(['Symfony', 'PHP', 'Database', 'Doctrine']);

        /** @var BlogRepository $repository */
        $repository = $manager->getRepository(BlogEntity::class);
        $repository->saveBlog($blog, true);

        return $this->redirectToRoute('app_blog_show', ['id' => $blog->getId()]);
    }

    #[Route(path: "/blogs/view/{id}", name: "app_blog_view")]
    public function viewBlog(EntityManagerInterface $manager, int $id): Response
    {
//        $user = $manager->getRepository(User::class)
//            ->find(26);
//        $manager->remove($user);
//        $manager->flush();

        /** @var BlogRepository $repository */
        $repository = $manager->getRepository(BlogEntity::class);

        /** @var ?BlogEntity $blog */
        $blog = $repository->getBlogWithIdentifier($id);

//        $manager->remove($blog->getAuthor());

        dump($blog);

        return $this->render('blog/show.html.twig', [
            'blog' => $blog,
        ]);
    }

    #[Route(path: "/blogs/{id}", name: "app_blog_show", requirements: ['id' => '\d+'])]
    public function showBlog(BlogEntity $blog, EntityManagerInterface $manager): Response
    {
        $blog->setTitle('Title (Edited)'.time());

        /** @var BlogRepository $repository */
        $repository = $manager->getRepository(BlogEntity::class);
        $repository->saveBlog($blog);

        return $this->render('blog/show.html.twig', [
            'blog' => $blog,
        ]);
    }

    #[Route(path: "/blogs/{blogId}", name: "app_blog_update", requirements: ['blogId' => '\d+'])]
    public function updateBlog(
        #[MapEntity(id: 'blogId')] BlogEntity $blog,
        EntityManagerInterface $manager,
    ): Response {
        $blog->setTitle('Title (Edited)');

        /** @var BlogRepository $repository */
        $repository = $manager->getRepository(BlogEntity::class);
        $repository->saveBlog($blog);

        return $this->redirectToRoute('app_blog_show');
    }

    #[Route(path: "/blogs/delete/{productId}", name: "app_blog_delete")]
    public function deleteBlog(
        #[MapEntity(id: 'productId')] BlogEntity $blog,
        EntityManagerInterface $manager,
    ): RedirectResponse
    {
        $manager->remove($blog);
        $manager->flush();

        return $this->redirectToRoute('app_blogs_all');
    }

    #[Route(path: "/blogs/{slug}", name: "app_blog_show_slug")]
    public function showBlogBySlug(
         BlogEntity $blog,
    ): Response {
        return $this->render('blog/show.html.twig', [
            'blog' => $blog,
        ]);
    }
}
