<?php

declare(strict_types=1);

namespace App\Notification\Handler;

use Symfony\Component\Form\RequestHandlerInterface;
use Symfony\Component\HttpFoundation\Request;

abstract class AbstractRequestHandler implements NotificationHandlerInterface
{
    protected NotificationHandlerInterface $next;

    public function setNext(NotificationHandlerInterface $next): void
    {
        $this->next = $next;
    }

    public function handle(Request $request): void
    {
        if (!isset($this->next)) {
            dump("Default handling or throw some exception !");

            return;
        }

        $this->next->handle($request);
    }
}
