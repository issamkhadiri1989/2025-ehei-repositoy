<?php

declare(strict_types=1);

namespace App\Notification\Handler;

use Symfony\Component\HttpFoundation\Request;

class WhatsAppRequestHandler extends AbstractRequestHandler
{
    public function handle(Request $request): void
    {
        dump(__METHOD__);

        parent::handle($request);
    }
}
