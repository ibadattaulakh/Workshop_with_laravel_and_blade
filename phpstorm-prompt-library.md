# PhpStorm Prompt Library Guide

## Overview

PhpStorm's Prompt Library allows you to create reusable prompts that run against your current selection (or entire file) and produce a ready-to-apply diff. This makes one-file refactors ridiculously easy.

## Why Use Prompt Library

- ✅ **Fast refactoring** - Convert code in seconds instead of minutes
- ✅ **Consistent transformations** - Same prompt produces consistent results
- ✅ **Selection-based** - Works on selections, entire files, or line ranges
- ✅ **Diff preview** - Review changes before applying
- ✅ **Reusable** - Save prompts for common tasks

## How to Access

1. Open a file in PhpStorm
2. Select the code you want to refactor (or select entire file)
3. Go to **Refactor** menu → **Add Your Prompts**
4. This opens the Prompt Library

## Creating a Custom Prompt

### Basic Structure

1. Click "Add Prompt" in the Prompt Library
2. Give it a name (e.g., "Vue 2 To Vue 3")
3. Write your prompt using the selection variable
4. Set the scope (selection, entire file, or line range)

### Magic Variable

Use `{selection}` or `{file}` in your prompt to reference the selected code or entire file.

## Example Prompts for This Project

### Vue 2 to Vue 3 Conversion

**Name:** `Vue 2 To Vue 3`

**Prompt:**
```
Convert this selection from Vue 2 Options API to Vue 3 Composition API using <script setup> and TypeScript.

Requirements:
- Use <script setup lang="ts">
- Convert props to defineProps<T>() with TypeScript types
- Convert emits to defineEmits<T>() with typed emits
- Convert data() to ref() or reactive()
- Convert methods to functions
- Convert computed properties to computed()
- Use Composition API style logic
- Maintain all functionality
```

**Scope:** Selection or Entire File

### Generate Unit Tests

**Name:** `Generate Pest Test`

**Prompt:**
```
Generate a comprehensive Pest test for this selection. 

Requirements:
- Use Pest 4 syntax
- Test happy path
- Test edge cases
- Test error conditions
- Follow existing test patterns in tests/Feature/
- Use descriptive test names
- Include proper setup and assertions
```

**Scope:** Selection (class or method)

### Laravel Controller Refactor

**Name:** `Extract Form Request`

**Prompt:**
```
Refactor this controller method to use a Form Request class for validation.

Requirements:
- Create a Form Request class following Laravel conventions
- Move validation rules to the Form Request
- Update controller to use the Form Request type hint
- Follow existing Form Request patterns in app/Http/Requests/
- Include custom error messages if needed
```

**Scope:** Selection (method)

### Add Type Declarations

**Name:** `Add Type Hints`

**Prompt:**
```
Add explicit type declarations to this selection.

Requirements:
- Add return type hints to all methods
- Add parameter type hints
- Use PHP 8.3 appropriate types
- Follow existing code conventions
- Use strict types declaration if not present
```

**Scope:** Selection or Entire File

### Convert to Eloquent Relationships

**Name:** `Use Eloquent Relationships`

**Prompt:**
```
Refactor this code to use Eloquent relationships instead of manual queries.

Requirements:
- Replace manual joins with relationship methods
- Use proper relationship types (hasMany, belongsTo, etc.)
- Add relationship methods to models if needed
- Use eager loading to prevent N+1 queries
- Follow existing relationship patterns
```

**Scope:** Selection

### Inertia Page Component

**Name:** `Create Inertia Page`

**Prompt:**
```
Convert this Blade view to an Inertia Vue 3 page component.

Requirements:
- Create Vue component in resources/js/Pages/
- Use <script setup> with TypeScript
- Convert Blade syntax to Vue template syntax
- Use Inertia's Link component for navigation
- Use useForm for forms
- Follow existing Inertia page patterns
- Maintain all functionality
```

**Scope:** Entire File

### Add PHPDoc Blocks

**Name:** `Add PHPDoc`

**Prompt:**
```
Add comprehensive PHPDoc blocks to this selection.

Requirements:
- Add @param tags for all parameters
- Add @return tag with type
- Add @throws tags if applicable
- Include description of what the method/class does
- Use array shape types for complex arrays
- Follow existing PHPDoc patterns
```

**Scope:** Selection (method or class)

## Workflow Example: Vue 2 to Vue 3

1. **Open the Vue file** (e.g., `resources/js/Components/OldComponent.vue`)
2. **Select the entire file** or the `<script>` section
3. **Open Prompt Library**: Refactor → Add Your Prompts
4. **Select "Vue 2 To Vue 3"** prompt
5. **Review the diff** in the AI tab
6. **Accept changes** (Return key to accept all)

Result: File is converted to Vue 3 Composition API with TypeScript.

## Best Practices

### 1. Review Before Applying
- Always review the diff before accepting
- Check that functionality is preserved
- Verify types are correct

### 2. Keep Prompts Focused
- One prompt = one transformation
- Don't try to do too much at once
- Create separate prompts for different tasks

### 3. Update Project Guidelines
- Keep your project guidelines up to date
- Reference them in prompts when helpful
- Ensure prompts follow your conventions

### 4. Test After Refactoring
- Run tests after applying changes
- Use `/test` command to verify
- Fix any issues that arise

### 5. Iterate on Prompts
- Refine prompts based on results
- Add more specific requirements
- Share good prompts with the team

## Common Use Cases

### Library Migrations
- Vue 2 → Vue 3
- Laravel 11 → Laravel 12
- PHP 8.2 → PHP 8.3 features

### Code Style Updates
- Add type declarations
- Convert to modern PHP syntax
- Update to latest framework patterns

### API Updates
- Rename deprecated methods
- Update to new API patterns
- Convert to new syntax

### Test Generation
- Generate tests for existing code
- Add missing test cases
- Update tests for refactored code

## Integration with Claude Commands

Prompt Library complements Claude Commands:

- **Prompt Library**: Quick, file-level transformations
- **Claude Commands**: Multi-file, workflow-level tasks

Use Prompt Library for:
- Single file refactors
- Code style updates
- Syntax conversions

Use Claude Commands for:
- Multi-file changes
- Complete workflows
- Complex refactoring

## Example: Complete Refactor Workflow

1. **Use Prompt Library** to convert Vue 2 → Vue 3
2. **Review and accept** the changes
3. **Run `/test`** command to ensure tests pass
4. **Run `/format`** command to ensure code style
5. **Commit** the changes

## Troubleshooting

### Prompt Not Working
- Check that selection is valid
- Verify prompt syntax
- Try with entire file instead of selection

### Results Not Correct
- Refine prompt with more specific requirements
- Add examples to the prompt
- Reference project guidelines

### Changes Too Aggressive
- Use more specific prompts
- Apply to smaller selections
- Review diff carefully before accepting

## Sharing Prompts

Prompts are stored in PhpStorm settings. To share with your team:

1. Export PhpStorm settings
2. Share the prompt library configuration
3. Team members import settings
4. Everyone has the same prompts

Alternatively, document prompts in this file (as done above) so team members can recreate them.

## Quick Reference

**Access:** Refactor → Add Your Prompts

**Magic Variables:**
- `{selection}` - Selected code
- `{file}` - Entire file

**Common Scopes:**
- Selection
- Entire File
- Line Range

**Workflow:**
1. Select code
2. Choose prompt
3. Review diff
4. Accept changes
5. Test and format
