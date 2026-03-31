<?php

declare(strict_types=1);

namespace ShipIt\Domain\Player;

use ShipIt\Domain\Card\Card;
use ShipIt\Domain\Game\Phase;

class PlayerBoard
{
    /** @var array<Phase, array<int, Card>> */
    public private(set) array $drivers;

    /** @var array<Phase, array<int, Card>> */
    public private(set) array $blockers;
}
