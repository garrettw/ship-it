<?php

namespace ShipIt\Application;

readonly class Listener
{
    public function __construct(
        public string $type,
        public string|array|object $listener, // callable
    ) {
    }
}
