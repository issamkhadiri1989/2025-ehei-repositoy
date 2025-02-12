<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;

class CategoryController extends AbstractController
{
    #[Route('/category/{id}', name: 'app_category_view_by_id', requirements: ['id' => Requirement::POSITIVE_INT])]
    public function showCategoryBydId(Category $category): Response
    {
        // ...

        return $this->render('category/index.html.twig', [
            'category' => $category,
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

    #[Route('/category/all', name: 'app_category_view_by_all', priority: 1)]
    public function allCategories(EntityManagerInterface $manager): Response
    {
        /** @var CategoryRepository $categories */
        $repository = $manager->getRepository(Category::class);

        /** @var Category[] $categories */
        $categories = $repository->findAll();

        return $this->render('category/all.html.twig', [
            'categories' => $categories,
        ]);
    }

    public function topCategoriesMenu(array $only): Response
    {
        // ... do some logic

        $socialMedia = [
            'Facebook' => ['url' => 'https://www.facebook.com', 'icon' => '<i class="fa-brands fa-facebook-f"></i>'],
            'X.com' => ['url' => 'https://x.com', 'icon' => '<i class="fa-brands fa-x-twitter"></i>'],
            'Youtube' => ['url' => 'https://www.youtube.com', 'icon' => '<i class="fa-brands fa-youtube"></i>'],
            'Instagram' => ['url' => 'https://www.instagram.com', 'icon' => '<i class="fa-brands fa-instagram"></i>'],
        ];

        // Get only the social media specified in the $fields array.
        // If $only is empty, then get all social media.
        return $this->render('partials/_footer_menu.html.twig', [
            'social_media' => empty($only) ? $socialMedia : \array_intersect_key($socialMedia, \array_flip($only)),
        ]);
    }
}
