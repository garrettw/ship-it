<?php

declare(strict_types=1);

namespace ShipIt\Domain\Player;

readonly class Player
{
    public Hand $hand;

    public PlayerBoard $board;

    public function __construct(
        public string $id,
        public string $name,
    ) {
        $this->hand = new Hand();
        $this->board = new PlayerBoard();
    }
}
