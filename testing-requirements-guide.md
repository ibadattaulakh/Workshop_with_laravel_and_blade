# Testing Requirements Guide

## The Debate is Over: Testing is a Must

When AI generates code, tests are an **absolute requirement**. They cannot be skipped.

## Why Tests Matter

### The Problem

When AI generates code without tests:
- ❌ No reliable feedback loop
- ❌ Can't verify refactors preserved behavior
- ❌ Can't be confident changes didn't break anything
- ❌ Brittle codebase

### The Solution

When tests exist:
- ✅ Reliable feedback loop
- ✅ Can refactor with confidence
- ✅ Tests guard against regressions
- ✅ Safe to change implementation

## The Feedback Loop

### Without Tests

1. AI generates code
2. Code looks correct
3. Refactor code
4. **Unknown**: Did refactor break anything?
5. **Risk**: Regressions introduced

### With Tests

1. AI generates code
2. **Add tests** (if missing)
3. Tests define behavior
4. Refactor code
5. **Run tests**
6. **Known**: Tests pass = behavior preserved
7. **Safe**: Refactor with confidence

## Example: Label Removal Feature

### AI Generates Code

**Controller:**
```php
public function destroy(Ticket $ticket, string $name)
{
    $labels = $ticket->labels->getArrayCopy();

    $labels = collect($labels)
        ->reject(function ($label) use ($name) {
            return strtolower($label['name']) === strtolower($name);
        })
        ->values()
        ->toArray();

    $ticket->labels = $labels;
    $ticket->save();
}
```

**Problem**: No tests!

### Add Tests First

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

### Now Refactor Safely

**Refactored (cleaner):**
```php
public function destroy(Ticket $ticket, string $name)
{
    $ticket->labels = collect($ticket->labels)
        ->reject(fn($label) => strtolower($label['name']) === strtolower($name))
        ->values()
        ->toArray();

    $ticket->save();
}
```

**Verify**: Run tests → Green → Behavior preserved ✅

## Mandatory Testing Rules

### Rule 1: Always Create Tests for New Endpoints

**When creating a new endpoint and controller/action, you MUST create a relevant feature or smoke test to confirm it works.**

**Example:**
- Create `PostController::store` → Create `PostStoreTest.php`
- Create `ProfileController::update` → Create `ProfileUpdateTest.php`

### Rule 2: Tests Define the Contract

Tests define:
- What the code should do
- How it should behave
- What the API is
- Expected outcomes

### Rule 3: Refactor Only After Tests Exist

**Before refactoring:**
1. Add tests (if missing)
2. Ensure tests pass
3. Then refactor
4. Verify tests still pass

### Rule 4: Tests Must Pass

**Work is not complete until:**
- ✅ Tests are written
- ✅ Tests pass
- ✅ All scenarios covered

## Test-First Refactoring Workflow

### Step 1: Identify Missing Tests

If AI generates code without tests:
- Stop immediately
- Don't refactor yet
- Add tests first

### Step 2: Write Tests

Write tests that:
- Define expected behavior
- Cover happy path
- Cover error cases
- Verify API contract

### Step 3: Ensure Tests Pass

Run tests:
```bash
php artisan test --compact
```

If tests fail:
- Fix implementation
- Re-run tests
- Continue until green

### Step 4: Refactor Safely

Now you can refactor:
- Make changes incrementally
- Run tests after each change
- If green → continue
- If red → fix and re-run

### Step 5: Iterate

Small, safe refactors:
- One change at a time
- Test after each change
- Build confidence
- Improve code quality

## Updating Guidelines

### If AI Omits Tests

1. **Add rule to guidelines**
   - Add to `.ai/guidelines/laravel.md`
   - Make it explicit and mandatory

2. **Regenerate guidelines**
   ```bash
   php artisan boost:install
   ```

3. **Verify AI knows**
   - Check guidelines are updated
   - Test with new code generation
   - Ensure tests are created

### Example Guideline Addition

Add to `.ai/guidelines/laravel.md`:

```markdown
## Testing Requirements

When creating a new endpoint and controller/action, you MUST create a relevant feature or smoke test to confirm it works.

Tests are non-negotiable. Work is not complete until tests pass.
```

## Example Test Patterns

### Feature Test Pattern

```php
it('allows authorized user to perform action', function () {
    $user = User::factory()->create();
    $resource = Resource::factory()->create();

    actingAs($user)
        ->post(route('resource.action', $resource), [
            'field' => 'value',
        ])
        ->assertSuccessful();

    $resource->refresh();
    expect($resource->field)->toBe('value');
});
```

### Authorization Test

```php
it('prevents unauthorized users from performing action', function () {
    $resource = Resource::factory()->create();

    $this->post(route('resource.action', $resource))
        ->assertUnauthorized();
});
```

### Validation Test

```php
it('validates required fields', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->post(route('resource.store'), [])
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['field']);
});
```

## Integration with Workflows

### With Skills

Skills enforce testing:
- `fix-issue` - Requires tests before completion
- All skills should require tests

### With Commands

Commands verify tests:
- `/test` - Run tests
- `/format` - Format then test
- Use after code generation

### With Code Review

Code review should check:
- Tests exist
- Tests pass
- Tests cover scenarios
- Tests are meaningful

## Best Practices

### 1. Test First

- Add tests before refactoring
- Define behavior with tests
- Use tests as contract

### 2. Run Tests Frequently

- After each change
- Before committing
- After refactoring
- During development

### 3. Keep Tests Green

- Fix failing tests immediately
- Don't skip tests
- Don't mark complete until tests pass

### 4. Update Guidelines

If AI omits tests:
- Add explicit rule
- Regenerate guidelines
- Ensure AI knows

### 5. Use Tests as Documentation

Tests document:
- How code should work
- Expected behavior
- API contract
- Usage examples

## Common Scenarios

### Scenario 1: AI Generates Without Tests

**Action:**
1. Stop and add tests
2. Write tests that define behavior
3. Ensure tests pass
4. Then refactor if needed

### Scenario 2: Refactoring AI Code

**Action:**
1. Add tests first (if missing)
2. Ensure tests pass
3. Refactor incrementally
4. Run tests after each change
5. Verify behavior preserved

### Scenario 3: New Feature

**Action:**
1. Plan feature
2. Write tests first (TDD)
3. Implement feature
4. Ensure tests pass
5. Refactor if needed

## Summary

**Testing is non-negotiable when AI generates code.**

**Key Points:**
- ✅ Tests are mandatory
- ✅ Add tests before refactoring
- ✅ Tests define the contract
- ✅ Run tests frequently
- ✅ Keep tests green
- ✅ Update guidelines if AI omits tests

**Workflow:**
1. AI generates code
2. Add tests (if missing)
3. Ensure tests pass
4. Refactor safely
5. Verify tests still pass

**Remember:** Tests are the only reliable feedback loop when AI generates code you won't read line-by-line.
