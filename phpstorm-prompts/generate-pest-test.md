# Generate Pest Test Prompt

## Prompt Name
`Generate Pest Test`

## Prompt Text
```
Generate a comprehensive Pest test for this selection.

Requirements:
- Use Pest 4 syntax
- Test happy path scenarios
- Test edge cases and error conditions
- Follow existing test patterns in tests/Feature/
- Use descriptive test names with 'it()' function
- Include proper setup using factories
- Use appropriate assertions (assertSuccessful, assertNotFound, etc.)
- Mock external dependencies if needed
- Use RefreshDatabase trait patterns
- Follow project testing conventions
```

## Scope
Selection (class or method)

## Example Usage
Select a controller method or service class, then apply this prompt to generate tests.

## Example Output
```php
<?php

use App\Models\User;
use App\Models\Post;

it('can create a post', function () {
    $user = User::factory()->create();
    
    $this->actingAs($user)
        ->postJson('/posts', [
            'content' => 'Test post content'
        ])
        ->assertSuccessful();
    
    expect(Post::count())->toBe(1);
    expect(Post::first()->content)->toBe('Test post content');
});

it('requires authentication to create a post', function () {
    $this->postJson('/posts', [
        'content' => 'Test post'
    ])->assertUnauthorized();
});

it('validates post content is required', function () {
    $user = User::factory()->create();
    
    $this->actingAs($user)
        ->postJson('/posts', [])
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['content']);
});
```
