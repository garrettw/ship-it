<?php

declare(strict_types=1);

namespace ShipIt\Domain\Card;

use ShipIt\Domain\Game\Game;
use ShipIt\Domain\Player\Player;

abstract class Card
{
    protected string $id;
    protected string $name;
    protected string $description;

    abstract public function play(Game $game, Player $player): void;
}
