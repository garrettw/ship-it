<?php

namespace ShipIt\Domain\Game\Event;

use ShipIt\Domain\Player\Player;

readonly class PlayerRemoved
{
    public function __construct(
        public Player $player
    ) {
    }
}
