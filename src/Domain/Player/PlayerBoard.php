<?php

declare(strict_types=1);

namespace ShipIt\Domain\Player;

use ShipIt\Domain\Card\Card;

class PlayerBoard
{
    /** @var array<int, array<int, Card>> */
    public private(set) array $drivers;

    /** @var array<int, array<int, Card>> */
    public private(set) array $blockers;
}
