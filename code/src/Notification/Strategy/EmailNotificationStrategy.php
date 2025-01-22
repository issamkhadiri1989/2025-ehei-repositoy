<?php

declare(strict_types=1);

namespace App\Notification\Strategy;

use Symfony\Component\HttpFoundation\Request;

class EmailNotificationStrategy extends AbstractSupportableNotificationStrategy
{
    public function handle(Request $request): void
    {
        dump(__METHOD__);
        if ($this->supports($request)) {
            dump('Handled');

            return;
        }

        parent::handle($request);
    }

    public function supports(Request $request): bool
    {
        $strategyIdentifier = $request->query->get('s');

        return 'email' === $strategyIdentifier;
    }
}
