# Claude GitHub PR Integration Guide

## Overview

You can mention Claude directly in a GitHub PR conversation and have it make code changes for you. This is handy when reviewing PRs and you want small changes like renames, refactors, or consistency fixes without waiting for follow-up commits.

## What It Does

Claude can:
- ✅ Respond to mentions in PR comments
- ✅ Make code changes based on your instructions
- ✅ Update related files automatically
- ✅ Post summaries of changes made
- ✅ Link to updated files

## Setup

### Step 1: Install Claude GitHub App

Install the Cloud Code / Claude GitHub app for your repository:

```bash
# Use Cloud Code's helper to install the app
# Follow the prompts to authorize for your repository
```

**Installation Flow:**
1. Run Cloud Code install command
2. Choose which repository to authorize
3. Select permissions to grant
4. Choose repository-only (safer than org-wide)

**Recommended Settings:**
- ✅ Repository-only access (not org-wide)
- ✅ Mention-only mode (explicit control)
- ✅ Only on repositories you trust

### Step 2: GitHub Workflow Created

After authorization, Cloud Code creates a GitHub Action workflow in your repo that:
- Runs when Claude is mentioned in PR comments
- Installs Cloud Code/Claude
- Executes the prompt from the comment
- Reports progress in Actions tab
- Posts summary in PR

### Step 3: Configure Behavior

Configure whether Claude:
- **Mention-only**: Only responds when explicitly mentioned (recommended)
- **Auto-review**: Also performs automatic code reviews

**Recommendation**: Enable mention-only for safety and explicit control.

## Usage

### Basic Flow

1. **Create PR** (feature branch with changes)
2. **Review PR** (view changed files)
3. **Mention Claude** in PR comment
4. **Watch Action run** (in Actions tab)
5. **Review changes** (Claude posts summary)
6. **Merge PR** (if changes look good)

### Example: Rename Class

**PR Comment:**
```
@Claude change PostBookmark to Bookmark and update related files as needed.
```

**What Claude Does:**
1. Renames `PostBookmark` to `Bookmark`
2. Updates migrations
3. Updates factories
4. Updates related files
5. Posts summary with links

### Example: Refactor Code

**PR Comment:**
```
@Claude extract the common error handling into a trait and use it across all job classes.
```

**What Claude Does:**
1. Creates trait with error handling
2. Updates job classes to use trait
3. Removes duplicate code
4. Posts summary

### Example: Consistency Fixes

**PR Comment:**
```
@Claude update all controller methods to use Form Requests instead of inline validation.
```

**What Claude Does:**
1. Creates Form Request classes
2. Updates controllers
3. Moves validation rules
4. Posts summary

## When to Use

### Good Use Cases

✅ **Small, deterministic changes**
- Renames (classes, methods, variables)
- Small refactors
- Consistency fixes
- Code style updates

✅ **During code review**
- Quick fixes based on feedback
- Addressing review comments
- Small improvements

✅ **Clear, specific requests**
- Well-defined changes
- Obvious improvements
- Non-controversial updates

### Not Ideal For

❌ **Deep design discussions**
- Architectural changes
- Major refactors
- Design decisions

❌ **Complex changes**
- Multi-file refactors
- Breaking changes
- Performance optimizations

❌ **Unclear requirements**
- Vague requests
- Ambiguous changes
- Requires discussion

## Best Practices

### 1. Be Specific

Provide clear, specific instructions:

**Good:**
```
@Claude rename PostBookmark to Bookmark and update all references in migrations, factories, and controllers.
```

**Bad:**
```
@Claude fix the naming.
```

### 2. Review Changes

**Always review Claude's changes:**
- Check the diff
- Verify related files updated
- Ensure tests still pass
- Review for correctness

### 3. Use for Small Changes

- Renames
- Small refactors
- Consistency fixes
- Code style updates

**Not for:**
- Major refactors
- Design changes
- Complex logic

### 4. Test After Changes

After Claude makes changes:
- Run tests locally
- Verify functionality
- Check for regressions

### 5. Security Considerations

- Install app only on trusted repos
- Use repository-only access
- Enable mention-only mode
- Review all changes before merging

## Workflow Example

### Complete Flow

1. **Create Feature Branch**
   ```bash
   git checkout -b feature/bookmarking
   ```

2. **Make Initial Changes**
   - Create model, migration, factory
   - Commit changes
   ```bash
   git add -A
   git commit -m "Implement bookmarking"
   ```

3. **Push and Create PR**
   ```bash
   git push -u origin feature/bookmarking
   gh pr create --title "Implement bookmarking" --body "This should be all you need."
   ```

4. **Review PR**
   - View changed files
   - Identify improvements needed

5. **Mention Claude**
   ```
   @Claude change PostBookmark to Bookmark and update related files as needed.
   ```

6. **Watch Action Run**
   - Check Actions tab
   - See progress updates
   - Wait for completion

7. **Review Changes**
   - Check Claude's summary
   - Review diff
   - Verify updates

8. **Test and Merge**
   - Run tests locally
   - Verify functionality
   - Merge if good

## Integration with Other Tools

### With Claude Commands

After Claude makes changes in PR:
- Use `/test` command locally to verify
- Use `/format` command to check style
- Use `/code-review` for additional review

### With Claude Skills

Use `fix-issue` skill, then mention Claude in PR:
1. Fix issue using skill
2. Create PR
3. Mention Claude for improvements
4. Review and merge

### With Browser Testing

After Claude makes UI changes:
- Use `/test-with-chrome` to verify
- Check UI works correctly
- Verify no regressions

## Monitoring

### Actions Tab

Watch the GitHub Action:
- See when it starts
- Monitor progress
- Check for errors
- View completion status

### PR Comments

Claude posts:
- Summary of changes
- Links to updated files
- List of files modified
- Any issues encountered

## Troubleshooting

### Claude Not Responding

- Check GitHub app is installed
- Verify mention format: `@Claude`
- Check Actions tab for errors
- Ensure workflow is enabled

### Changes Not Applied

- Review error messages in Actions
- Check permissions
- Verify repository access
- Try more specific instructions

### Unexpected Changes

- Review diff carefully
- Revert if needed
- Provide more specific instructions
- Use smaller, focused requests

## Security Best Practices

### 1. Repository-Only Access

- Install app on specific repos only
- Avoid org-wide access
- Use for trusted repositories

### 2. Mention-Only Mode

- Enable mention-only (not auto-review)
- Explicit control over when Claude acts
- Safer default behavior

### 3. Review All Changes

- Always review diffs
- Verify changes are correct
- Test before merging
- Don't auto-merge Claude changes

### 4. Clear Instructions

- Be specific in requests
- Avoid ambiguous changes
- Test after changes
- Verify functionality

## Example PR Comments

### Rename Class
```
@Claude rename PostBookmark to Bookmark and update all references in migrations, factories, controllers, and tests.
```

### Extract Trait
```
@Claude extract the common error handling logic into a HandlesErrors trait and update all job classes to use it.
```

### Add Return Types
```
@Claude add explicit return types to all controller methods in this PR.
```

### Use Form Requests
```
@Claude extract validation logic from PostController::store into a StorePostRequest class and update the controller to use it.
```

### Consistency Fix
```
@Claude update all instances of auth() helper to use Auth:: facade throughout the changed files.
```

## Tips

### 1. Start Small

- Try simple renames first
- See how it works
- Build confidence
- Expand gradually

### 2. Be Explicit

- Clear instructions
- Specific file names
- Obvious changes
- Well-defined scope

### 3. Review Everything

- Check all changes
- Verify related files
- Test functionality
- Review for correctness

### 4. Use Incrementally

- Small changes per comment
- Review each change
- Build up improvements
- Don't ask for too much at once

### 5. Combine with Review

- Use during code review
- Address feedback quickly
- Improve PR quality
- Faster iteration

## Summary

GitHub PR integration is:
- ✅ Great for small, deterministic changes
- ✅ Useful during code review
- ✅ Fast and explicit
- ✅ Empowering workflow
- ⚠️ Requires careful review
- ⚠️ Not for complex changes
- ⚠️ Security considerations important

**Use it to:**
- Rename classes/methods
- Small refactors
- Consistency fixes
- Address review comments

**Always:**
- Review changes carefully
- Test after changes
- Verify functionality
- Use for trusted repos only
