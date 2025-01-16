<?php

declare(strict_types=1);

namespace App\File\Processor;

use App\Entity\Category;
use Symfony\Component\HttpFoundation\File\UploadedFile;

interface FileProcessorInterface
{
    public function process(UploadedFile $file, Category $category): void;
}
