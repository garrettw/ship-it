<?php

declare(strict_types=1);

namespace ShipIt\Domain\Board;

use ShipIt\Domain\Card\Card;

class Pile
{
    private array $cards;

    public function add(Card $card): void {}
}
