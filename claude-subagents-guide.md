# Claude Subagents Guide

## Overview

Claude Subagents are tasks that run in isolation without clogging up the current context window. They're useful for multi-step or lengthy work that needs to happen in the background while keeping your main conversation clean and responsive.

## Commands vs Skills vs Subagents

### Commands: Triggers
**What**: Single-shot triggers for prompts (like Artisan commands)
**Location**: `.claude/commands/`
**Use case**: Quick, repeatable prompts
**Example**: `/format`, `/test`, `/learn`

**Think of it as**: A trigger you pull to do a specific thing

### Skills: Guidebooks
**What**: Field guides with multi-step workflows
**Location**: `.claude/skills/`
**Use case**: Complex workflows requiring multiple steps
**Example**: `fix-issue`, `pest-testing`

**Think of it as**: A guidebook telling the AI how to perform an action

### Subagents: Isolated Tasks
**What**: Tasks that run in isolation with their own context
**Location**: Created in Claude UI (not files)
**Use case**: Multi-step or lengthy work without muddying conversation
**Example**: Code review agent, planning agent

**Think of it as**: A background job that runs separately and returns results

## Queue Analogy

Think about Laravel queues:
- You dispatch a job to run in the background
- It gets its own context and processes
- Returns a response when done
- Keeps your main request clean and responsive

Subagents work similarly:
- You spin one up
- It gets its own context
- Figures things out independently
- Returns a response to main conversation when done
- Keeps your current context clean

## Creating a Code Review Agent

### Step 1: Create the Agent

In Claude, create a new subagent with this prompt:

```
Act as a senior Laravel engineer and provide a comprehensive code review for any changed Git files.

Process:
1. Check git status to see what files changed
2. Review each changed file for:
   - Code quality issues
   - Laravel best practices
   - Guideline violations
   - Missing return types
   - Incorrect visibility (public/protected/private)
   - Security concerns
   - Performance issues
   - Test coverage

3. Provide specific, actionable feedback
4. Suggest improvements with code examples
5. Run formatting and test checks
6. Ensure guidelines are followed

Must use this agent when you need a comprehensive code review.
```

### Step 2: Configure the Agent

**Model**: Choose Opus or appropriate model
**Tools**: Start with "all tools", narrow down if needed
**Color**: Choose a color (e.g., yellow for warnings)
**Description**: Include trigger keywords like "code review", "review code", "code review agent"

### Step 3: Integrate Guidelines

Ensure your project guidelines are up to date:

```bash
php artisan boost:install
```

Add specific rules to your guidelines (e.g., `laravel.md`):

```markdown
## Code Style

Always favor Laravel facades over helper function equivalents.

Example:

// Prefer this (facade)
Auth::user();

// Over this (helper)
auth()->user();
```

Tell your code-review agent to:
- Ensure guidelines are followed
- Run finalize/check commands (`composer run format`, `php artisan test`)

## Running the Agent

### Check What Changed

```bash
git status
```

### Trigger the Agent

In Claude's command interface:
```
Claude: run code review
```

Or explicitly:
```
Use the code review agent to review all changed files.
```

### What It Does

The agent will:
1. Check git status
2. Review each changed file
3. Identify issues:
   - Visibility problems (protected vs public)
   - Missing return types
   - Guideline violations (facades vs helpers)
   - Code quality issues
4. Suggest improvements
5. Run formatting and test checks
6. Provide comprehensive feedback

## Example: Code Review Findings

### Issue 1: Incorrect Visibility

**Before:**
```php
protected function index()
{
    $messages = Message::forUser(auth()->id())->get();
    return MessageResource::collection($messages);
}
```

**After:**
```php
public function index(): \Illuminate\Http\JsonResponse
{
    $messages = Message::forUser(Auth::id())->get();
    return response()->json(MessageResource::collection($messages));
}
```

**Issues Fixed:**
- Changed `protected` to `public` (required for routing)
- Added return type
- Changed `auth()` helper to `Auth::` facade (guideline)
- Used `response()->json()` for consistency

### Issue 2: Missing Form Request

**Suggestion:**
Extract validation logic into a dedicated Form Request class following Laravel conventions.

## Making an Agent Both Subagent and Command

### Pattern: Command + Subagent

Create a reusable command file:

**File**: `.claude/commands/code-review.md`
```markdown
---
description: "Perform a code review on changed files"
---

Check git status and review all changed files.

Review for:
- Code quality issues
- Laravel best practices
- Guideline violations
- Missing return types
- Incorrect visibility
- Security concerns
- Performance issues

Run `composer run format` and `php artisan test --compact` to verify.

Provide specific, actionable feedback with code examples.
```

Then have your subagent defer to that command:

```
Run the code review command to begin the review.
```

**Benefits:**
- ✅ Can run command directly from CLI
- ✅ Can trigger as subagent for isolation
- ✅ Reusable logic in one place
- ✅ Both convenience and isolation benefits

## Running Multiple Subagents Concurrently

### Use Case: Brainstorming

Example: Design a dashboard to monitor Telegram interactions

**Approach 1**: Spin up two plan subagents concurrently
- Agent 1: Minimal Blade-based design
- Agent 2: Richer Livewire approach

**Result**: Claude compares both, merges useful ideas, recommends combined approach

**Benefits:**
- ✅ Multiple perspectives quickly
- ✅ Parallel exploration
- ✅ Faster brainstorming
- ✅ Better decision-making

**Considerations:**
- ⚠️ Token usage increases with concurrent agents
- ⚠️ Be mindful of costs
- ⚠️ Use when you need multiple perspectives

## When to Use Each

### Commands
**Use when:**
- Quick, single actions
- Things you do frequently
- Direct triggers needed
- Simple prompts

**Examples:**
- `/format` - Run formatters
- `/test` - Run tests
- `/learn` - Explain a file

**You will use these most** - they're snippets and triggers for common tasks.

### Skills
**Use when:**
- Multi-step workflows
- Complex processes
- Team conventions needed
- Complete workflows

**Examples:**
- `fix-issue` - Complete GitHub issue workflow
- `pest-testing` - Testing framework guidelines
- Custom workflows specific to your app

**Use for guidebooks** - document workflows specific to your app.

### Subagents
**Use when:**
- Multi-step or lengthy work
- Need isolation from main context
- Want parallel exploration
- Background processing needed

**Examples:**
- Code review agent
- Planning agents
- Research agents
- Analysis agents

**Use for isolated tasks** - biggest win is not clogging main context window.

## Creating Other Useful Agents

### Planning Agent

```
Act as a technical architect and create detailed implementation plans.

Process:
1. Understand the requirements
2. Break down into tasks
3. Identify dependencies
4. Suggest architecture
5. Estimate complexity
6. Provide step-by-step plan

Must use this agent when planning new features or refactors.
```

### Research Agent

```
Act as a research assistant and investigate best practices.

Process:
1. Research the topic
2. Find relevant documentation
3. Compare approaches
4. Provide recommendations
5. Cite sources

Must use this agent when researching solutions or best practices.
```

### Refactoring Agent

```
Act as a senior engineer and suggest refactoring improvements.

Process:
1. Analyze code structure
2. Identify refactoring opportunities
3. Suggest improvements
4. Maintain functionality
5. Ensure tests pass

Must use this agent when refactoring code.
```

## Best Practices

### 1. Clear Descriptions
Include trigger keywords in agent descriptions:
- "code review"
- "planning"
- "research"
- "refactoring"

### 2. Integrate Guidelines
- Keep guidelines up to date
- Reference them in agent instructions
- Ensure agents follow team conventions

### 3. Use Commands When Possible
- Create reusable commands
- Have subagents defer to commands
- Get both convenience and isolation

### 4. Monitor Token Usage
- Be aware of concurrent agents
- Use when benefits outweigh costs
- Consider token limits

### 5. Test Agents
- Test with various scenarios
- Refine descriptions based on results
- Update trigger keywords

## Integration Example

### Complete Workflow

1. **User**: "Fix issue #3"
2. **Claude**: Activates `fix-issue` skill
3. **Skill**: Executes workflow
4. **Subagent**: Runs code review (isolated)
5. **Command**: Runs `/format` and `/test`
6. **Result**: Complete fix with review

### Code Review Workflow

1. **User**: "Review my changes"
2. **Claude**: Triggers code review subagent
3. **Subagent**: Runs in isolation
4. **Command**: Uses `/code-review` command
5. **Guidelines**: Checks against project rules
6. **Result**: Comprehensive review

## Troubleshooting

### Agent Not Activating
- Check description includes trigger words
- Try explicit trigger: "use code review agent"
- Refine description with more keywords

### Agent Not Following Guidelines
- Ensure guidelines are up to date
- Reference guidelines in agent prompt
- Regenerate guidelines: `php artisan boost:install`

### Too Many Tokens
- Limit concurrent agents
- Use commands when possible
- Be selective about when to use subagents

## Summary

**Commands**: Triggers you use most often
- Quick, direct actions
- Like Artisan commands

**Skills**: Guidebooks for workflows
- Multi-step processes
- Team conventions

**Subagents**: Isolated background tasks
- Don't clog main context
- Can run concurrently
- Great for brainstorming

**Use the right tool for the job:**
- Commands for quick actions
- Skills for workflows
- Subagents for isolated work
