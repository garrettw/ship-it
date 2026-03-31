<?php

declare(strict_types=1);

namespace ShipIt\Domain\Player;

use ShipIt\Domain\Card\Card;

class Hand
{
    private array $cards;

    public function add(Card $card): void {}
    public function remove(string $cardId): Card {}
}