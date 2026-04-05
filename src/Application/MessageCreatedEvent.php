<?php

namespace ShipIt\Application;

use Discord\Discord;
use Discord\Parts\Channel\Message;

readonly class MessageCreatedEvent
{
    public function __construct(
        public Message $message,
        public Discord $discord,
    ) {
    }
}
