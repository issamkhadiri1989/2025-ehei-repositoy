<?php

// src/Listener/Blog/BlogEventListener.php

declare(strict_types=1);

namespace App\Listener\Blog;

use App\Entity\Blog;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Event\PostUpdateEventArgs;
use Doctrine\ORM\Events;

#[AsEntityListener(entity: Blog::class, event: Events::postUpdate, method: 'notifyAdminAfterUpdate')]
class BlogEventListener
{
    public function notifyAdminAfterUpdate(Blog $blog, PostUpdateEventArgs $event): void
    {
            // ... logique pour envoyer un mail
    }
}
