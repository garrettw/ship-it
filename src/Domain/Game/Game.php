<?php

declare(strict_types=1);

namespace ShipIt\Domain\Game;

use ShipIt\Domain\Board\Deck;
use ShipIt\Domain\Board\DiscardPile;

class Game
{
    private string $id;
    private array $players;        // Player[]
    private Deck $deck;
    private DiscardPile $discard;

    private int $currentPlayerIndex;
    private Phase $phase;

    private array $board;          // Game-specific state
    private GameStatus $status;
}
