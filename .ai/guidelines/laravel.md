# Laravel Testing Requirements

## Testing is Non-Negotiable

**CRITICAL**: When AI generates code, tests are an absolute requirement. They cannot be skipped.

### Why Tests Matter

- Tests are the only reliable feedback loop that tells you changes didn't break anything
- Without tests, you can't be confident refactors preserved behavior
- With tests, you can change implementation details freely
- Tests guard against regressions when AI generates code

## Mandatory Testing Rules

### When Creating New Endpoints

**When creating a new endpoint and controller/action, you MUST create a relevant feature or smoke test to confirm it works.**

Example: If creating `PostController::store`, create `tests/Feature/PostStoreTest.php`.

### When Creating New Features

**When implementing a new feature, you MUST write tests that define the API and behavior before considering the work complete.**

Example: If implementing label removal, create tests that verify:
- Authorized users can remove labels
- Unauthorized users cannot
- Labels are actually removed
- Related data is updated correctly

### When Refactoring

**Before refactoring AI-generated code, add tests that define the current behavior. Then refactor with confidence that tests will catch any regressions.**

## Test Requirements

### Feature Tests

Every controller action must have a feature test that:
- Tests the happy path
- Tests error conditions
- Tests authorization (if applicable)
- Verifies expected behavior

### Example: Label Removal Test

```php
it('allows an authorized user to remove a label from a ticket', function () {
    $user = User::factory()->create();
    $ticket = Ticket::factory()->create([
        'labels' => [
            ['name' => 'bug'],
            ['name' => 'urgent'],
        ],
    ]);

    actingAs($user)
        ->delete(route('support.tickets.labels.destroy', [$ticket, 'urgent']))
        ->assertStatus(200);

    $ticket->refresh();

    expect(collect($ticket->labels)->pluck('name')->contains('urgent'))->toBeFalse();
});
```

## Workflow: Test-First Refactoring

### Step 1: Add Tests Before Refactoring

If AI generates code without tests:
1. Stop and add tests
2. Write tests that define the API/behavior
3. Ensure tests pass with current implementation

### Step 2: Refactor with Confidence

Once tests exist:
1. Refactor implementation
2. Run tests after each change
3. If tests pass, continue
4. If tests fail, fix and re-run

### Step 3: Iterate Safely

Small, incremental refactors:
- Make one change
- Run tests
- If green, continue
- If red, fix and re-run

## Code Generation Rules

### Always Include Tests

When generating:
- Controllers → Include feature tests
- Models → Include unit/feature tests
- Services → Include tests
- Jobs → Include tests
- Commands → Include tests

### Test Coverage

Tests must cover:
- ✅ Happy path scenarios
- ✅ Error conditions
- ✅ Edge cases
- ✅ Authorization (if applicable)
- ✅ Validation (if applicable)

## Enforcement

### In Skills

Skills like `fix-issue` already require tests. All skills should enforce:
- Tests must be written
- Tests must pass
- Work is not complete until tests pass

### In Commands

Commands like `/format` and `/test` verify tests pass. Use them:
- After code generation
- After refactoring
- Before committing

### In Guidelines

This guideline file ensures AI knows:
- Tests are mandatory
- Tests must be created
- Tests must pass
- No exceptions

## Example: Complete Workflow

### AI Generates Code Without Tests

**Generated:**
- Controller action
- Route
- View component
- **Missing: Tests**

### Add Tests First

```php
it('allows authorized user to perform action', function () {
    // Test that defines expected behavior
});
```

### Then Refactor Safely

```php
// Refactor implementation
// Run tests
// Verify behavior preserved
```

## Best Practices

### 1. Test First

- Add tests before refactoring
- Define API/behavior with tests
- Use tests as contract

### 2. Run Tests Frequently

- After each change
- Before committing
- After refactoring
- During development

### 3. Keep Tests Green

- Fix failing tests immediately
- Don't skip tests
- Don't mark work complete until tests pass

### 4. Update Guidelines

If AI omits tests:
- Add rule to guidelines
- Regenerate guidelines: `php artisan boost:install`
- Ensure AI knows tests are required

## Integration

### With Skills

Skills enforce testing:
- `fix-issue` - Requires tests
- `pest-testing` - Testing framework
- All skills should require tests

### With Commands

Commands verify tests:
- `/test` - Run tests
- `/format` - Format then test
- Use after code generation

### With Workflows

Complete workflows:
1. Generate code
2. Add tests (if missing)
3. Run tests
4. Refactor safely
5. Verify tests still pass

## Summary

**Testing is non-negotiable when AI generates code.**

- ✅ Always create tests for new endpoints/features
- ✅ Add tests before refactoring
- ✅ Run tests frequently
- ✅ Keep tests green
- ✅ Use tests as contract

**If AI omits tests:**
1. Stop and add tests
2. Update guidelines
3. Regenerate guidelines
4. Ensure AI knows tests are required

**Remember:** Tests are the only reliable feedback loop when AI generates code you won't read line-by-line.
