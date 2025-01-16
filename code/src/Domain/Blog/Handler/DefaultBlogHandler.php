<?php

declare(strict_types=1);

namespace App\Domain\Blog\Handler;

use App\Entity\Blog;
use App\Repository\BlogRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\Attribute\AsAlias;

#[AsAlias]
final class DefaultBlogHandler implements BlogHandlerInterface
{
    public function __construct(
        private readonly EntityManagerInterface $manager,
    ) {
    }

    public function add(Blog $blog): void
    {
        /** @var BlogRepository $repository */
        $repository = $this->manager->getRepository(Blog::class);

        $repository->addNewBlog($blog);
    }

    public function edit(Blog $blog): void
    {
        /** @var BlogRepository $repository */
        $repository = $this->manager->getRepository(Blog::class);

        $repository->editBlog($blog);
    }
}
