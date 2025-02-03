<?php

declare(strict_types=1);

namespace App\Notification\Strategy;

use Symfony\Component\HttpFoundation\Request;

abstract class AbstractSupportableNotificationStrategy extends AbstractNotificationStrategy
{
    abstract public function supports(Request $request): bool;
}
