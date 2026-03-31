<?php

namespace ShipIt\Domain\Game\Event;

use ShipIt\Domain\Player\Player;

readonly class PlayerAdded
{
    public function __construct(
        public Player $player
    ) {
    }
}
