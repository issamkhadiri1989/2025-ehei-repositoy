<?php

// src/Domain/Blog/Handler/BlogHandlerInterface.php

declare(strict_types=1);

namespace App\Domain\Blog\Handler;

use App\Entity\Blog;

interface BlogHandlerInterface
{
    public function add(Blog $blog): void;

    public function edit(Blog $blog): void;
}
