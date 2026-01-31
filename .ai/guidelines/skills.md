# Skills

## Fix GitHub Issues

When asked to fix a GitHub issue, immediately use the `fix-issue` Claude skill instead of manually running commands.

The `fix-issue` skill handles the complete workflow:
- Fetching and analyzing the issue
- Creating a branch with proper naming
- Implementing the fix
- Writing regression tests
- Running formatters
- Committing with proper message
- Creating a PR that closes the issue

**Do not skip any steps** - especially tests. The fix is not complete until the test suite passes.

## Testing Requirements

**CRITICAL**: Testing is non-negotiable when AI generates code.

### Mandatory Rules

- When creating a new endpoint and controller/action, you MUST create a relevant feature or smoke test to confirm it works.
- When implementing a new feature, you MUST write tests that define the API and behavior before considering the work complete.
- Before refactoring AI-generated code, add tests that define the current behavior. Then refactor with confidence that tests will catch any regressions.
- Work is not complete until tests are written AND tests pass.

### Why Tests Matter

- Tests are the only reliable feedback loop that tells you changes didn't break anything
- Without tests, you can't be confident refactors preserved behavior
- With tests, you can change implementation details freely
- Tests guard against regressions when AI generates code

### If AI Omits Tests

1. Stop and add tests immediately
2. Write tests that define the API/behavior
3. Ensure tests pass
4. Then proceed with implementation or refactoring
5. Update guidelines to ensure AI knows tests are required

## Skill Activation

Skills are located in `.claude/skills/` and should be activated automatically when:
- User mentions fixing a GitHub issue
- User references an issue number
- User asks to resolve a bug report

If a skill should be used but isn't being activated, check:
1. The skill description includes trigger words
2. This guideline file references the skill
3. The skill name matches the description

## Available Skills

- `fix-issue` - Complete workflow for fixing GitHub issues
- `pest-testing` - Pest 4 testing framework
- `inertia-vue-development` - Inertia.js v2 Vue development
- `tailwindcss-development` - Tailwind CSS v4 styling
