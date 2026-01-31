# Telegram Bot Plan

## Overview
We are implementing a minimal Telegram bot using the Nutgram package. The goal is to wire Telegram → webhook → parse/dispatch → respond, keep the implementation small, and prefer an existing package (Nutgram) over rolling everything from scratch.

## Architecture
When a user sends a message, Telegram posts it to your server via a webhook; the server parses the message, determines the action to take, executes it, and returns a response to the chat.

## Features
- Accepts commands: `/start`, `/help`, `/refund {email}`
- Registers commands with Telegram UI (slash commands)
- Uses a webhook for production and polling for local dev
- Small, focused handlers for each command using Nutgram's wildcard patterns

## Technical Details
- **Package**: `nutgram/laravel` and `nutgram/nutgram`
- **Controller**: `App\Http\Controllers\Telegram\TelegramWebhookController`
- **Route**: `POST /api/telegram/webhook` (no CSRF required)
- **Commands File**: `routes/nutgram.php` (auto-loaded by Nutgram Laravel package)
- **Environment**: `TELEGRAM_BOT_TOKEN` in `.env`

## Commands
- `/start`: Welcome message
- `/help`: List available commands
- `/refund {email}`: Process a refund for the given email (mock implementation)
- Fallback handler for unknown commands

## Implementation Notes
- Use Nutgram's command patterns with wildcards (`refund {email}`) instead of parsing with `explode()`
- Webhook route is on API routes (no CSRF protection needed)
- Nutgram handles request parsing and delegation to registered commands
- Commands are registered in `routes/nutgram.php` using closures

## Local Development Workflow
1. Set `TELEGRAM_BOT_TOKEN` in `.env`
2. Register commands: `php artisan nutgram:register-commands`
3. For local dev, use polling: `php artisan nutgram:listen`
4. For production, set webhook: `php artisan nutgram:hook:set https://your-domain/api/telegram/webhook`

## Testing
- Lightweight tests in `tests/Feature/TelegramBotTest.php`
- Tests use Nutgram's fake() method to simulate messages
- Assert expected responses for each command
- Ensure `TELEGRAM_BOT_TOKEN` is present in test environment or mocked appropriately

## Quick Troubleshooting Checklist
If something seems missing after implementation:

1. ✅ Check that `routes/api.php` contains the webhook route (`POST /api/telegram/webhook`)
2. ✅ Verify `.env` has `TELEGRAM_BOT_TOKEN` set
3. ✅ Run `php artisan nutgram:register-commands` to register commands with Telegram
4. ✅ For local dev: Start the listener with `php artisan nutgram:listen`
5. ✅ For production: Set webhook with `php artisan nutgram:hook:set https://your-domain/api/telegram/webhook`
6. ✅ Check logs if the bot returns a white screen or nothing happens — often the route isn't wired or the token is missing
7. ✅ Verify `routes/nutgram.php` exists and contains command handlers

## Developer-Driven AI Approach
This implementation follows a developer-driven AI workflow:
- ✅ Asked for a plan first and wrote it to `telegram.md`
- ✅ Simplified the initial plan (avoided custom clients, excessive middleware, etc.)
- ✅ Used existing package (Nutgram) instead of building from scratch
- ✅ Kept handlers minimal and focused
- ✅ Used Nutgram's wildcard patterns instead of manual text parsing
- ✅ Insisted on tests before considering the feature complete

## Final Notes
This is a small feature that's easily over-engineered by an eager AI. The key is to keep it simple:
- Prefer an existing library (Nutgram)
- Let the AI scaffold small pieces
- Insist on tests and a clear plan before writing lots of code
- Use command patterns with wildcards (`refund {email}`) for cleaner, safer parsing

## Using Context Seven for Code Review

To ensure the implementation follows Nutgram best practices, use Context Seven for code review:

**Prompt to use:**
```
I'd like you to review my Telegram bot code that leverages the Nutgram library.
Use Context Seven to confirm that I'm following best practices and look at the app/Services/Telegram folder.
```

This will:
- Query up-to-date Nutgram documentation
- Verify middleware usage (Nutgram's middleware vs standard Laravel middleware)
- Check architectural patterns
- Review test implementation
- Suggest targeted improvements based on current package version

See `CONTEXT_SEVEN.md` for setup instructions.
