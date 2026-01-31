# Ralph Wiggum Technique Implementation Summary

## What Was Implemented

### Script Created
- ✅ `bin/ralph` - Automated task execution script (executable)

### Documentation Created
- ✅ `ralph-wiggum-technique-guide.md` - Complete guide
- ✅ `ralph-wiggum-technique-summary.md` - This summary

### Files Created
- ✅ `tasks.md` - Template tasks file

### Documentation Updated
- ✅ `bin/README.md` - Added ralph script docs

## Ralph Wiggum Technique Overview

### What It Is

An agent-focused workflow where:
- Script reads `tasks.md`
- Agent picks ONE incomplete task
- Agent implements the change
- Runs tests and formatters
- Commits changes
- Updates tasks.md
- Repeats until done

### Key Principle

**Focus on one task at a time:**
- Keeps context manageable
- Reduces scope creep
- Clear completion criteria
- Easier to verify

## How It Works

### The Loop

1. Read `tasks.md`
2. Pick one task
3. Implement change
4. Run tests (must pass)
5. Run formatters
6. Commit changes
7. Update `tasks.md`
8. Repeat

### Exit Strategies

**Two safety mechanisms:**

1. **Completion flag** - `ralph_complete` file
2. **Max iterations** - Default: 10

## The Script

### What It Does

`bin/ralph`:
- Checks for completion flag
- Reads tasks.md
- Sends prompt to agent
- Runs verification (tests, format)
- Commits changes
- Repeats loop

### Usage

```bash
bin/ralph          # 10 iterations (default)
bin/ralph 20       # 20 iterations
```

### Configuration

**Edit script to replace agent CLI placeholder:**
```bash
# Replace placeholder with your agent CLI
claude --non-interactive --stdin <<< "$AGENT_PROMPT"
```

## Tasks File Format

### Structure

```markdown
# Tasks

## Incomplete Tasks

- [ ] Task 1 - Description
- [ ] Task 2 - Description

## Progress

<!-- Agent appends progress here -->
```

### Task Format

- `- [ ]` for incomplete
- `- [x]` for completed
- Clear descriptions
- Specific requirements

## Example Workflow

### Step 1: Populate Tasks

Edit `tasks.md`:
```markdown
- [ ] Add bookmarking feature
- [ ] Add tests for bookmarking
```

### Step 2: Run Ralph

```bash
bin/ralph 10
```

### Step 3: Watch Progress

Agent:
1. Picks task
2. Implements
3. Tests
4. Formats
5. Commits
6. Updates tasks.md

### Step 4: Completion

When done:
- Agent creates `ralph_complete`
- Script exits
- Check progress in `tasks.md`

## Integration

### With Testing Requirements

Ralph enforces:
- Tests must be written
- Tests must pass
- Work not complete until green

### With Git Worktrees

Use for isolation:
```bash
bin/worktree ralph-tasks
cd ../laravel-workshop-ralph-tasks
bin/ralph 10
```

### With Other Tools

- `/test` - Verify tests
- `/format` - Check style
- `/code-review` - Review changes

## Best Practices

### 1. Start Small
- Simple tasks first
- Test workflow
- Build confidence

### 2. Clear Tasks
- Specific descriptions
- Clear requirements
- One task per item

### 3. Pre-Approve Commands
- Git operations
- Composer/Artisan
- Tests/Formatters

### 4. Set Max Iterations
```bash
bin/ralph 10  # Safe limit
```

### 5. Review Changes
- Check commits
- Verify tests
- Review functionality

## Safety Considerations

### 1. Max Iterations
Always set limit to prevent infinite loops.

### 2. Review Changes
Don't blindly trust:
- Review commits
- Check tests
- Verify functionality

### 3. Pre-Approve Commands
Only trusted commands:
- Git, Composer, Artisan
- Tests, Formatters
- Not: rm, sudo, etc.

### 4. Use Worktrees
Isolate runs:
- Create worktree
- Run Ralph there
- Review before merging

## Files Created

**Script:**
- `bin/ralph` (executable)

**Documentation:**
- `ralph-wiggum-technique-guide.md`
- `ralph-wiggum-technique-summary.md` (this file)

**Template:**
- `tasks.md`

**Updated:**
- `bin/README.md`

## Quick Reference

**Create tasks:**
Edit `tasks.md` with incomplete tasks

**Run Ralph:**
```bash
bin/ralph [max_iterations]
```

**Monitor:**
- Watch iterations
- Check tasks.md updates
- Review commits

**Complete:**
Agent creates `ralph_complete` when done

## Key Points

- ✅ One task at a time
- ✅ Automated workflow
- ✅ Tests and formatting
- ✅ Progress tracking
- ✅ Safe exit strategies

**Use for:**
- Repetitive tasks
- Small improvements
- Test additions
- Documentation
- Code cleanup

**Remember:**
- Start small
- Set max iterations
- Review changes
- Pre-approve commands
- Use worktrees

## Summary

Ralph Wiggum Technique provides:
- Automated task execution
- Focused, one-task workflow
- Tests and formatting
- Progress tracking
- Safe, controlled automation

**Workflow:**
1. Populate `tasks.md`
2. Run `bin/ralph`
3. Agent works through tasks
4. Review progress
5. Merge when satisfied

**Benefits:**
- ✅ Automated repetitive work
- ✅ Consistent process
- ✅ Progress tracking
- ✅ Test enforcement
- ✅ Safe iteration
