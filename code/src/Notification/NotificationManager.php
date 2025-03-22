<?php

declare(strict_types=1);

namespace App\Notification;

use App\Notification\Handler\NotificationHandlerInterface;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;
use Symfony\Component\HttpFoundation\Request;

final class NotificationManager
{
    private NotificationHandlerInterface $initialHandler;

    public function __construct(
        #[TaggedIterator(tag: "app.request_handler")]
        private readonly iterable $handlers,
    ) {
        $handlers = \iterator_to_array($this->handlers);
        dump($handlers);
        /** @var NotificationHandlerInterface $handler */
        $this->initialHandler = $handler = \array_shift($handlers);

        foreach ($handlers as $item) {
            $handler->setNext($item);
            $handler = $item;
        }
    }

    public function sendNotification(Request $request): void
    {
        $this->initialHandler->handle($request);
        dd(__METHOD__);
    }
}
