---
description: "Add tests for code that was generated without tests"
---

Review the changed files in git and add comprehensive tests for any code that was generated without tests.

**CRITICAL**: Testing is non-negotiable. If AI generated code without tests, add them immediately.

## Process

1. Check `git status` to see what files changed
2. Identify code that needs tests:
   - New controller actions → Feature tests
   - New models → Unit/Feature tests
   - New services → Tests
   - New jobs → Tests
   - New commands → Tests

3. For each piece of code:
   - Write tests that define the API/behavior
   - Test happy path scenarios
   - Test error conditions
   - Test edge cases
   - Test authorization (if applicable)
   - Test validation (if applicable)

4. Ensure tests pass:
   ```bash
   php artisan test --compact
   ```

5. If tests fail, fix the implementation until tests pass

## Test Requirements

Tests must:
- ✅ Define expected behavior
- ✅ Cover happy path
- ✅ Cover error conditions
- ✅ Cover edge cases
- ✅ Verify API contract
- ✅ Pass before work is complete

## Example: Controller Action

If a controller action was created without tests:

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

it('prevents unauthorized users', function () {
    $resource = Resource::factory()->create();

    $this->post(route('resource.action', $resource))
        ->assertUnauthorized();
});
```

## After Adding Tests

Once tests are added and passing:
- Code is now safe to refactor
- Tests define the contract
- Can change implementation with confidence
- Tests will catch regressions

**Remember**: Work is not complete until tests are written AND tests pass.
