<?php

declare(strict_types=1);

namespace ShipIt\Domain\Player;

readonly class Player
{
    public string $id;
    public string $name;

    public Hand $hand;

    public PlayerBoard $board;
}
