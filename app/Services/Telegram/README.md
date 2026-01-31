# Telegram Service

This folder contains the Telegram service abstraction layer.

## TelegramService

A useful abstraction for sending outgoing notifications that wraps the Nutgram instance. This provides a clean interface for Telegram operations throughout the application.

## Usage

The service can be injected via dependency injection:

```php
use App\Services\Telegram\TelegramService;

class SomeController extends Controller
{
    public function __construct(
        private readonly TelegramService $telegram
    ) {
    }

    public function sendNotification(): void
    {
        $this->telegram->sendMessage($chatId, 'Hello!');
    }
}
```

## Code Review with Context Seven

When reviewing this code, use Context Seven to ensure best practices:

```
I'd like you to review my Telegram bot code that leverages the Nutgram library.
Use Context Seven to confirm that I'm following best practices and look at the app/Services/Telegram folder.
```
