# Claude Commands

This directory contains reusable Claude commands for this project. Commands are aliases for prompts you frequently write.

## Usage

### In Claude Code UI or CLI:
```
claude code
# then type or select the command:
# /learn app/Http/Controllers/PostController.php
# /format
# /test
```

### With Arguments

Commands can accept arguments using `$1`, `$2`, etc.:
- `/learn app/Models/User.php` - `$1` = `app/Models/User.php`
- `/create-test PostTest` - `$1` = `PostTest`

## Available Commands

### `learn`
Explain a file in plain English and suggest next steps.
**Usage:** `/learn path/to/file.php`

### `format`
Run format routine (Rector + Pint), fix issues, run tests, and ensure everything passes.
**Usage:** `/format`

### `test`
Run tests and fix any failures.
**Usage:** `/test`

### `review-telegram`
Review Telegram bot code using Context Seven for Nutgram best practices.
**Usage:** `/review-telegram`

### `refactor`
Refactor code with Rector and ensure tests still pass.
**Usage:** `/refactor`

### `create-test`
Create a new Pest test for a feature or class.
**Usage:** `/create-test TestName`

### `explain-symbol`
Explain what a symbol (class, function, method) does and where it's used.
**Usage:** `/explain-symbol ClassName` or `/explain-symbol functionName`

### `simplify`
Run Laravel Simplifier agent on changed files to clean up code.
**Usage:** `/simplify`

### `simplify-strict`
Run Laravel Simplifier with strict constraints (no API changes, internal refactors only).
**Usage:** `/simplify-strict`

### `code-review`
Perform a comprehensive code review on changed files.
**Usage:** `/code-review`

Can be used directly or triggered by a code review subagent.

### `test-with-chrome`
Use Chrome to test a feature or flow in a real browser.
**Usage:** `/test-with-chrome`

Requires Chrome integration enabled. Great for ad-hoc verification during development.

### `debug-with-chrome`
Use Chrome to debug client-side issues like white screens or JavaScript errors.
**Usage:** `/debug-with-chrome`

Opens Chrome, reads console logs, and identifies issues.

### `verify-feature`
Use Chrome to verify a feature works end-to-end in a real browser.
**Usage:** `/verify-feature`

Tests complete user flows and verifies behavior.

### `pr-improve`
Generate a GitHub PR comment to ask Claude to make improvements.
**Usage:** `/pr-improve`

Generates ready-to-paste PR comments for mentioning Claude to make code changes.

### `plan-with-interview`
Create a plan by interviewing the user first instead of guessing.
**Usage:** `/plan-with-interview`

Explores code, asks clarifying questions, then creates detailed plan. Enable plan mode (Shift+Tab) before using.

### `add-tests`
Add tests for code that was generated without tests.
**Usage:** `/add-tests`

Reviews changed files and adds comprehensive tests. **CRITICAL**: Testing is non-negotiable when AI generates code.

## Creating New Commands

1. Create a new `.md` file in this directory
2. Add YAML front matter with a description:
   ```markdown
   ---
   description: "What this command does"
   ---
   ```
3. Write your prompt in the body
4. Use `$1`, `$2`, etc. for arguments

## Examples

### Simple Command
```markdown
---
description: "Say hello"
---

All you need to do is say "hello" to me. Do nothing else.
```

### Command with Arguments
```markdown
---
description: "Summarize a file"
---

Read the file at `$1` and provide a brief summary of what it does.
```

### Multi-Step Workflow
```markdown
---
description: "Complete workflow"
---

Step 1: Run `composer run format`
Step 2: If issues found, fix them and rerun
Step 3: Run `php artisan test`
Step 4: If tests fail, fix and rerun
```

## Benefits

- ✅ Formalize routine prompts
- ✅ Share commands with the team
- ✅ Consistent tooling and conventions
- ✅ Save time on repetitive tasks
- ✅ Version controlled prompts
