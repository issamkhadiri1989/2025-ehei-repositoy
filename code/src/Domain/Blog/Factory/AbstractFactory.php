<?php

declare(strict_types=1);

namespace App\Domain\Blog\Factory;

use App\Entity\Blog;
use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

abstract class AbstractFactory implements BlogFactoryInterface
{
    public function __construct(protected readonly EntityManagerInterface $manager)
    {
    }

    public function persist(UploadedFile $file, Category $category): void
    {
        /** @var Blog[] $instances */
        $instances = $this->createBlogInstances($file);
        dd($instances);

        foreach ($instances as $instance) {
            $instance->setCategory($category);
            $this->manager->persist($instance);
        }

        $this->manager->flush();
    }
}
