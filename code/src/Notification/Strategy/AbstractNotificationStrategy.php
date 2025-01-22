<?php

declare(strict_types=1);

namespace App\Notification\Strategy;

use Symfony\Component\HttpFoundation\Request;

abstract class AbstractNotificationStrategy implements NotificationStrategyInterface
{
    protected NotificationStrategyInterface $next;

    public function setNext(NotificationStrategyInterface $strategy): void
    {
        $this->next = $strategy;
    }

    public function handle(Request $request): void
    {
        if (!isset($this->next)) {
            dump('no strategy found');

            return;
        }

        $this->next->handle($request);
    }
}
