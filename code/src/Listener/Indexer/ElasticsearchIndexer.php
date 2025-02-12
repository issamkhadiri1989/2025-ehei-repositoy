<?php

// src/Listener/Indexer/ElasticsearchIndexer.php

declare(strict_types=1);

namespace App\Listener\Indexer;

use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Event\PostRemoveEventArgs;
use Doctrine\ORM\Events;

#[AsDoctrineListener(event: Events::postRemove)]
class ElasticsearchIndexer
{
    public function postRemove(PostRemoveEventArgs $event): void
    {
        $object = $event->getObject();  // l'entité qu'on souhaite supprimer

        $manager = $event->getObjectManager(); // le manager

        // ... on tester si $object est une instance d'une classe précise : if ($object instanceof Blog::class)
    }
}
