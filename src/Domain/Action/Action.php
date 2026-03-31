<?php

namespace ShipIt\Domain\Action;

abstract class Action
{
    public array $payload;
    public array $nextActions;
}