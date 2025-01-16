<?php

declare(strict_types=1);

namespace App\Domain\Blog\Factory;

use App\Entity\Blog;

class BlogJsonFactory extends AbstractSerializerFactory
{
    public function createBlogInstances(mixed $input): array
    {
        // process the uploaded file
        $tempFile = $input->getRealPath();

        $content = \file_get_contents($tempFile);

        return $this->serializer->deserialize(
            data: $content,
            format: 'json',
            type: Blog::class . '[]',
        );
    }
}
