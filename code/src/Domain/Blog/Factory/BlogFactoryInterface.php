<?php

declare(strict_types=1);

namespace App\Domain\Blog\Factory;

use App\Entity\Category;
use Symfony\Component\HttpFoundation\File\UploadedFile;

interface BlogFactoryInterface
{
    public function createBlogInstances(UploadedFile $input): array;

    public function persist(UploadedFile $file, Category $category): void;
}
