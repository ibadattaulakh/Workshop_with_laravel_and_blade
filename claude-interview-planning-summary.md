# Claude Interview Planning Implementation Summary

## What Was Implemented

### Documentation Created
- ✅ `claude-interview-planning-guide.md` - Complete guide on interview planning
- ✅ `claude-interview-planning-examples.md` - Example interviews and prompts
- ✅ `claude-interview-planning-summary.md` - This summary

### Commands Created
- ✅ `.claude/commands/plan-with-interview.md` - Command for interview planning

### Documentation Updated
- ✅ `.claude/commands/README.md` - Added plan-with-interview command
- ✅ `README.md` - Added Interview Planning section

## Interview Planning Overview

### The Problem
When you ask Claude to "build a dashboard" without details:
- ❌ Agent fills gaps with assumptions
- ❌ Plan may not match your intent
- ❌ Requires rework later

### The Solution
Have Claude interview you first:
- ✅ Collects details upfront
- ✅ Surfaces tradeoffs
- ✅ Reduces assumptions
- ✅ Produces accurate plans

## How It Works

### Two-Step Process

1. **Scan & Understand**
   - Claude scans target code/directory
   - Learns existing flow
   - Understands context

2. **Interview & Plan**
   - Claude asks clarifying questions
   - You answer questions
   - Claude synthesizes into plan

### Enable Plan Mode

Press **Shift+Tab** to enable plan mode so Claude knows to build a plan after the interview.

## Basic Usage

### Example Prompt

```
Explore the video_pipeline directory, understand how it works, then interview me (using the Ask User Question tool) to flesh out a plan for a dashboard.
```

### What Happens

1. Claude scans directory
2. Claude asks targeted questions
3. You answer conversationally
4. Claude creates detailed plan

## Example: Video Pipeline Dashboard

### Interview Questions

**Q: Series-level overview or episode-by-episode detail?**
A: Both - overview with drill-down.

**Q: Auto-update or manual refresh?**
A: Hybrid - deferred updates with manual refresh.

**Q: What actions available?**
A: Retry, reset, edit metadata, mark as free.

**Q: Where should it live?**
A: `/admin/pipeline`

### Result

Plan includes:
- ✅ Overview + detail views
- ✅ Actions supported
- ✅ Location specified
- ✅ Thoughtful UX decisions

## When to Use

### Good Use Cases
✅ **Features still evolving**
✅ **Complex features**
✅ **New features**
✅ **Features with ambiguity**

### Not Needed For
❌ **Simple, clear features**
❌ **Following existing patterns**

## Best Practices

### 1. Be Explicit
Tell Claude to interview you:
```
Interview me (using the Ask User Question tool) before drafting the plan.
```

### 2. Answer Concretely
- Short answers are fine
- Be specific, not vague
- Include examples if helpful

### 3. Flag Undecided
```
I don't have a preference yet - flag it as undecided in the plan.
```

### 4. Think About Tradeoffs
- Auto-refresh vs manual
- What actions to support
- Where to place feature
- UX patterns to follow

### 5. Review the Plan
- Verify it matches answers
- Refine if needed
- Ask for clarification

## Example Prompts

### Dashboard
```
Explore app/Http/Controllers, understand admin structure, then interview me to plan an admin dashboard.
```

### Feature
```
Review Post model and controllers, understand implementation, then interview me to plan bookmarking feature.
```

### Refactoring
```
Examine Telegram bot implementation, understand how it works, then interview me to plan improvements.
```

## Common Questions

### Scope & Structure
- What level of detail?
- Overview or detail views?
- What sections needed?

### Behavior
- Auto-update or manual?
- Real-time or on-demand?
- What actions available?

### Location
- Where should this live?
- What routes?
- Admin or public?

### UX
- What to display?
- How users interact?
- What feedback needed?

## Answering Strategies

### Be Specific
```
Good: /admin/pipeline
Bad: Somewhere in admin
```

### Provide Context
```
Good: Hybrid - cached data, manual refresh, auto-refresh every 30s
Bad: Yes
```

### Flag Undecided
```
Good: Use existing theme, flag as undecided
Bad: (no answer, agent guesses)
```

## Files Created

**Documentation:**
- `claude-interview-planning-guide.md`
- `claude-interview-planning-examples.md`
- `claude-interview-planning-summary.md` (this file)

**Commands:**
- `.claude/commands/plan-with-interview.md`

**Updated:**
- `.claude/commands/README.md`
- `README.md`

## Quick Reference

**Enable Plan Mode:** Press Shift+Tab

**Request Interview:**
```
Explore [directory], understand [how it works], then interview me (using the Ask User Question tool) to plan [feature].
```

**Answer Questions:**
- Be specific and concrete
- Short answers are fine
- Flag undecided areas

**Review Plan:**
- Check matches answers
- Verify completeness
- Refine if needed

## Key Points

- ✅ More accurate than guessing
- ✅ Surfaces important decisions
- ✅ Reduces assumptions
- ✅ Produces better plans
- ✅ Saves time overall

**Use when:**
- Feature isn't fully thought out
- Multiple approaches possible
- Important decisions needed
- Want to explore tradeoffs

**Process:**
1. Request interview
2. Enable plan mode (Shift+Tab)
3. Answer questions
4. Review plan
5. Implement

## Summary

Interview planning:
- ✅ Collects details upfront
- ✅ Surfaces tradeoffs
- ✅ Reduces assumptions
- ✅ Produces accurate plans
- ✅ Less rework needed

**Key:** Let Claude ask questions before planning, not after implementing.
