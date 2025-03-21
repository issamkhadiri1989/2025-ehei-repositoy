<?php

declare(strict_types=1);

namespace App\Notification\Handler;

use Symfony\Component\DependencyInjection\Attribute\AsAlias;
use Symfony\Component\HttpFoundation\Request;

#[AsAlias]
class EmailRequestHandler implements NotificationHandlerInterface
{
    public function handle(Request $request): void
    {
        dump(__METHOD__);
    }
}
