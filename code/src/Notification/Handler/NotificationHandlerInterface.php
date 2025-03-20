<?php

declare(strict_types=1);

namespace App\Notification\Handler;

//use Symfony\Component\DependencyInjection\Attribute\Autoconfigure;
//use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;
use Symfony\Component\HttpFoundation\Request;

//#[AutoconfigureTag(name: 'app.notification_handler')]
//#[Autoconfigure(tags: ['app.notification_handler'])]
interface NotificationHandlerInterface
{
    public function handle(Request $request): void;
}
