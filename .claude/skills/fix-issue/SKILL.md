---
name: fix-issue
description: >-
  Review a GitHub issue, fix the issue in the repository, and submit a PR that closes the issue.
  Reach for this skill whenever asked to fix a GitHub issue, resolve an issue, or handle a bug report.
---

# Fix GitHub Issue Skill

## When to Apply

Activate this skill when:
- User asks to fix a GitHub issue
- User mentions resolving an issue number
- User wants to fix a bug reported in GitHub
- User asks to "look at issue #X" or "fix issue #X"
- User mentions creating a PR for an issue

## Workflow

Follow these steps exactly when fixing a GitHub issue:

### 1. Fetch and Analyze the Issue

Fetch the issue details using GitHub CLI:
```bash
gh issue view <issue-number>
```

Analyze the issue:
- Understand what needs to be fixed
- Identify the affected files
- Determine the root cause
- Plan the fix approach

### 2. Create a Branch

Create a branch using our naming convention:
```bash
git checkout -b fix/issue-<issue-number>
```

Example: `fix/issue-3`

### 3. Implement the Fix

- Follow all existing code guidelines in the repository
- Check sibling files for correct structure, approach, and naming
- Use existing patterns and conventions
- Make minimal, focused changes
- Do not over-engineer the solution

### 4. Write Regression Tests

**CRITICAL**: Do not consider the work complete until the test suite passes.

**Testing is non-negotiable.** When AI generates code, tests are an absolute requirement.

- Write tests that verify the fix works
- Write tests that prevent regression
- Follow existing test patterns (Pest 4)
- Use appropriate test types (feature, unit, browser)
- Ensure tests cover the bug scenario
- If code was generated without tests, add them immediately

Run tests:
```bash
php artisan test --compact
```

If tests fail, fix them and rerun until all tests pass.

**Remember**: Tests are the only reliable feedback loop that tells you changes didn't break anything.

### 5. Run Formatting and Verification

Run the formatting and verification commands:
```bash
composer run format
```

This runs:
- Rector (code refactoring)
- Pint (code formatting)

If any issues are reported, fix them and rerun until the format script passes completely.

### 6. Verify Tests Again

After formatting, run tests again to ensure nothing broke:
```bash
php artisan test --compact
```

**Do not mark the issue as resolved until the test suite passes locally.**

### 7. Commit Changes

Commit using our team's commit message convention:
```bash
git commit -m "Fix issue #<issue-number>: <brief description>"
```

Example: `git commit -m "Fix issue #3: Remove accidental dd() call in help command"`

Follow Conventional Commits format:
- Use appropriate type (feat, fix, docs, etc.)
- Reference the issue number
- Provide clear, concise description

### 8. Push Branch and Create PR

Push the branch:
```bash
git push -u origin fix/issue-<issue-number>
```

Create a PR with a title and body that closes the issue:
```bash
gh pr create --title "Fix <brief description> (closes #<issue-number>)" --body "<detailed description>

Closes #<issue-number>"
```

Example:
```bash
gh pr create \
  --title "Fix help command (closes #3)" \
  --body "This PR removes an accidental dd() call that prevented the help command from running.

Closes #3"
```

### 9. Provide Summary

After completing all steps, provide:
- Summary of what was fixed
- Link to the PR
- Any important notes about the fix
- Test results

## Important Rules

### Test Requirements
- **Always write tests** for the fix
- **Never skip tests** - they are non-negotiable
- **Do not mark complete** until tests pass
- **Run tests after formatting** to ensure nothing broke

### Code Quality
- Follow existing code conventions
- Use existing patterns
- Keep changes minimal and focused
- Run formatters before committing

### Git Workflow
- Use branch naming convention: `fix/issue-<number>`
- Use commit message convention with issue reference
- Create PR that closes the issue
- Use descriptive PR title and body

## Example: Complete Workflow

```bash
# 1. Fetch issue
gh issue view 3

# 2. Create branch
git checkout -b fix/issue-3

# 3. Make fix (edit files)

# 4. Write tests
php artisan make:test --pest TelegramHelpCommandTest
# ... write tests ...

# 5. Run tests
php artisan test --compact

# 6. Format code
composer run format

# 7. Run tests again
php artisan test --compact

# 8. Commit
git add .
git commit -m "Fix issue #3: Remove accidental dd() call in help command"

# 9. Push and create PR
git push -u origin fix/issue-3
gh pr create --title "Fix help command (closes #3)" --body "This PR removes an accidental dd() call that prevented the help command from running. Closes #3"
```

## Troubleshooting

### If tests fail:
- Analyze the failure
- Fix the issue
- Rerun tests
- Do not proceed until tests pass

### If formatting fails:
- Fix the reported issues
- Rerun format command
- Do not proceed until formatting passes

### If PR creation fails:
- Check branch was pushed successfully
- Verify GitHub CLI is authenticated
- Retry PR creation

## Notes

- This skill handles the entire fix-to-PR workflow
- It ensures code quality through tests and formatting
- It follows team conventions for branches and commits
- It automatically closes the issue via PR
