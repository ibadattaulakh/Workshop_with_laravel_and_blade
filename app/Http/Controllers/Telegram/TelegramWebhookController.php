<?php

namespace App\Http\Controllers\Telegram;

use App\Http\Controllers\Controller;
use SergiX44\Nutgram\Nutgram;

class TelegramWebhookController extends Controller
{
    public function handle(Nutgram $bot): void
    {
        $bot->run();
    }
}
