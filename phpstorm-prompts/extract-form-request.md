# Extract Form Request Prompt

## Prompt Name
`Extract Form Request`

## Prompt Text
```
Refactor this controller method to use a Form Request class for validation.

Requirements:
- Create a Form Request class following Laravel conventions
- Class name should be descriptive (e.g., StorePostRequest, UpdateProfileRequest)
- Move validation rules to the rules() method
- Add custom error messages to messages() method if needed
- Update controller method to use the Form Request type hint
- Follow existing Form Request patterns in app/Http/Requests/
- Use array-based validation rules (not string-based)
- Include authorization logic in authorize() method if needed
- Remove inline validation from controller
```

## Scope
Selection (controller method)

## Example Before
```php
public function store(Request $request)
{
    $validated = $request->validate([
        'content' => 'required|string|max:500',
        'profile_id' => 'required|exists:profiles,id'
    ]);
    
    Post::create($validated);
    
    return redirect()->route('posts.index');
}
```

## Example After

**Controller:**
```php
public function store(StorePostRequest $request)
{
    Post::create($request->validated());
    
    return redirect()->route('posts.index');
}
```

**Form Request:**
```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'content' => ['required', 'string', 'max:500'],
            'profile_id' => ['required', 'exists:profiles,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'content.required' => 'Post content is required.',
            'content.max' => 'Post content cannot exceed 500 characters.',
        ];
    }
}
```
