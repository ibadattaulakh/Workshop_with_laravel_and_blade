<?php

declare(strict_types=1);

namespace App\Services\Telegram;

use SergiX44\Nutgram\Nutgram;

/**
 * Telegram Service
 *
 * A useful abstraction for sending outgoing notifications that wraps the Nutgram instance.
 * This provides a clean interface for Telegram operations throughout the application.
 */
class TelegramService
{
    public function __construct(
        private readonly Nutgram $bot
    ) {}

    /**
     * Send a message to a specific chat
     */
    public function sendMessage(int|string $chatId, string $message): void
    {
        $this->bot->sendMessage($message, [
            'chat_id' => $chatId,
        ]);
    }

    /**
     * Get the underlying Nutgram instance if needed for advanced operations
     */
    public function bot(): Nutgram
    {
        return $this->bot;
    }
}
