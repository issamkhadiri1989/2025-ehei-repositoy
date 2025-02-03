<?php

declare(strict_types=1);

namespace App\Notification;

use App\Notification\Strategy\NotificationStrategyInterface;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;
use Symfony\Component\HttpFoundation\Request;

class ChainInitializer
{
    private NotificationStrategyInterface $bootstrapStrategy;

    /** @var NotificationStrategyInterface[] */
    private array $chain;

    public function __construct(#[TaggedIterator(tag: 'app.chain_handler')] iterable $chain)
    {
        $strategies = \iterator_to_array($chain);
        $currentStrategy = $this->bootstrapStrategy = \array_shift($strategies);

        \array_walk($strategies, function (NotificationStrategyInterface $strategy) use (&$currentStrategy) {
            $currentStrategy->setNext($strategy);
            $currentStrategy = $strategy;
        });

        $this->chain = $strategies;
    }

    public function notify(Request $request): void
    {
        // start the chain
        $this->bootstrapStrategy->handle($request);
    }
}
