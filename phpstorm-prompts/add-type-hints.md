# Add Type Hints Prompt

## Prompt Name
`Add Type Hints`

## Prompt Text
```
Add explicit type declarations to this selection.

Requirements:
- Add return type hints to all methods
- Add parameter type hints
- Use PHP 8.3 appropriate types (union types, intersection types where applicable)
- Follow existing code conventions
- Use strict types declaration if not present
- Use nullable types (?Type) where appropriate
- Use array shape types in PHPDoc for complex arrays
- Maintain backward compatibility
```

## Scope
Selection or Entire File

## Example Before
```php
public function getUserPosts($userId)
{
    return Post::where('user_id', $userId)->get();
}

public function createPost($data)
{
    return Post::create($data);
}
```

## Example After
```php
public function getUserPosts(int $userId): \Illuminate\Database\Eloquent\Collection
{
    return Post::where('user_id', $userId)->get();
}

public function createPost(array $data): Post
{
    return Post::create($data);
}
```
