---
description: "Perform a comprehensive code review on changed files"
---

Check git status and review all changed files.

Act as a senior Laravel engineer and provide a comprehensive code review.

## Review Process

1. Check `git status` to see what files changed
2. Review each changed file for:
   - Code quality issues
   - Laravel best practices
   - Guideline violations (check project guidelines)
   - Missing return types
   - Incorrect visibility (public/protected/private)
   - Security concerns
   - Performance issues
   - Test coverage
   - Code style consistency

3. Provide specific, actionable feedback with code examples
4. Suggest improvements following Laravel conventions
5. Ensure project guidelines are followed

## Guidelines to Check

- Always favor Laravel facades over helper functions
- Use Form Requests for validation
- Follow existing code patterns
- Maintain test coverage
- Use proper return types
- Ensure correct method visibility

## Verification

After review, run:
- `composer run format` - Verify code formatting
- `php artisan test --compact` - Verify tests pass

## Output Format

For each issue found:
- **File**: Path to file
- **Issue**: Description of the problem
- **Current Code**: Show the problematic code
- **Suggested Fix**: Show improved code
- **Reason**: Explain why the change is needed

Provide a summary at the end with:
- Total issues found
- Priority of fixes
- Estimated effort
