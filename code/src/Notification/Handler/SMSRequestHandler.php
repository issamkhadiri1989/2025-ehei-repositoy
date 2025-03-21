<?php

declare(strict_types=1);

namespace App\Notification\Handler;

use Symfony\Component\HttpFoundation\Request;

class SMSRequestHandler implements NotificationHandlerInterface
{
    public function handle(Request $request): void
    {
        dump(__METHOD__);
    }
}
