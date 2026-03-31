<?php

namespace ShipIt\Domain\Game;

enum GameStatus
{
    case WAITING_FOR_PLAYERS;
    case IN_PROGRESS;
    case FINISHED;
}
