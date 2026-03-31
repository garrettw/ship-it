<?php

declare(strict_types=1);

include __DIR__.'/vendor/autoload.php';

use Discord\Discord;
use Discord\Parts\Channel\Message;
use Discord\WebSockets\Intents;
use Discord\WebSockets\Event;

$discord = new Discord([
    'token' => 'bot-token',
    'intents' => Intents::getDefaultIntents() | Intents::MESSAGE_CONTENT, 
    // Note: MESSAGE_CONTENT is privileged, see https://dis.gd/mcfaq
]);

$discord->on('ready', function (Discord $discord) {
    $discord->logger->info("Bot is ready!");

    // Listen for messages.
    $discord->on(Event::MESSAGE_CREATE, function (Message $message, Discord $discord) {
        // Note: MESSAGE_CONTENT intent must be enabled to get the content if the bot is not mentioned/DMed.
        $discord->logger->info("{$message->author->username}: {$message->content}");
    });
});

$discord->run();
