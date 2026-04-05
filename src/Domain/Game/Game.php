<?php

declare(strict_types=1);

namespace ShipIt\Domain\Game;

use ShipIt\Domain\Board\Deck;
use ShipIt\Domain\Board\DiscardPile;
use ShipIt\Domain\Game\Event\GameStarted;
use ShipIt\Domain\Game\Event\GameWon;
use ShipIt\Domain\Game\Event\PlayerAdded;
use ShipIt\Domain\Game\Event\PlayerAdvanced;
use ShipIt\Domain\Game\Event\PlayerRemoved;
use ShipIt\Domain\Game\Exception\NotEnoughPlayersException;
use ShipIt\Domain\Player\Player;
use ShipIt\Domain\Rule\WinCondition;

class Game
{
    /** @var Player[] */
    private array $players;

    private int $currentPlayerIndex = 0;

    public private(set) bool $gameInProgress = false;

    public function __construct(
        private Deck $deck,
        private DiscardPile $discardPile,
        private WinCondition $winCondition,
    ) {

    }

    public function start()
    {
        if ($this->gameInProgress) {
            return;
        }
        if (count($this->players) < 2) {
            throw new NotEnoughPlayersException('ERROR: Cannot start game; 2 or more players required');
        }
        $this->players = new \Random\Randomizer()->shuffleArray($this->players);
        $this->gameInProgress = true;
        return new GameStarted($this);
    }

    public function advanceTurn()
    {
        $this->currentPlayerIndex =
            ($this->currentPlayerIndex + 1) % count($this->players);
        return new PlayerAdvanced($this);
    }

    public function addPlayer(Player $player)
    {
        $this->players[$player->id] = $player;
        return new PlayerAdded($player);
    }

    public function removePlayer(string $id)
    {
        $player = $this->players[$id];
        unset($this->players[$id]);
        if ($this->gameInProgress && count($this->players) < 2) {
            throw new NotEnoughPlayersException('Only one player remains; gameplay ending.');
        }
        return new PlayerRemoved($player);
    }

    public function checkWin(Player $player)
    {
        if ($this->winCondition->isMet($player)) {
            $this->end();
            return new GameWon($player);
        }
    }

    public function end(): void
    {
        $this->players = [];
        $this->currentPlayerIndex = 0;
    }
}
