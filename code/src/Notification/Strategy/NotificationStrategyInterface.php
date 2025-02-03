<?php

declare(strict_types=1);

namespace App\Notification\Strategy;

use Symfony\Component\HttpFoundation\Request;

interface NotificationStrategyInterface
{
    public function setNext(NotificationStrategyInterface $strategy): void;

    public function handle(Request $request): void;
}
