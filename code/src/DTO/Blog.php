<?php

// src/DTO/Blog.php

declare(strict_types=1);

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class Blog
{
    #[Assert\NotNull(message: 'Ce champ est obligatoire.'), Assert\NotBlank(message: 'Ce champ ne peut pas être vide.')]
    private string $title;

    #[Assert\Length(max: 200, maxMessage: 'Ce contenu dépasse {{ limit }} caractères autorisés'), Assert\NotNull(message: 'Le contenu du blog est obligatoire')]
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
