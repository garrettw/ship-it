<?php

declare(strict_types=1);

namespace ShipIt\Application;

class ListenerProvider implements \Psr\EventDispatcher\ListenerProviderInterface
{
    public function __construct(protected array $listeners = [])
    {
    }

    public function getListenersForEvent(object $event): iterable
    {
        foreach ($this->listeners as $listener) {
            if ($event instanceof $listener->type) {
                yield $listener->listener;
            }
        }
    }
}
