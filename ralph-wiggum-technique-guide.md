# Ralph Wiggum Technique Guide

## Overview

The Ralph Wiggum Technique is an agent-focused workflow where a script reads a `tasks.md` file, chooses one incomplete task, implements it, runs tests and formatters, commits the change, and documents progress. The agent repeats this process until all tasks are complete.

## Why It Works

### Focus on One Task

- ✅ Agent works on one thing at a time
- ✅ Keeps context manageable
- ✅ Reduces accidental scope creep
- ✅ Clear completion criteria

### Automated Workflow

- ✅ Reads tasks from file
- ✅ Implements change
- ✅ Tests and formats
- ✅ Commits changes
- ✅ Updates progress
- ✅ Loops until done

## How It Works

### The Loop

1. **Read tasks.md** - Agent reads incomplete tasks
2. **Pick one task** - Agent chooses suitable task
3. **Implement** - Agent makes the change
4. **Test** - Run test suite (must pass)
5. **Format** - Run formatters
6. **Commit** - Commit changes
7. **Update tasks.md** - Mark complete, add progress
8. **Repeat** - Until all tasks done or max iterations

### Exit Strategies

**Two safety mechanisms:**

1. **Completion flag** - Agent creates `ralph_complete` when no tasks remain
2. **Max iterations** - Script stops after N iterations (default: 10)

## Setup

### 1. Create Tasks File

Create `tasks.md` with incomplete tasks:

```markdown
# Tasks

## Incomplete Tasks

- [ ] Remove lingering thumbnail references
- [ ] Promote DevOps category to top when fetching categories
- [ ] Add tests for category sorting
- [ ] Update documentation for thumbnail removal

## Progress

<!-- Agent will append progress here -->
```

### 2. Make Script Executable

```bash
chmod +x bin/ralph
```

### 3. Configure Agent CLI

Edit `bin/ralph` and replace the agent CLI placeholder with your actual command:

```bash
# Replace this placeholder:
echo "$AGENT_PROMPT" | your-agent-cli --non-interactive

# With your actual agent command, e.g.:
claude --non-interactive --stdin <<< "$AGENT_PROMPT"
```

### 4. Pre-Approve Permissions

Configure your agent to pre-approve:
- Git commands (add, commit, checkout, branch)
- Composer commands
- PHP Artisan commands
- Test commands
- Formatter commands

## Usage

### Basic Usage

```bash
bin/ralph
```

Runs up to 10 iterations (default).

### With Max Iterations

```bash
bin/ralph 20
```

Runs up to 20 iterations.

### Interactive Mode

For testing, run agent in interactive mode:
- Watch what agent does
- Approve prompts manually
- See reasoning in real-time

Edit script to remove `--non-interactive` flag.

### Non-Interactive Mode

For automated runs:
- Agent runs straight through
- No manual intervention
- Continues looping automatically

**Warning**: Ensure permissions are pre-approved.

## Example Workflow

### Step 1: Populate Tasks

Edit `tasks.md`:
```markdown
## Incomplete Tasks

- [ ] Add bookmarking feature
- [ ] Add tests for bookmarking
- [ ] Update documentation
```

### Step 2: Run Ralph

```bash
bin/ralph 10
```

### Step 3: Watch Progress

Agent will:
1. Pick "Add bookmarking feature"
2. Implement it
3. Run tests
4. Format code
5. Commit
6. Update tasks.md

### Step 4: Continue

Agent picks next task and repeats.

### Step 5: Completion

When all tasks done:
- Agent creates `ralph_complete`
- Script exits
- Check `tasks.md` for progress

## Tasks File Format

### Structure

```markdown
# Tasks

## Incomplete Tasks

- [ ] Task 1 - Description
- [ ] Task 2 - Description
- [x] Completed task - Description

## Progress

### [Date] - Task 1
- Implemented bookmarking feature
- Added tests
- Updated documentation
- Tests passing ✅
```

### Task Format

- Use `- [ ]` for incomplete tasks
- Use `- [x]` for completed tasks
- Include clear descriptions
- Be specific about requirements

### Progress Section

Agent will append:
- Date/time
- Task completed
- What was done
- Test results

## The Script

### What It Does

`bin/ralph`:
1. Checks for completion flag
2. Reads tasks.md
3. Sends prompt to agent
4. Runs verification (tests, format)
5. Commits changes
6. Repeats loop

### Key Features

- **Max iterations** - Prevents infinite loops
- **Completion flag** - Intentional exit signal
- **Verification** - Tests and formatters
- **Progress tracking** - Updates tasks.md
- **Error handling** - Continues on failures

## Best Practices

### 1. Start Small

- Begin with simple tasks
- Test the workflow
- Build confidence
- Expand gradually

### 2. Clear Tasks

Write clear, specific tasks:
```
Good: Add bookmarking feature with tests
Bad: Fix stuff
```

### 3. Pre-Approve Commands

Configure agent to allow:
- Git operations
- Composer commands
- Artisan commands
- Test/formatter commands

### 4. Monitor Progress

- Watch first few iterations
- Check tasks.md updates
- Verify commits
- Review test results

### 5. Use Max Iterations

Always set a limit:
```bash
bin/ralph 10  # Safe limit
```

### 6. Review Changes

- Review commits
- Check test results
- Verify functionality
- Don't blindly merge

## Integration

### With Testing Requirements

Ralph enforces:
- Tests must be written
- Tests must pass
- Work not complete until tests green

### With Git Worktrees

Use worktrees for isolation:
```bash
bin/worktree ralph-tasks
cd ../laravel-workshop-ralph-tasks
bin/ralph 10
```

### With Other Tools

- Use `/test` command after each iteration
- Use `/format` to verify style
- Use `/code-review` for review

## Troubleshooting

### Agent Hangs

**Cause**: Permission prompt
**Fix**: Pre-approve commands in agent settings

### Tests Fail

**Cause**: Agent didn't fix tests
**Fix**: Check agent prompt includes test requirement

### No Progress

**Cause**: Agent not updating tasks.md
**Fix**: Check agent has write permissions

### Infinite Loop

**Cause**: No completion flag created
**Fix**: Check max iterations, verify tasks.md format

### Commits Not Happening

**Cause**: Agent or script commit failing
**Fix**: Check Git permissions, verify agent can commit

## Advanced Usage

### Multiple Repositories

Run Ralph across repos:
```bash
for repo in repo1 repo2 repo3; do
  cd $repo
  bin/ralph 5
done
```

### GitHub Issues Integration

Generate tasks.md from GitHub issues:
```bash
gh issue list --json number,title | jq -r '.[] | "- [ ] #\(.number) - \(.title)"' > tasks.md
```

### Continuous Integration

Run Ralph in CI:
- Set max iterations low
- Pre-approve all commands
- Review results carefully

## Safety Considerations

### 1. Max Iterations

Always set a limit to prevent infinite loops.

### 2. Review Changes

Don't blindly trust agent:
- Review commits
- Check test results
- Verify functionality

### 3. Pre-Approve Commands

Only approve trusted commands:
- Git operations
- Composer/Artisan
- Tests/Formatters
- Not: rm, sudo, etc.

### 4. Use Worktrees

Isolate Ralph runs:
- Create worktree
- Run Ralph there
- Review before merging

### 5. Start Small

- Test with simple tasks
- Build confidence
- Expand gradually

## Example: Complete Run

### Initial tasks.md

```markdown
## Incomplete Tasks

- [ ] Add bookmarking feature
- [ ] Add tests for bookmarking
```

### Run Ralph

```bash
bin/ralph 5
```

### After Iteration 1

**tasks.md updated:**
```markdown
## Incomplete Tasks

- [x] Add bookmarking feature
- [ ] Add tests for bookmarking

## Progress

### 2026-01-31 - Add bookmarking feature
- Created Bookmark model and migration
- Added bookmark routes and controller
- Implemented bookmark/unbookmark functionality
- Tests passing ✅
```

### After Iteration 2

**tasks.md updated:**
```markdown
## Incomplete Tasks

- [x] Add bookmarking feature
- [x] Add tests for bookmarking

## Progress

### 2026-01-31 - Add bookmarking feature
- Created Bookmark model and migration
- Added bookmark routes and controller
- Implemented bookmark/unbookmark functionality
- Tests passing ✅

### 2026-01-31 - Add tests for bookmarking
- Created BookmarkTest feature test
- Added tests for bookmark/unbookmark
- Added authorization tests
- All tests passing ✅
```

### Completion

Agent creates `ralph_complete`, script exits.

## Summary

Ralph Wiggum Technique:
- ✅ Automated task execution
- ✅ One task at a time
- ✅ Tests and formatting
- ✅ Progress tracking
- ✅ Safe exit strategies

**Use for:**
- Repetitive tasks
- Small improvements
- Test additions
- Documentation updates
- Code cleanup

**Remember:**
- Start small
- Set max iterations
- Review changes
- Pre-approve commands
- Use worktrees for isolation
