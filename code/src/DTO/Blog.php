<?php

// src/DTO/Blog.php

declare(strict_types=1);

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

#[Assert\GroupSequence(['Strict', 'Blog'])]
class Blog
{
    #[
        Assert\NotNull(message: 'Ce champ est obligatoire.', groups: ['Strict']),
        Assert\Length(min: 10, minMessage: 'Ce champ ne doit pas contenu moins de {{ limit }}.', groups: ['Blog']),
    ]
    private string $title;

    #[
        Assert\Length(max: 200, maxMessage: 'Ce contenu dépasse {{ limit }} caractères autorisés', groups: ['Default']),
        Assert\NotNull(message: 'Le contenu du blog est obligatoire'),
    ]
    private string $content;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }
}
