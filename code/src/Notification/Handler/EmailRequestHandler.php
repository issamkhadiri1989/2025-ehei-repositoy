<?php

declare(strict_types=1);

namespace App\Notification\Handler;

use Symfony\Component\DependencyInjection\Attribute\AsAlias;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;
use Symfony\Component\HttpFoundation\Request;

#[AsAlias]
#[AsTaggedItem(priority: 2)]
class EmailRequestHandler extends AbstractRequestHandler
{
    public function handle(Request $request): void
    {
        if (!$this->support($request)) {
            parent::handle($request);

            return;
        }

        dump(__METHOD__ . " will handle the request");
        dump($request->query->all());
    }

    function support(Request $request): bool
    {
        dump(__CLASS__);
        return $request->query->has('s') && $request->query->get('s') === 'email';
    }
}
