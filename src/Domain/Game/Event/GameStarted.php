<?php

namespace ShipIt\Domain\Game\Event;

use ShipIt\Domain\Game\Game;

readonly class GameStarted
{
    public function __construct(
        public Game $game
    ) {
    }
}
