<?php

declare(strict_types=1);

namespace ShipIt\Domain\Board;

use ShipIt\Domain\Card\Card;

class Deck extends Pile
{
    private array $cards; // Card[]

    public function draw(): ?Card {}
    public function shuffle(): void {}
}
