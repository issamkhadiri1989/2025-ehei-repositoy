<?php

declare(strict_types=1);

namespace App\Notification\Handler;

use Symfony\Component\HttpFoundation\Request;

interface NotificationHandlerInterface
{
    public function handle(Request $request): void;
}
