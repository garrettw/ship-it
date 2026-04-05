<?php

namespace ShipIt\Application;

use Crell\Tukio\Dispatcher;
use ShipIt\Domain\Board\Deck;
use ShipIt\Domain\Board\DiscardPile;
use ShipIt\Domain\Game\Game as DomainGame;
use ShipIt\Domain\Player\Player;
use ShipIt\Domain\Rule\WinCondition;

class Game
{
    protected ?Dispatcher $dispatcher = null;
    protected ?DomainGame $game = null;

    public function __construct()
    {
    }

    public function setDispatcher(Dispatcher $d)
    {
        $this->dispatcher = $d;
    }

    public function __invoke(object $e)
    {
        return match ($e::class) {
            MessageCreatedEvent::class => $this->onMessage($e),
            default => null
        };
    }

    public function onMessage(MessageCreatedEvent $e)
    {
        return match ($e->message->content) {
            '!startit' => $this->initGame(),
            '!addme' => $this->addPlayerSelf($e),
            '!removeme' => $this->removePlayerSelf($e),
            default => null
        };
    }

    public function initGame()
    {
        if ($this->game !== null) {
            return;
        }
        $this->game = new DomainGame(
            new Deck(),
            new DiscardPile(),
            new WinCondition(),
        );
    }

    public function addPlayerSelf(MessageCreatedEvent $e)
    {
        if ($this->game === null || $this->game->gameInProgress) {
            return;
        }

        $this->game->addPlayer(new Player($e->message->user_id, $e->message->author->username));
    }

    public function removePlayerSelf(MessageCreatedEvent $e)
    {
        if ($this->game === null) {
            return;
        }
        $this->game->removePlayer($e->message->user_id);
    }
}
