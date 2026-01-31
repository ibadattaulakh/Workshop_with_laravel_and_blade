# Claude Skills Guide

## Overview

Claude Skills are field guides that tell the AI how to do things and when to follow specific processes. Unlike commands (which are single-shot triggers), skills are multi-step instructions that guide the agent through complete workflows.

## Skills vs Commands

### Commands
- **What**: Single-shot triggers for prompts
- **Location**: `.claude/commands/`
- **Use case**: Quick, repeatable prompts
- **Example**: `/format`, `/test`, `/learn`

### Skills
- **What**: Field guides with multi-step workflows
- **Location**: `.claude/skills/`
- **Use case**: Complex workflows requiring multiple steps
- **Example**: Fix GitHub issue, write tests, refactor code

## How Skills Work

### Structure

Skills are Markdown files with YAML front matter:

```markdown
---
name: skill-name
description: "Clear description of when to use this skill"
---

# Skill Content

Detailed field guide with step-by-step instructions...
```

### Description is Critical

Claude often only loads the skill name and description into context initially. The description must be explicit about:
- **When** to use the skill
- **What** triggers it
- **Why** it's needed

Include trigger words in the description:
- "fix a GitHub issue"
- "resolve an issue"
- "handle a bug report"

### Field Guide Content

The skill content should describe:
- Exact steps to follow
- Team conventions
- Required checks
- Non-negotiable requirements
- Example workflows

## Available Skills

### fix-issue

**Location**: `.claude/skills/fix-issue/SKILL.md`

**When to use**: Fixing GitHub issues

**Workflow**:
1. Fetch issue details (`gh issue view N`)
2. Create branch (`fix/issue-N`)
3. Implement fix
4. Write regression tests
5. Run formatters (`composer run format`)
6. Run tests (`php artisan test`)
7. Commit with convention
8. Push and create PR
9. Close issue

**Key requirements**:
- Tests are non-negotiable
- Formatting must pass
- Tests must pass before completion
- Follow commit message conventions

### pest-testing

**Location**: `.claude/skills/pest-testing/SKILL.md`

**When to use**: Writing or modifying tests

**Covers**: Pest 4 framework, test patterns, assertions, browser testing

### inertia-vue-development

**Location**: `.claude/skills/inertia-vue-development/SKILL.md`

**When to use**: Working with Inertia.js Vue pages, forms, navigation

**Covers**: Vue 3, Inertia v2, Composition API, forms, routing

### tailwindcss-development

**Location**: `.claude/skills/tailwindcss-development/SKILL.md`

**When to use**: Styling, CSS, Tailwind utilities

**Covers**: Tailwind CSS v4, responsive design, dark mode, utilities

## Creating a New Skill

### 1. Create Directory Structure

```bash
mkdir -p .claude/skills/my-skill
```

### 2. Create Skill File

Create `.claude/skills/my-skill/SKILL.md`:

```markdown
---
name: my-skill
description: >-
  Clear description with trigger words. Activates when user mentions X, Y, or Z.
---

# My Skill

## When to Apply

Activate this skill when:
- User mentions X
- User asks for Y
- User wants Z

## Workflow

Step-by-step instructions...

## Important Rules

- Rule 1
- Rule 2
- Rule 3
```

### 3. Add to Guidelines

Add reference in `.ai/guidelines/skills.md`:

```markdown
## My Skill

When asked to do X, immediately use the `my-skill` Claude skill.
```

### 4. Test the Skill

Try using the skill with various phrasings:
- "Fix issue #3"
- "Resolve GitHub issue 3"
- "Handle bug report #3"

If it doesn't activate, refine the description with more trigger words.

## Best Practices

### 1. Be Explicit in Description

Include trigger words:
```yaml
description: >-
  Fix GitHub issues. Activates when user mentions "fix issue", "resolve issue",
  "GitHub issue", "bug report", or issue numbers.
```

### 2. Include Non-Negotiable Requirements

Make critical steps clear:
```markdown
## Important Rules

**CRITICAL**: Do not mark complete until tests pass.
**REQUIRED**: Run formatters before committing.
```

### 3. Provide Examples

Include complete workflow examples:
```markdown
## Example: Complete Workflow

```bash
# Step 1
command1

# Step 2
command2
```
```

### 4. Mirror in Guidelines

Add to `.ai/guidelines/skills.md` to increase activation:
```markdown
When asked to fix a GitHub issue, immediately use the `fix-issue` skill.
```

### 5. Test and Refine

- Test with various phrasings
- Refine description if not activating
- Add more trigger words
- Update guidelines

## Example: Fix Issue Skill Usage

### User Request
```
Look at GitHub issue #3, make the fix, and submit a PR.
```

### Skill Activation
Claude sees "GitHub issue #3" and "submit a PR" → activates `fix-issue` skill

### Skill Execution
1. Fetches issue: `gh issue view 3`
2. Creates branch: `fix/issue-3`
3. Implements fix
4. Writes tests
5. Runs formatters
6. Runs tests
7. Commits: `Fix issue #3: ...`
8. Pushes and creates PR
9. Provides summary with PR link

### Result
Complete workflow executed automatically with proper conventions.

## Troubleshooting

### Skill Not Activating

1. **Check description** - Include trigger words
2. **Check guidelines** - Add to `.ai/guidelines/skills.md`
3. **Refine description** - Be more explicit
4. **Add synonyms** - Include alternative phrasings

### Skill Executing Incorrectly

1. **Review workflow steps** - Make them more explicit
2. **Add examples** - Show exact commands
3. **Clarify requirements** - Make non-negotiable steps clear
4. **Test incrementally** - Verify each step

### Missing Steps

1. **Add to workflow** - Include all required steps
2. **Make explicit** - Don't assume knowledge
3. **Add checks** - Verify each step completes
4. **Provide examples** - Show complete workflow

## Integration

Skills work with:
- **Claude Commands** - Quick prompts
- **PhpStorm Prompts** - File-level transformations
- **Context Seven** - Up-to-date documentation

Use the right tool:
- **Skills**: Multi-step workflows
- **Commands**: Single prompts
- **Prompts**: File transformations

## Files Structure

```
.claude/
  skills/
    fix-issue/
      SKILL.md
    pest-testing/
      SKILL.md
    inertia-vue-development/
      SKILL.md
    tailwindcss-development/
      SKILL.md

.ai/
  guidelines/
    skills.md
```

## Benefits

- ✅ **Consistent workflows** - Same process every time
- ✅ **Team conventions** - Enforced automatically
- ✅ **Complete automation** - End-to-end workflows
- ✅ **Quality checks** - Tests and formatting required
- ✅ **Version controlled** - Skills in repo

## Quick Reference

**Create skill**: `.claude/skills/my-skill/SKILL.md`

**Activate**: Include trigger words in description

**Guidelines**: Add to `.ai/guidelines/skills.md`

**Test**: Try various phrasings

**Refine**: Update description and guidelines
