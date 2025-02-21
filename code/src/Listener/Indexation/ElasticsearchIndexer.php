<?php

declare(strict_types=1);

namespace App\Listener\Indexation;

use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Events;

#[AsDoctrineListener(event: Events::prePersist)]
final class ElasticsearchIndexer
{
    // ...

    public function prePersist(PrePersistEventArgs $event): void
    {
        $object = $event->getObject();

       /* if ($object instanceof Employee) {
            // ...
        }*/

        $manager = $event->getObjectManager();

        //...
    }
}
