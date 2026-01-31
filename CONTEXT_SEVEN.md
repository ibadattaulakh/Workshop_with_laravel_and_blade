# Context Seven Setup

## Overview
Context Seven provides up-to-date documentation for LLMs, ensuring AI assistants have access to current, authoritative docs for the exact package and version you're using. This is especially helpful for smaller packages like Nutgram that may not show up in the usual places.

## Why Use Context Seven
- Prevents AI from guessing or using outdated documentation
- Provides current, authoritative docs for your exact package version
- Especially helpful for smaller packages
- Ensures AI follows best practices specific to your package version

## Setup Instructions

### 1. Get Your API Key
1. Sign up for Context Seven (free plan available)
2. Go to the dashboard and generate an API key
3. Copy the API key (keep it secure)

### 2. Configure MCP Server

**Important**: The exact MCP server configuration format may vary. Please refer to Context Seven's official documentation for the current server address and configuration format.

#### For Cursor (.cursor/mcp.json)
The MCP configuration files have been updated with a placeholder. You'll need to:

1. Get the actual server address from Context Seven's dashboard
2. Replace the placeholder URL in `.cursor/mcp.json` and `.mcp.json`
3. Set your API key as an environment variable `CONTEXT_SEVEN_API_KEY` or update the config directly

Example structure (verify exact format with Context Seven docs):
```json
{
  "mcpServers": {
    "laravel-boost": {
      "command": "php",
      "args": ["artisan", "boost:mcp"]
    },
    "context-seven": {
      "url": "YOUR_CONTEXT_SEVEN_SERVER_URL",
      "apiKey": "${CONTEXT_SEVEN_API_KEY}"
    }
  }
}
```

#### For PhpStorm/Junie
1. Open PhpStorm settings
2. Search for "Uni/Junie MCP settings"
3. Add a new MCP server
4. Paste the server address from Context Seven
5. Put the API key into the API key field
6. Activate the server entry

#### For Other IDEs/Assistants
Follow the connection instructions provided by Context Seven for your specific IDE/assistant. The concept is the same: give the assistant an MCP server that points to Context Seven plus your API key.

### 3. Using Context Seven with Nutgram

When working with the Telegram bot code that leverages Nutgram, use this prompt pattern:

```
I'd like you to review my Telegram bot code that leverages the Nutgram library.
Use Context Seven to confirm that I'm following best practices and look at the app/Services/Telegram folder.
```

The key phrase is **"Use Context Seven"** - this triggers the AI to query the up-to-date documentation.

## What Context Seven Will Check

When reviewing Nutgram code, Context Seven will verify:

- ✅ Using Nutgram's built-in middleware instead of standard Laravel middleware
- ✅ Proper middleware registration in Telegram routes
- ✅ Following Nutgram's architectural patterns
- ✅ Test implementation matches current Nutgram testing practices
- ✅ Code style matches package conventions
- ✅ Using latest API methods and best practices

## Project Structure

The Telegram bot implementation is located in:

- **Routes**: `routes/nutgram.php` - Command handlers
- **Controller**: `app/Http/Controllers/Telegram/TelegramWebhookController.php`
- **Service**: `app/Services/Telegram/` - Abstraction layer (if needed)
- **Tests**: `tests/Feature/TelegramBotTest.php`
- **Documentation**: `telegram.md` - Implementation plan

## Example: Review Prompt

```
I'd like you to review my Telegram bot code that leverages the Nutgram library.
Use Context Seven to confirm that I'm following best practices and look at the app/Services/Telegram folder.
```

This will:
1. Read your Telegram bot files
2. Query Context Seven for up-to-date Nutgram documentation
3. Compare your implementation against best practices
4. Suggest targeted improvements based on current package version

## Security Note

**Important**: Never commit your Context Seven API key to version control. Always use environment variables or secure configuration management.

## Benefits

- ✅ AI uses current documentation, not outdated articles
- ✅ Catches version-specific issues early
- ✅ Ensures best practices are followed
- ✅ Prevents architectural mistakes
- ✅ Small, targeted fixes rather than massive refactors
