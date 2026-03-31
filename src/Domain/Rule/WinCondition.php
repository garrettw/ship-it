<?php

declare(strict_types=1);

namespace ShipIt\Domain\Rule;

use ShipIt\Domain\Game\Game;
use ShipIt\Domain\Player\Player;

class WinCondition
{
    public function __construct(
        private Game $game
    ) {
    }
    public function isMet(Player $player): bool
    {
        // Example logic:
        // return count($player->drivers) >= X
        //     && count($player->blockers) === 0;
    }
}
