<?php

declare(strict_types=1);

include __DIR__.'/vendor/autoload.php';

use Crell\Tukio\Dispatcher;
use Discord\Discord;
use Discord\Parts\Channel\Message;
use Discord\WebSockets\Intents;
use Discord\WebSockets\Event;
use ShipIt\Application\Game;
use ShipIt\Application\Listener;
use ShipIt\Application\ListenerProvider;
use ShipIt\Application\MessageCreatedEvent;

$discord = new Discord([
    'token' => 'bot-token',
    'intents' => Intents::getDefaultIntents() | Intents::MESSAGE_CONTENT, 
    // Note: MESSAGE_CONTENT is privileged, see https://dis.gd/mcfaq
    // Note: MESSAGE_CONTENT intent must be enabled to get the content if the bot is not mentioned/DMed.
]);

$game = new Game();

$dispatcher = new Dispatcher(new ListenerProvider([
    // add all domain listeners here
    new Listener(MessageCreatedEvent::class, $game)
]), $discord->logger);

$game->setDispatcher($dispatcher);

$discord->on('ready', function (Discord $discord) use ($dispatcher) {
    $discord->logger->info("Bot is ready!");

    $discord->on(Event::MESSAGE_CREATE, function (Message $message, Discord $discord) use ($dispatcher) {
        // Just translating DPHP events over to our PSR-14 dispatcher.
        $dispatcher->dispatch(new MessageCreatedEvent($message, $discord));
    });
});

$discord->run();
