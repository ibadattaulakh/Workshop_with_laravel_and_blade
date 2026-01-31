# Laravel Simplifier Agent Guide

## Overview

Laravel Simplifier is a Claude plugin/agent that provides Laravel-specific code analysis and cleanup. It's essentially a prompt with opinionated guidance that favors elegance, clarity, and maintainability for Laravel code.

## What It Is

At its core, Laravel Simplifier is:
- A single markdown file with YAML front matter
- A prompt that encodes Laravel best practices
- An opinionated code analyzer
- A cleanup assistant for AI-generated code

## Installation

### Step 1: Access Marketplace

1. Open Claude (Claude Code or Cloud Code)
2. Go to **Plugins / Marketplace** area
3. Add the marketplace that references the repo (e.g., `laravel/cloud-code`)
4. Install the **Laravel Simplifier** plugin from that marketplace

The UI makes this process straightforward.

## Usage

### Basic Usage

Once installed, select the Laravel Simplifier agent and give it an instruction:

```
Use the Laravel Simplifier agent to review all changed files in git and clean things up, confirming the test suite still passes.
```

### With Git Status

Have `git status` open so the agent knows what changed:

```bash
git status
```

Then instruct the agent:
```
Use the Laravel Simplifier agent to review all changed files and clean things up while confirming that the tests continue to pass.
```

### Stricter Instructions

You can tailor the instruction to be more specific:

```
Use the Laravel Simplifier agent to review all changed files and clean things up. 
Do not change public APIs, only internal refactors.
Prefer extraction into services over inline logic.
Confirm that the test suite still passes.
```

## What It Does

The agent performs cleanup passes that typically include:

### Code Improvements

- ✅ **Extract repeated logic** - Moves common patterns into reusable traits or helpers
- ✅ **Extract common logic** - Creates helper routines so classes become clearer
- ✅ **Add/refine return types** - Improves type safety
- ✅ **Readability tweaks** - Small improvements for clarity
- ✅ **Laravel idioms** - Ensures code follows Laravel conventions

### Example Improvements

**Before:**
```php
class VideoProcessJob
{
    public function handle()
    {
        try {
            // ... processing logic ...
        } catch (Exception $e) {
            Log::error('Video processing failed', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}

class VideoUploadJob
{
    public function handle()
    {
        try {
            // ... upload logic ...
        } catch (Exception $e) {
            Log::error('Video upload failed', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
```

**After:**
```php
trait HandlesVideoErrors
{
    protected function handleVideoError(Exception $e, string $operation): void
    {
        Log::error("Video {$operation} failed", ['error' => $e->getMessage()]);
        throw $e;
    }
}

class VideoProcessJob
{
    use HandlesVideoErrors;

    public function handle(): void
    {
        try {
            // ... processing logic ...
        } catch (Exception $e) {
            $this->handleVideoError($e, 'processing');
        }
    }
}

class VideoUploadJob
{
    use HandlesVideoErrors;

    public function handle(): void
    {
        try {
            // ... upload logic ...
        } catch (Exception $e) {
            $this->handleVideoError($e, 'upload');
        }
    }
}
```

## Best Practices

### 1. Always Verify Tests

**CRITICAL**: The analyzer is not a magic bullet. Always:
- Run the test suite locally after any automated refactor
- Skim diffs before accepting changes
- Sometimes agents claim tests pass but local runs disagree

```bash
# After agent runs, always verify:
php artisan test --compact
composer run format
```

### 2. Review Diffs Carefully

- Review all changes before accepting
- Understand what was refactored
- Ensure functionality is preserved
- Check that conventions are followed

### 3. Use as Starting Point

The plugin is opinionated. It nudges toward what the author thinks is clearer. Use the output as:
- ✅ A guided starting point
- ✅ A cleanup pass
- ✅ A refactoring suggestion

**Not** as:
- ❌ Final gospel
- ❌ Perfect solution
- ❌ Replacement for human review

### 4. Plan for Time

These agents take time for larger codebases:
- Small changes: 1-2 minutes
- Medium features: 3-5 minutes
- Large refactors: 5-10+ minutes

Plan accordingly and be patient.

## When to Use

### Good Use Cases

✅ **AI-generated code cleanup**
- You've let AI iterate on a feature
- Code base is starting to look inconsistent
- Want a focused cleanup pass targeting Laravel idioms

✅ **Repetitive cleanup automation**
- Common error handling patterns
- Small extractions before deeper review
- Normalizing style across multiple files

✅ **Architecture normalization**
- Accelerate normalizing style
- Small architecture decisions across generated files
- Consistency improvements

### Not Ideal For

❌ **Complete rewrites** - Use for cleanup, not full refactors
❌ **Critical production code** - Always review carefully
❌ **Time-sensitive fixes** - Takes several minutes
❌ **Perfect code** - It's a helper, not perfection

## Example Workflows

### Workflow 1: Post-AI Cleanup

1. AI generates feature code
2. Code works but is inconsistent
3. Run Laravel Simplifier:
   ```
   Use the Laravel Simplifier agent to review all changed files and clean things up while confirming that the tests continue to pass.
   ```
4. Review changes
5. Run tests locally
6. Accept or refine changes

### Workflow 2: Before Code Review

1. Complete feature implementation
2. Run Laravel Simplifier for cleanup pass
3. Review and accept improvements
4. Run tests and formatters
5. Submit for code review

### Workflow 3: Refactoring Multiple Files

1. Identify files needing cleanup
2. Run Laravel Simplifier on changed files
3. Review extracted traits/helpers
4. Verify tests pass
5. Commit improvements

## Integration with Other Tools

### With Claude Commands

After running Laravel Simplifier, use commands:
```
/format  # Run formatters
/test    # Run tests
```

### With Claude Skills

Use `fix-issue` skill, then Laravel Simplifier for cleanup:
1. Fix the issue
2. Run Laravel Simplifier for cleanup
3. Verify tests pass

### With PhpStorm Prompts

Use PhpStorm prompts for file-level changes, then Laravel Simplifier for multi-file cleanup.

## Customization

### Creating Custom Instructions

You can create custom prompts that codify your team's conventions:

```
Use the Laravel Simplifier agent to review all changed files and clean things up.

Team conventions:
- Prefer services over inline logic
- Extract common patterns to traits
- Use Form Requests for validation
- Follow existing code structure
- Maintain test coverage

Confirm that the test suite still passes.
```

### Storing Custom Prompts

Create a command in `.claude/commands/`:

**File:** `.claude/commands/simplify.md`
```
---
description: "Run Laravel Simplifier on changed files"
---

Use the Laravel Simplifier agent to review all changed files in git and clean things up, confirming the test suite still passes.

Team conventions:
- Prefer extraction into services over inline logic
- Extract common error handling to traits
- Follow existing code patterns
- Maintain all tests passing
```

## Troubleshooting

### Agent Takes Too Long

- Normal for larger codebases
- Be patient
- Consider running on smaller subsets

### Tests Fail After Cleanup

- Always run tests locally
- Review what changed
- Fix any issues introduced
- Agent may claim tests pass but local run disagrees

### Changes Too Aggressive

- Review diffs carefully
- Use stricter instructions
- Specify what NOT to change
- Accept only what you want

### Agent Not Available

- Verify plugin is installed
- Check marketplace connection
- Restart Claude if needed

## Summary

Laravel Simplifier is:
- ✅ A helpful cleanup assistant
- ✅ Good for post-AI cleanup
- ✅ Useful for repetitive refactors
- ✅ Opinionated but useful

**Remember:**
- Always verify tests locally
- Review diffs before accepting
- Use as starting point, not final solution
- Plan for processing time

## Quick Reference

**Install:** Plugins / Marketplace → Laravel Simplifier

**Use:**
```
Use the Laravel Simplifier agent to review all changed files and clean things up while confirming that the tests continue to pass.
```

**Verify:**
```bash
php artisan test --compact
composer run format
```

**Review:** Always review diffs before accepting
