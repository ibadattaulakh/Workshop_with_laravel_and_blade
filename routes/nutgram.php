<?php

use SergiX44\Nutgram\Nutgram;

/** @var \SergiX44\Nutgram\Nutgram $bot */
$bot->onCommand('start', function (Nutgram $bot) {
    $bot->sendMessage('Welcome to the Pixl Bot! Use /help to see available commands.');
})->description('Start the bot');

$bot->onCommand('help', function (Nutgram $bot) {
    $bot->sendMessage("Available commands:\n/start - Start the bot\n/help - Show this help\n/refund {email} - Request a refund");
})->description('Show help');

$bot->onCommand('refund {email}', function (Nutgram $bot, string $email) {
    // Validate email format
    if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $bot->sendMessage('Invalid email format. Please provide a valid email address.');

        return;
    }

    // Mock refund logic - in production, dispatch a job here
    $bot->sendMessage("Refund request received for: {$email}. We will process it shortly.");
})->description('Request a refund');

$bot->fallback(function (Nutgram $bot) {
    $bot->sendMessage("I'm sorry, I don't understand that command. Use /help to see what I can do.");
});
