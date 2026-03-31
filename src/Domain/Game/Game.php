<?php

declare(strict_types=1);

namespace ShipIt\Domain\Game;

use Crell\Tukio\Dispatcher;
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

    private bool $gameInProgress = false;

    public function __construct(
        private Deck $deck,
        private DiscardPile $discardPile,
        private WinCondition $winCondition,
        private Dispatcher $dispatcher
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
        $this->dispatcher->dispatch(new GameStarted($this));
    }

    public function advanceTurn(): void
    {
        $this->currentPlayerIndex =
            ($this->currentPlayerIndex + 1) % count($this->players);
        $this->dispatcher->dispatch(new PlayerAdvanced($this));
    }

    public function addPlayer(Player $player): void
    {
        $this->players[$player->id] = $player;
        $this->dispatcher->dispatch(new PlayerAdded($player));
    }

    public function removePlayer(Player $player): void
    {
        unset($this->players[$player->id]);
        $this->dispatcher->dispatch(new PlayerRemoved($player));
        if ($this->gameInProgress && count($this->players) < 2) {
            throw new NotEnoughPlayersException('Only one player remains; gameplay ending.');
        }
    }

    public function checkWin(Player $player): void
    {
        if ($this->winCondition->isMet($player)) {
            $this->dispatcher->dispatch(new GameWon($player));
            $this->end();
        }
    }

    public function end(): void
    {
        $this->players = [];
        $this->currentPlayerIndex = 0;
    }
}
