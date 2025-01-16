<?php

declare(strict_types=1);

namespace App\File\Processor;

use App\Domain\Blog\Factory\AbstractFactory;
use App\Domain\Blog\Factory\BlogFactoryInterface;
use App\Domain\Blog\Factory\BlogJsonFactory;
use App\Entity\Category;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class BlogJsonFileProcessor implements FileProcessorInterface
{
    public function __construct(
        #[Autowire(service: BlogJsonFactory::class)]
        private readonly BlogFactoryInterface $factory,
    ) {

    }

    public function process(UploadedFile $file, Category $category): void
    {
        $this->factory->persist($file, $category);

        // continuer votre code ici
    }
}
