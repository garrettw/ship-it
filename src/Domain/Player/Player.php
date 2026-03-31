<?php

declare(strict_types=1);

namespace ShipIt\Domain\Player;

class Player
{
    private string $id;
    private string $name;

    private Hand $hand;

    private array $activeCards; // e.g. drivers/blockers in play
}
