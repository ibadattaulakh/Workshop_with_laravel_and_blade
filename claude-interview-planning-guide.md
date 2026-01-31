# Claude Interview Planning Guide

## Overview

Instead of telling Claude what you want and hoping it guesses correctly, have Claude interview you first. This produces far more thoughtful, accurate plans by collecting the details needed upfront rather than filling gaps with assumptions.

## The Problem with Guessing

When you ask Claude to "build a dashboard" without details:
- ❌ Agent fills gaps with assumptions
- ❌ Plan may not match your intent
- ❌ Requires rework later
- ❌ Wasted effort

## The Solution: Interview First

When Claude interviews you before planning:
- ✅ Collects necessary details upfront
- ✅ Surfaces important tradeoffs
- ✅ Reduces assumptions
- ✅ Produces accurate plans
- ✅ Less rework needed

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

### The Ask User Question Tool

This special tool lets Claude prompt you for clarifying information before generating a plan. Use it when the feature isn't fully thought out yet.

## Basic Usage

### Enable Plan Mode

Press **Shift+Tab** to enable plan mode so Claude knows to build a plan once the interview is complete.

### Example Prompt

```
Explore the video_pipeline directory, understand how it works, then interview me (using the Ask User Question tool) to flesh out a plan for a dashboard.
```

### What Happens

1. Claude scans the directory
2. Claude asks targeted questions
3. You answer conversationally
4. Claude creates detailed plan

## Example: Video Pipeline Dashboard

### Initial Request

```
Explore the video_pipeline directory, understand how it works, then interview me (using the Ask User Question tool) to flesh out a plan for a dashboard.
```

### Interview Questions

Claude asks practical questions:

**Q: Do you want a series-level overview or episode-by-episode detail?**
A: Both - overview with drill-down to episodes.

**Q: Should the dashboard auto-update or require manual refresh?**
A: Hybrid - deferred updates with manual refresh button.

**Q: Do you want to take actions from the dashboard (retry, reset, edit metadata) or just view status?**
A: Yes, actions: retry, reset, edit metadata, mark as free.

**Q: Where should the dashboard live?**
A: `/admin/pipeline`

### Result

Claude creates a plan with:
- ✅ Overview + detail views
- ✅ Actions supported (retry/edit/mark free)
- ✅ Location in admin area
- ✅ Thoughtful UX decisions
- ✅ Specific implementation details

## When to Use Interview Planning

### Good Use Cases

✅ **Features still evolving**
- Not fully thought out
- Need to explore options
- Multiple approaches possible

✅ **Complex features**
- Multiple components
- Various tradeoffs
- Important decisions needed

✅ **New features**
- No existing patterns
- Need to establish conventions
- Important to get right

✅ **Features with ambiguity**
- Unclear requirements
- Multiple interpretations
- Need clarification

### Not Needed For

❌ **Simple, clear features**
- Well-defined requirements
- Obvious implementation
- No ambiguity

❌ **Following existing patterns**
- Similar to existing features
- Clear conventions
- Straightforward implementation

## Best Practices

### 1. Be Explicit

Tell Claude to interview you:
```
Interview me (using the Ask User Question tool) before drafting the plan.
```

### 2. Answer Concretely

Provide specific answers:
- Short answers are fine
- Be concrete, not vague
- Include examples if helpful

### 3. Flag Undecided Areas

If you don't care about a decision yet:
```
I don't have a preference on that yet - flag it as undecided in the plan.
```

### 4. Think About Tradeoffs

Consider important decisions:
- Auto-refresh vs manual refresh
- What actions to support
- Where to place the feature
- UX patterns to follow

### 5. Review the Plan

After interview:
- Review the generated plan
- Verify it matches your answers
- Refine if needed
- Ask for clarification

## Example Prompts

### Dashboard Planning

```
Explore the app/Http/Controllers directory, understand the existing admin structure, then interview me (using the Ask User Question tool) to create a plan for an admin dashboard.
```

### Feature Planning

```
Review the Post model and related controllers, understand the current implementation, then interview me (using the Ask User Question tool) to plan a bookmarking feature.
```

### Refactoring Planning

```
Examine the Telegram bot implementation in app/Services/Telegram, understand how it works, then interview me (using the Ask User Question tool) to plan improvements.
```

### API Planning

```
Review the existing API routes and controllers, understand the patterns, then interview me (using the Ask User Question tool) to plan a new API endpoint.
```

## Interview Question Examples

### Common Questions

**Scope & Structure:**
- What level of detail do you want?
- Should it be overview + detail or single view?
- What sections/components are needed?

**Behavior:**
- Auto-update or manual refresh?
- Real-time or on-demand?
- What actions should be available?

**Location:**
- Where should this live?
- What routes should be used?
- Admin area or public?

**UX:**
- What information should be displayed?
- How should users interact?
- What feedback is needed?

**Technical:**
- What data sources?
- What permissions needed?
- Performance considerations?

## Answering Questions

### Good Answers

**Specific:**
```
Q: Where should the dashboard live?
A: /admin/pipeline
```

**Concrete:**
```
Q: What actions do you want?
A: Retry failed jobs, reset status, edit metadata, mark as free.
```

**With Context:**
```
Q: Auto-refresh or manual?
A: Hybrid - show cached data with manual refresh button, and auto-refresh every 30 seconds when active.
```

### Flagging Undecided

```
Q: What color scheme?
A: I don't have a preference yet - use the existing admin theme and flag this as undecided.
```

## Plan Review

### After Interview

Review the plan for:
- ✅ Matches your answers
- ✅ Includes all requirements
- ✅ Addresses tradeoffs
- ✅ Flags undecided areas
- ✅ Follows existing patterns

### Refining Plans

If plan needs adjustment:
- Ask for clarification
- Provide more details
- Request specific changes
- Iterate on the plan

## Integration with Other Tools

### With Claude Skills

Use interview planning, then execute with skill:
1. Interview to create plan
2. Use `fix-issue` skill to implement
3. Follow the detailed plan

### With Claude Commands

After plan is created:
- Use `/format` to ensure style
- Use `/test` to verify implementation
- Use `/code-review` to review

### With PhpStorm Prompts

Use plan to guide:
- File-level transformations
- Consistent implementation
- Following established patterns

## Workflow Example

### Complete Flow

1. **Request Interview**
   ```
   Explore the video_pipeline directory, understand how it works, then interview me (using the Ask User Question tool) to flesh out a plan for a dashboard.
   ```

2. **Enable Plan Mode**
   - Press Shift+Tab
   - Claude knows to create plan

3. **Answer Questions**
   - Respond to each question
   - Be specific and concrete
   - Flag undecided areas

4. **Review Plan**
   - Check plan matches answers
   - Verify completeness
   - Refine if needed

5. **Implement**
   - Follow the plan
   - Use skills/commands
   - Verify with tests

## Tips

### 1. Start with Context

Give Claude context to scan:
```
Explore [directory], understand [how it works], then interview me...
```

### 2. Be Conversational

Answer naturally:
- Short answers are fine
- Add detail when helpful
- Don't overthink

### 3. Think Ahead

Consider:
- What decisions matter?
- What tradeoffs exist?
- What patterns to follow?

### 4. Review Thoroughly

Check the plan:
- Matches your vision?
- Includes all details?
- Addresses concerns?

### 5. Iterate if Needed

Don't hesitate to:
- Ask for clarification
- Provide more details
- Refine the plan

## Common Scenarios

### Scenario 1: New Feature

**Request:**
```
Review the Post model and controllers, understand the current implementation, then interview me to plan a bookmarking feature.
```

**Questions:**
- Where should bookmarks be stored?
- What UI elements needed?
- What actions available?
- Where should it appear?

### Scenario 2: Dashboard

**Request:**
```
Explore the admin area, understand existing patterns, then interview me to plan an analytics dashboard.
```

**Questions:**
- What metrics to display?
- Time range options?
- Export functionality?
- Real-time or historical?

### Scenario 3: API Endpoint

**Request:**
```
Review existing API routes, understand patterns, then interview me to plan a new endpoint.
```

**Questions:**
- What data to return?
- Authentication needed?
- Rate limiting?
- Versioning?

## Summary

Interview planning is:
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

**Remember:**
- Be explicit about interview request
- Answer concretely
- Flag undecided areas
- Review plan thoroughly
- Iterate if needed
