<?php

namespace ShipIt\Domain\Game\Event;

use ShipIt\Domain\Game\Game;

readonly class PlayerAdvanced
{
    public function __construct(
        public Game $game
    ) {
    }
}
